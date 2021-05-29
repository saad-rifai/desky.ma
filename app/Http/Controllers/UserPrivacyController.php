<?php

namespace App\Http\Controllers;

use App\UserPrivacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPrivacyController extends Controller
{
    public function GetUserPrivacy(){
        $stmt = UserPrivacy::all(['email', 'public_account', 'public_devis', 'public_facture', 'updated_at'])->where('email', Auth::user()->email);
        if($stmt->count() > 0){
            foreach($stmt as $js); 
            return response()->json($js, 200);
        }else{
            return response()->json('user Not Found', 204);
        }

    }
    public function UpdateUserPrivacy(Request $request){
        if(isset($request->pp) && isset($request->pd) && isset($request->pf) && $request->pp != "" && $request->pd != "" && $request->pf != ""){
            if($request->pp == "true"){
                $pp = 1;
            }else{
                $pp = 0;
            }if($request->pf == "true"){
                $pf = 1;
            }else{
                $pf = 0;

            }if($request->pd == "true"){
                $pd = 1;
            }else{
                $pd = 0;

            }
            $stmt = UserPrivacy::where('email', Auth::user()->email)->update([
                'public_account' => $pp,
                'public_facture' => $pf,
                'public_devis' => $pd
                ]);
                if($stmt){
                    return response()->json(['success' => 'تم تحديث البيانات'], 201);
                }else{
                    return response()->json(['error' => 'فشل تحديث البيانات fx0041'], 500);

                }
        }
    }
}
