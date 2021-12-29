<?php

namespace App\Http\Controllers\admin;

use App\AeAccount;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Mail\users\aeaccount\AeAccountAccepted;
use App\Mail\users\aeaccount\AeAccountRejected;
use App\User;
use App\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class users extends Controller
{
    public function listRequestAeAccountsJson()
    {
        $AeAccountCount = AeAccount::where('status', '1')->count();
        $data = AeAccount::where('status', '1')->orderBy('created_at', 'ASC')->paginate(10);
        $data->makeVisible(['cin', 'ae_number', 'cin_date_expiration', 'ae_join_date', 'files', 'status', 'message']);

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]->user->makeVisible(['phone_number', 'email']);
            if ($data[$i]->files != null) {
                $data[$i]->files = json_decode($data[$i]->files, true);
            }
            $data[$i]->date =  date('Y/m/d H:i:s', strtotime($data[$i]->created_at));

            $data[$i]->user = $data[$i]->user;
            $data[$i]->user_fullname = Str::ucfirst($data[$i]->user->frist_name) . ' ' . Str::ucfirst($data[$i]->user->last_name);


            /* Get Activite And Sector Name */
            $Activites = $data[$i]->activite;
            $sector = $data[$i]->sector;
            $Activites = intval($Activites);
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
        }
        return response()->json(['data' => $data, 'AeAccountCount' => $AeAccountCount], 200);
    }
    public function ReviewDecision(Request $request)
    {
        if (Auth::user()->permissions->view_aeaccount_pending_review) {
            $this->validate($request, [
                'Account_number' => 'required',
                'email' => 'required',
                'decision' => 'required|integer|max:3|min:1',
            ], [
                'integer' => 'Please check entries',

                'max' => 'Please check entries',
                'min' => 'Please check entries',
            ]);
            if ($request->decision == 2 || $request->decision == 3) {
                $this->validate($request, [
                    'reason' => 'required|string|max:700|min:15'
                ]);
            }
            switch ($request->decision) {
                case 1:
                    $status = 2;
                    break;
                case 2:
                    $status = 3;
                    break;
                case 3:
                    $status = 4;
                    break;
                default:
                    $status = null;
                    break;
            }
            $stmt = AeAccount::where('Account_number', $request->Account_number)->update([
                'status' => $status,
                'message' => $request->reason
            ]);
            
            if ($stmt) {
                if($request->decision == 1){
                    $stmt2 = User::where('Account_number', $request->Account_number)->update([
                        'verified_account' => 2
                    ]);
                }

                $message1 = 'يؤسفنا أن نعلمك أنه قد تم رفض طلبك لتفعيل  <a href="' . asset('/account/settings#ae_account') . '">حساب المقاول الذاتي</a>';
                $message2 = 'يؤسفنا أن نعلمك أنه قد تم حضر من ارسال طلب لتفعيل  <a href="' . asset('/account/settings#ae_account') . '">حساب المقاول الذاتي</a>';
                $message3 = 'مبروك لقد تم تفعيل حساب المقاول الذاتي الخاص بك يمكنك الأن اضافة عروض على <a href="' . asset('orders?ref=new_notificaion_accepted') . '">الطلبات</a>';
                if ($request->decision == 1) {
                    $fullmessage = $message3;
                } elseif ($request->decision == 2) {
                    $fullmessage = $message1;
                } elseif ($request->decision == 3) {
                    $fullmessage = $message2;
                }
                UserNotification::create([
                    'to' => $request->Account_number,
                    'from', "desky.ma",
                    'message' => $fullmessage,
                    'notifybyemail' => "0",
                    'email_status' => "0"
                ]);
                if ($request->decision == 2 || $request->decision == 3) {
                    $dataEmail = [
                        'to' => $request->email,
                        'OID' => $request->OID,
                        'decision' => $request->decision,
                        'reason' => $request->reason,
                    ];
                    $datajob = [
                        'to' => $request->email,
                        'emailData' => new AeAccountRejected($dataEmail)
                    ];
                    dispatch(new SendEmail($datajob));
                } elseif ($request->decision == 1) {

                    $dataEmail = [
                        'to' => $request->email,
                        'OID' => $request->OID,
                    ];
                    $datajob = [
                        'to' => $request->email,
                        'emailData' => new AeAccountAccepted($dataEmail)
                    ];
                    dispatch(new SendEmail($datajob));
                }


            } else {
                return response()->json(["error" => "Something went wrong, please try again"], 500);
            }
        } else {
            return response()->json(["error" => "You don't Have Permission"], 403);
        }
    }
}
