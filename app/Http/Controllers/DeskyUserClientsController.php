<?php

namespace App\Http\Controllers;

use App\desky_user_clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
class DeskyUserClientsController extends Controller
{
    public function ListClients(Request $request)
    {

            if (isset($request->search) && $request->search == true) {
                $term = $request->s_oid;
                $filterData = DB::table('desky_user_clients')
                ->where("from", Auth::user()->email)
                ->where('c_name', 'LIKE', '%' . $request->s_name . '%')
                ->where('c_email', 'LIKE', '%' . $request->s_email . '%')
                ->where('CID', 'LIKE', '%' . $request->s_oid . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
                $infos = DB::table('desky_user_clients')
                ->where("from", Auth::user()->email)
                ->where('c_name', 'LIKE', '%' . $request->s_name . '%')
                ->where('c_email', 'LIKE', '%' . $request->s_email . '%')
                ->where('CID', 'LIKE', '%' . $request->s_oid . '%')
                    ->get();
                $count = $infos->count();
                if (isset($request->page) && $request->page != "") {
                    $pagenow = intval($request->page);
                } else {
                    $pagenow = 1;
                }
                return  response()->json([ $filterData, 'count' => $count, 'pagenow' => $pagenow], 200);
            } else {
                $stmt = DB::table('desky_user_clients')
                ->where('from', Auth::user()->email)
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
              //  ;
                $count = desky_user_clients::all()->where('from', Auth::user()->email)->count();
                if (isset($request->page) && $request->page != "") {
                    $pagenow = intval($request->page);
                } else {
                    $pagenow = 1;
                }
                return  response()->json([$stmt, 'count' => $count, 'pagenow' => $pagenow], 200);
            }



    }
    public function ShowClient(Request $request){
        if (isset($request->CID) && isset($request->UID) && $request->CID != "" && $request->UID != "") {
            if (is_numeric($request->CID) && is_numeric($request->UID)) {

                $CID = $request->CID;
                $clientInfos = Cache::remember('desky_user_clients'.Auth::user()->id.'CID_'.$CID, 60*24*2, function() use($CID){
                    return DB::table('desky_user_clients')
                    ->where('CID', $CID)
                    ->where("from", Auth::user()->email)
                    ->get();
                });
                $count = $clientInfos->count();
                if ($count > 0) {
                    foreach ($clientInfos as $clientInfo);
                    return view("desky.panel.clients.view-client", ['infos' => $clientInfo]);
                } else {
                   abort(404);

                }

            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
    public function GetNotes(Request $request){
    if(isset($request->CID) && $request->CID != "" && is_numeric($request->CID)){
        $stmt = desky_user_clients::where('from', Auth::user()->email)->where("CID", $request->CID)->get(['notes']);
        return response()->json($stmt, 200);
    }else{
        return response()->json(['error', 'هناك خطأ في طلبك'], 400);
    }
    }
    public function UpdateNotes(Request $request){

        if(isset($request->token) && $request->token != ""){
            if(isset($request->CID) && $request->CID != "" && isset($request->notes) && $request->notes != ""){
                    $CID=$request->CID;
                    $notes= htmlspecialchars($request->notes);
                    if( mb_strlen($notes, 'UTF-8') <= 1500){

                       $stmt = desky_user_clients::where('from' , Auth::user()->email)->where('CID', $CID)->update(['notes' => $notes]);
                       if($stmt){
                        return response()->json(['success' => 'تم تحديث الملاحظات'], 200);

                       }else{
                           return response()->json(['error' => 'حصل خطأ في تحديث الملاحظات fx0054'], 500);
                       }

                       return response()->json($stmt);

                }else{
                    return response()->json(['error' => 'الملاحظات أطول من اللازم الحد الأقصى المسموح به 1500 حرف'], 402);

                }

            }else{
                return response()->json(['error' => 'forbidden'], 403);

            }

        }else{
            return response()->json(['error' => 'forbidden '], 403);
        }
    }
}
