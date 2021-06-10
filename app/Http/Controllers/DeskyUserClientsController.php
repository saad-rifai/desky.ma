<?php

namespace App\Http\Controllers;

use App\desky_user_clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
class DeskyUserClientsController extends Controller
{
    // delete clients is not possible because we are need this data to show devis or facture
    /*public function deleteClients(Request $request){
        if(isset($request->token) && $request->token != ""){
            if((isset($request->d) && $request->d != "" && isset($request->cid) && $request->cid != "")){
                if($request->d == "c"){
                    $d=$request->d;
                    $CID=$request->cid;
                    if($d == "c"){
                       $stmt = desky_user_clients::where('from' , Auth::user()->email)->where('CID', $CID)->delete();
                       if($stmt){
                        $cach = Cache::forget('desky_user_devis'.Auth::user()->id.'cid_'.$CID);
                        return response()->json(['success' => 'تم حذف العميل'], 200);
                       }else{
                           return response()->json(['error' => 'حصل خطأ في تحديث البيانات fx0025'], 500);
                       }

                       return response()->json($stmt);
                    }else{
                        return response()->json(['هناك خطأ في طلبك'], 400);
                    }

                }else{
                    return response()->json(['error' => 'forbidden'], 403);

                }
            }else{
                return response()->json(['error' => 'forbidden'], 403);

            }

        }else{
            return response()->json(['error' => 'forbidden '], 403);
        }
    }*/

    public function ShowClient(Request $request)
    {
        if (
            isset($request->CID) &&
            isset($request->UID) &&
            $request->CID != '' &&
            $request->UID != '' &&
            is_numeric($request->CID) &&
            is_numeric($request->UID)
        ) {
            $CID = $request->CID;
            $UID = $request->UID;
            $Clients = Cache::remember(
                'desky_user_clients' . Auth::user()->id . 'CID_' . $CID,
                60 * 24 * 2,
                function () use ($CID, $UID) {
                    return DB::table('desky_user_clients')
                        ->where('CID', $CID)
                        ->where('from', Auth::user()->email)
                        ->get();
                }
            );

            if ($Clients->count() > 0) {
                if (isset($request->datajson)) {
                    return response()->json($Clients, 200);
                } else {
                    foreach ($Clients as $clientInfo);
                    return view('desky.panel.clients.view-client', [
                        'infos' => $clientInfo,
                    ]);
                }
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }
    public function ListClients(Request $request)
    {
        if (isset($request->search) && $request->search == true) {
            $term = $request->s_oid;
            $filterData = DB::table('desky_user_clients')
                ->where('from', Auth::user()->email)
                ->where('c_name', 'LIKE', '%' . $request->s_name . '%')
                ->where('c_email', 'LIKE', '%' . $request->s_email . '%')
                ->where('CID', 'LIKE', '%' . $request->s_oid . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
            $infos = DB::table('desky_user_clients')
                ->where('from', Auth::user()->email)
                ->where('c_name', 'LIKE', '%' . $request->s_name . '%')
                ->where('c_email', 'LIKE', '%' . $request->s_email . '%')
                ->where('CID', 'LIKE', '%' . $request->s_oid . '%')
                ->get();
            $count = $infos->count();
            if (isset($request->page) && $request->page != '') {
                $pagenow = intval($request->page);
            } else {
                $pagenow = 1;
            }
            return response()->json(
                [$filterData, 'count' => $count, 'pagenow' => $pagenow],
                200
            );
        } else {
            $stmt = DB::table('desky_user_clients')
                ->where('from', Auth::user()->email)
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
            //  ;
            $count = desky_user_clients::all()
                ->where('from', Auth::user()->email)
                ->count();
            if (isset($request->page) && $request->page != '') {
                $pagenow = intval($request->page);
            } else {
                $pagenow = 1;
            }
            return response()->json(
                [$stmt, 'count' => $count, 'pagenow' => $pagenow],
                200
            );
        }
    }

    public function GetNotes(Request $request)
    {
        if (
            isset($request->CID) &&
            $request->CID != '' &&
            is_numeric($request->CID)
        ) {
            $stmt = desky_user_clients::where('from', Auth::user()->email)
                ->where('CID', $request->CID)
                ->get(['notes']);
            return response()->json($stmt, 200);
        } else {
            return response()->json(['error', 'هناك خطأ في طلبك'], 400);
        }
    }
    public function UpdateNotes(Request $request)
    {
        if (isset($request->token) && $request->token != '') {
            if (
                isset($request->CID) &&
                $request->CID != '' &&
                isset($request->notes) &&
                $request->notes != ''
            ) {
                $CID = $request->CID;
                $notes = htmlspecialchars($request->notes);
                if (mb_strlen($notes, 'UTF-8') <= 1500) {
                    $stmt = desky_user_clients::where(
                        'from',
                        Auth::user()->email
                    )
                        ->where('CID', $CID)
                        ->update(['notes' => $notes]);
                    if ($stmt) {
                        Cache::forget(
                            'desky_user_clients' .
                                Auth::user()->id .
                                'CID_' .
                                $CID
                        );

                        return response()->json(
                            ['success' => 'تم تحديث الملاحظات'],
                            200
                        );
                    } else {
                        return response()->json(
                            ['error' => 'حصل خطأ في تحديث الملاحظات fx0054'],
                            500
                        );
                    }

                    return response()->json($stmt);
                } else {
                    return response()->json(
                        [
                            'error' =>
                                'الملاحظات أطول من اللازم الحد الأقصى المسموح به 1500 حرف',
                        ],
                        402
                    );
                }
            } else {
                return response()->json(['error' => 'forbidden'], 403);
            }
        } else {
            return response()->json(['error' => 'forbidden '], 403);
        }
    }

    public function GetLastCIDNumber()
    {
        $stmt = desky_user_clients::where('from', Auth::user()->email)->max(
            'CID'
        );
        return response()->json($stmt);
    }
    public function CreerClients(Request $request)
    {
        $this->validate(
            $request,
            [
                'c_name' => 'required|min:5|max:20|regex:/^[\w\d\s ]*$/',
                'c_email' =>
                    'required|string|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:80',
                'c_phone' => 'required|regex:/[0-9]{9}/',
                'c_ice' => 'nullable|min:15|max:17|regex:/[0-9]/',
                'c_type' => 'required|regex:/[0-9]/',
                'CID' => 'required|min:8|max:10|regex:/[0-9]/',
                'notes' => 'nullable|max:700',
                'c_country' => 'nullable|max:6',
                'c_city' => 'nullable|min:4|max:25|regex:/^[\p{L} ]+$/u',
                'c_adresse' =>
                    'nullable|min:7|max:25|regex:/^[\p{L}° ,0-9]+$/u',
            ],
            $message = [
                'required' => 'هذا الحقل مطلوب *',
                'regex' => 'يرجى التحقق من المدخلات *',
                'max' => 'المدخلات أطول من اللازم *',
                'min' => 'المدخلات أقصر من اللازم *',
                'email' => 'يرجى ادخال بريد الكتروني صالح *',
                'notes.max' => 'الحد الأقصى للملاحظات 700 حرف *',
            ]
        );
        $data = file_get_contents('database/data.json');
        $json = json_decode($data, true);
        if (!isset($json['type_clients'][$request->c_type])) {
            return response()->json(
                ['errors' => ['c_type' => ['يرجى تحديد نوع العميل']]],
                422
            );
        }
        if (isset($request->c_country) && $request->c_country != '') {
            $countiesCheck = false;
            foreach ($json['countries'] as $item) {
                if ($item['code'] == $request->c_country) {
                    $countiesCheck = true;
                }
            }
            if ($countiesCheck != true) {
                return response()->json(
                    ['errors' => ['country' => ['يرجى تحديد بلد صالح']]],
                    422
                );
            }
        }

        $stmt = desky_user_clients::create([
            'CID' => $request->CID,
            'UID' => Auth::user()->id,
            'from' => Auth::user()->email,
            'c_email' => $request->c_email,
            'c_phone' => $request->c_phone,
            'c_name' => $request->c_name,
            'c_type' => $request->c_type,
            'c_ice' => $request->c_ice,
            'country' => $request->c_country,
            'city' => $request->c_city,
            'adresse' => $request->c_adresse,
        ]);
        if ($stmt) {
            return response()->json(
                ['success' => 'تم انشاء العميل بنجاح !'],
                220
            );
        } else {
            return response()->json(['message' => 'فشل أنشاء العميل !'], 500);
        }
    }
    public function EditClients(Request $request)
    {
        $this->validate(
            $request,
            [
                'c_name' => 'required|min:5|max:20|regex:/^[\p{L} ]+$/u',
                'c_email' =>
                    'required|string|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:80',
                'c_phone' => 'required|regex:/[0-9]{9}/',
                'c_ice' => 'nullable|min:15|max:17|regex:/[0-9]/',
                'c_type' => 'required|regex:/[0-9]/',
                'CID' => 'required|min:8|max:10|regex:/[0-9]/',
                'notes' => 'nullable|max:700',
                'c_country' => 'nullable|max:6',
                'c_city' => 'nullable|min:4|max:25|regex:/^[\p{L} ]+$/u',
                'c_adresse' =>
                    'nullable|min:7|max:25|regex:/^[\p{L}° ,0-9]+$/u',
            ],
            $message = [
                'required' => 'هذا الحقل مطلوب *',
                'regex' => 'يرجى التحقق من المدخلات *',
                'max' => 'يرجى التحقق من المدخلات *',
                'min' => 'يرجى التحقق من المدخلات *',
                'email' => 'يرجى ادخال بريد الكتروني صالح *',
                'notes.max' => 'الحد الأقصى للملاحظات 700 حرف *',
            ]
        );
        $data = file_get_contents('database/data.json');
        $json = json_decode($data, true);
        if (!isset($json['type_clients'][$request->c_type])) {
            return response()->json(
                ['errors' => ['c_type' => ['يرجى تحديد نوع العميل']]],
                422
            );
        }
        if (isset($request->c_country) && $request->c_country != '') {
            $countiesCheck = false;
            foreach ($json['countries'] as $item) {
                if ($item['code'] == $request->c_country) {
                    $countiesCheck = true;
                }
            }
            if ($countiesCheck != true) {
                return response()->json(
                    ['errors' => ['country' => ['يرجى تحديد بلد صالح']]],
                    422
                );
            }
        }
        $stmt = desky_user_clients::all()
            ->where('from', Auth::user()->email)
            ->where('CID', $request->CID);
        if ($stmt->count() > 0) {
            $stmt = desky_user_clients::where('from', Auth::user()->email)
                ->where('CID', $request->CID)
                ->update([
                    'c_email' => $request->c_email,
                    'c_phone' => $request->c_phone,
                    'c_name' => $request->c_name,
                    'c_type' => $request->c_type,
                    'c_ice' => $request->c_ice,
                    'country' => $request->c_country,
                    'city' => $request->c_city,
                    'adresse' => $request->c_adresse,
                ]);
            $CID = $request->CID;
            if ($stmt) {
                Cache::forget(
                    'desky_user_clients' . Auth::user()->id . 'CID_' . $CID
                );
                return response()->json(
                    ['success' => 'تم تحديث البيانات بنجاح !'],
                    200
                );
            } else {
                return response()->json(
                    ['message' => 'فشل تحديث البيانات'],
                    500
                );
            }
        } else {
            return response()->json(
                ['message' => 'لم يتم ايجاد العميل رقم ' . $request->CID . ''],
                404
            );
        }
    }
    public function LastClientsList(Request $request){
        if(isset($request->limit) && $request->limit != "" && $request->limit != null){
            $infos = desky_user_clients::where("from", Auth::user()->email)->take($request->limit)->orderBy('created_at', 'DESC')->get(['c_name', 'CID', 'created_at']);
            return response()->json($infos, 200);

        }else{
            return response()->json('Bad Request', 400);
        }
    }
}
