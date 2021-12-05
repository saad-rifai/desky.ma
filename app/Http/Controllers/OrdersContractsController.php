<?php

namespace App\Http\Controllers;

use App\Offers;
use App\orders_contracts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserNotification;
class OrdersContractsController extends Controller
{
    public function cancel(Request $request){
        if(isset($request->OID) && isset($request->userid)){
            $CancelContrat = orders_contracts::where('OID', $request->OID)->where('self_contracter', $request->userid)
            ->where('order_owner', Auth::user()->Account_number)
            ->where('status', '0')
            ->update([
                'status' => "3",
                'canceled_at' => date("Y-m-d H:i:s")
            ]);
            if($CancelContrat){
                $updateOffer = Offers::where('OID', $request->OID)->where('Account_number', $request->userid)
                ->update([
                    'status' => '3'
                ]);
                if($updateOffer){
                    UserNotification::create([
                        'to' => $request->userid,
                        'from', Auth::user()->Account_number,
                        'message' => 'لقد قام '.Auth::user()->frist_name.' بالغاء العقد معك على صفقة <a href="'.asset('/order/'.$request->OID).'">#'.$request->OID.'</a>',
                        'notifybyemail' => "1",
                        'email_status' => "0"
                    ]);
                }else{
            return response()->json(['error' => 'حدث خطأ ما يرجى اعادة المحاولة, اذا استمر معك الخطأ يرجى التواصل معنا CODE:CA260512'], 500);

                }
            }else{
            return response()->json(['error' => 'حدث خطأ ما يرجى اعادة المحاولة, اذا استمر معك الخطأ يرجى التواصل معنا CODE:CA260512'], 500);

            }
        }else{
            return response()->json(['error' => 'bad Request'], 400);
        }

    }
}
