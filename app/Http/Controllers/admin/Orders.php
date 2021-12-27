<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Mail\orders\OrderAccepted;
use App\Mail\orders\OrderRejected;
use App\Orders as AppOrders;
use App\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Orders extends Controller
{
    public function PendingOrdersJson()
    {
        $CountPendingOrders = AppOrders::where('status', 0)->orderBy('created_at', 'ASC')->count();
        $data = AppOrders::where('status', 0)->orderBy('created_at', 'ASC')->paginate(10);
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]->files != null) {
                $data[$i]->files = json_decode($data[$i]->files, true);
            }
            $data[$i]->date =  date('Y/m/d H:i:s', strtotime($data[$i]->created_at));

            $data[$i]->user = $data[$i]->user;
            $data[$i]->user_fullname = Str::ucfirst($data[$i]->user->frist_name) . ' ' . Str::ucfirst($data[$i]->user->last_name);
            /* Add Keywords to array */
            if ($data[$i]->keywords != null && $data[$i]->keywords != "") {
                $data[$i]->keywords = explode(",", $data[$i]->keywords);
            } else {
                $data[$i]->keywords = null;
            }
            /* Add Keywords to array */

            /* Get Activite And Sector NAme */
            $Activites = $data[$i]->activite;
            $sector = $data[$i]->sector;
            if (is_int($Activites) && $Activites >= 0) {
                if ($sector == 1) {
                    $listActivites = file_get_contents('data/json/activite-ae-2.json');
                    $listActivitesdata = json_decode($listActivites, true);
                } elseif ($sector == 2 || $sector == 3 || $sector == 4) {
                    $listActivites = file_get_contents('data/json/activite-ae-1.json');
                    $listActivitesdata = json_decode($listActivites, true);
                }
                $activite = $listActivitesdata[$Activites];
                $data[$i]->activite_name = $activite;
            } else {
                $data[$i]->activite_name = "undefined";
            }
            /* Set Sector Name */
            if ($sector == 1) {
                $sectorName = "الخدمات";
            } elseif ($sector == 2) {
                $sectorName = "التجارة";
            } elseif ($sector == 3) {
                $sectorName = "الصناعة";
            } elseif ($sector == 4) {
                $sectorName = "الحرفية";
            } else {
                $sectorName = "undefined";
            }
            $data[$i]->sector_name = $sectorName;
            $data[$i]->budget = number_format((float)$data[$i]->budget, 2, '.', '');
        }

        return response()->json(['data' => $data, 'CountPendingOrders' => $CountPendingOrders], 200);
    }
    public function ReviewDecision(Request $request)
    {
        if (Auth::user()->permissions->view_orders_pending_review) {

            $this->validate($request, [
                'OID' => 'required|integer',
                'title' => 'required|string|max:180|min:10',
                'description' => 'required|string|max:2000|min:80',
                'sector' => 'required|integer|max:4|min:1',
                'activite' => 'required|integer',
                'decision' => 'required|integer|max:3|min:1',
            ], [
                'integer' => 'Please check entries',

                'title.max' => 'title Too Long Max 180 Characters',
                'title.min' => 'title Too Short Min 10 Characters',

                'description.max' => 'Description Too Long Max 2000 Characters',
                'description.min' => 'Description Too Short Min 80 Characters',

                'max' => 'Please check entries',
                'min' => 'Please check entries',
            ]);
            if ($request->sector != 1 && $request->activite > 149 || $request->sector > 1 && $request->activite > 66) {
                return response()->json(['errors' => ['activite' => [0 => 'Please select a valid activity from the menu *']]], 422);
            }
            if ($request->decision == 2 || $request->decision == 3) {
                $this->validate($request, [
                    'reason' => 'required|string|max:700|min:15'
                ]);
            }
            switch ($request->decision) {
                case 1:
                    $status = 1;
                    break;
                case 2:
                    $status = 5;
                    break;

                default:
                    $status = null;
                    break;
            }
            $OrderOwner = AppOrders::where('OID', $request->OID)->first();

            if ($request->decision == 1 || $request->decision == 2) {
                $stmt = AppOrders::where('OID', $request->OID)->where('status', '0')->update([
                    'status' => $status,
                    'message' => $request->reason,
                    'title' => $request->title,
                    'description' => $request->description,
                    'sector' => $request->sector,
                    'activite' => $request->activite
                ]);
            } elseif ($request->decision == 3) {
                $stmt = AppOrders::where('OID', $request->OID)->where('status', '0')->delete();
            }
            if ($stmt) {
                $message1 = 'يؤسفنا أن نعلمك أنه قد تم رفض طلبك رقم <a href="/order/'.$request->OID.'">#' . $request->OID . '</a>';
                $message2 = 'يؤسفنا أن نعلمك أنه قد تم حذف طلبك رقم <a href="#">#' . $request->OID . '</a>';
                if ($request->decision == 2) {

                    $fullmessage = $message1 . ' ' . $request->reason;
                } elseif ($request->decision == 3) {
                    $fullmessage = $message2 . ' ' . $request->reason;
                } elseif ($request->decision == 1) {
                    $fullmessage = 'مبروك تم قبول طلبك رقم <a href="/order/'.$request->OID.'">#' . $request->OID . '</a>';
                }
                UserNotification::create([
                    'to' => $OrderOwner->Account_number,
                    'from', "desky.ma",
                    'message' => $fullmessage,
                    'notifybyemail' => "0",
                    'email_status' => "0"
                ]);
                if($request->decision == 2 || $request->decision == 3){
                    $dataEmail = [
                        'to' => $OrderOwner->user->email,
                        'OID' => $request->OID,
                        'user_frist_name' => $OrderOwner->user->frist_name,
                        'decision' => $request->decision,
                        'title' => $request->title,
                        'reason' => $request->reason,
                    ];
                    $datajob = [
                        'to' => $OrderOwner->user->email,
                        'emailData' => new OrderRejected($dataEmail)
                    ];
                    dispatch(new SendEmail($datajob));
                }elseif($request->decision == 1){
                    
                        $dataEmail = [
                            'to' => $OrderOwner->user->email,
                            'OID' => $request->OID,
                            'user_frist_name' => $OrderOwner->user->frist_name,
                            'title' => $request->title,
                        ];
                        $datajob = [
                            'to' => $OrderOwner->user->email,
                            'emailData' => new OrderAccepted($dataEmail)
                        ];
                        dispatch(new SendEmail($datajob));
                    
                }
                return response()->json(['success' => true, 'stmt' => $stmt], 200);
            } else {
                return response()->json(["error" => "Something went wrong, please try again"], 500);
            }
        } else {
            return response()->json(["error" => "You don't Have Permission"], 403);
        }
    }
}
