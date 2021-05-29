<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\desky_db;
class ShowDocument extends Controller
{
    public function ShowDevis(Request $request)
    {
     /*   if (isset($request->OID) && isset($request->UID) && isset($request->token_share) && $request->OID != "" && $request->UID != "" && $request->token_share != "") {
            if (is_numeric($request->OID) && is_numeric($request->UID)) {
                ////////////
                $token_share = $request->token_share;
                $UID=$request->UID;
                $privacys = Cache::remember('user_privacy_'.$UID, 60*24*15, function () use($UID) {
                    return DB::table('user_privacy')->where('UID', $UID)->get();
                });
                foreach($privacys as $privacy);
                if($privacys->count() > 0 && $token_share == $privacy->token_share){
                    ////////// complet from here
              //      if($privacy->publice_devis ==)




                $OID = $request->OID;
                $DevisInfos = Cache::remember('desky_user_devis'.Auth::user()->id.'oid_'.$OID, 60*24*15, function() use($OID){
                    return DB::table('desky_user_devis')
                    ->join('desky_user_clients', 'desky_user_devis.CID', '=', 'desky_user_clients.CID')
                    ->select('desky_user_devis.*', 'desky_user_clients.CID', 'desky_user_clients.from', 'desky_user_clients.c_email', 'desky_user_clients.c_phone', 'desky_user_clients.c_name', 'desky_user_clients.c_type', 'desky_user_clients.c_ice', 'desky_user_clients.notes', 'desky_user_clients.country', 'desky_user_clients.city', 'desky_user_clients.adresse')
                    ->where('OID', $OID)
                    ->get();
                });
                $db_deskys = desky_db::all()->where("email", Auth::user()->email);
                $count = $DevisInfos->count();
                if ($count > 0) {
                    foreach ($DevisInfos as $DevisInfo);
                    foreach ($db_deskys as $db_desky);
                    return view("desky.panel.view-devis", ['infos' => $DevisInfo, 'db_desky' => $db_desky]);
                } else {
                   abort(404);
                
                }


                /////////
            }else{
                abort(500);
            }

                /////////
            } else {
                //abort(404);
                echo '443';
            }
        } else {
            abort(404);
        }
    
    */

    if(Auth::check()){
        if(isset($request->OID) && isset($request->UID) && is_numeric($request->OID) && is_numeric($request->UID) && !isset($request->token_share)){
            if($request->UID == Auth::user()->id){
                
            }else{
                abort(401);
            }
        }else{
            abort(404);
        }
    }else{
        echo 'not Auth';
    }

    }

}
