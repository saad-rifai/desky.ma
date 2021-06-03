<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MyCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\AlgNoAuthController;
class MyCartController extends Controller
{
    public function AddToCart(Request $request){
        if(isset($request->p_id) && isset($request->pk_id) && isset($request->token) && is_numeric($request->p_id) && is_numeric($request->pk_id) && isset($request->type)){
            if($request->type == "m" || $request->type == "y"){
            $datajson = file_get_contents('database/data.json');
            $jsondata = json_decode($datajson, true);
            if(isset($jsondata['_'.$request->p_id]['packs'][$request->pk_id])){
                $AlgNoAuthController = new AlgNoAuthController;
                $OID = $AlgNoAuthController->generateOrderID();
                function generateRandomString($length)
                {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }

                    return $randomString;
                }
                $cookie_id = generateRandomString(35);
                if (!Auth::check()) {
                $stmt = MyCart::create([
                    'OID' => $OID,
                    'email' => null,
                    'UID' => null,
                    'cookie_id' => $cookie_id,
                    'P_ID' => $request->p_id,
                    'PK_ID' => $request->pk_id,
                    'type' => $request->type

                ]);
                if($stmt){
                    Cookie::queue('cart_id', $cookie_id, '720');
                    return redirect('http://account.' . env('APP_URL').'/register?CallCookie&t='.$request->token.'&oid='.$OID.'&s='.$cookie_id);

                }else{
                    return abort(500);
                }

                }else{
                    $stmt = MyCart::create([
                        'OID' => $OID,
                        'email' => Auth::user()->email,
                        'UID' => Auth::user()->id,
                        'cookie_id' => $cookie_id,
                        'P_ID' => $request->p_id,
                        'PK_ID' => $request->pk_id,
                        'type' => $request->type


                    ]);
                    if($stmt){
                        Cookie::queue('cart_id', $cookie_id, '720');
                        return redirect('/pay/'.Auth::user()->id.'/'.$OID);

                    }else{
                        return abort(500);
                    }
                }
            }else{
                abort(400);
            }
        }else{
            abort(400);
        }
        }else{
            abort(400);
        }
    }
    public function getCartInfos(Request $request){
        if(isset($request->OID) && $request->OID != "" && is_numeric($request->OID)){
            $stmt = MyCart::all()->where('UID', Auth::user()->id)->where('email', Auth::user()->email)->where('OID', $request->OID)->where('status', 0);

            if($stmt->count() > 0){
            $datajson = file_get_contents('database/data.json');
            $jsondata = json_decode($datajson, true);
            foreach($stmt as $st);
            $pk_id= $st->PK_ID;
            $p_id= $st->P_ID;
            if($st->type == "m"){
                $product_name = strval($jsondata['_'.$p_id]['packs'][$pk_id]['name']);
                $product_price = intval($jsondata['_'.$p_id]['packs'][$pk_id]['price']);
                $product_save = intval($jsondata['_'.$p_id]['packs'][$pk_id]['save']);

                return response()->json(['product_name' => $product_name, 'product_price' => $product_price, 'product_save' => $product_save, 'type' => $st->type, 'pack_id' => $st->PK_ID], 200);

            }elseif($st->type == "y"){
                $product_name = strval($jsondata['_'.$p_id]['packs'][$pk_id]['name']);
                $product_price = intval($jsondata['_'.$p_id]['packs'][$pk_id]['price_year']);
                $product_save = intval($jsondata['_'.$p_id]['packs'][$pk_id]['save']);

                return response()->json(['product_name' => $product_name, 'product_price' => $product_price, 'product_save' => $product_save, 'type' => $st->type, 'pack_id' => $st->PK_ID], 200);


            }
        }else{
            abort(404);
        }






        }else{
            abort(400);
        }
    }
    public function updateCart(Request $request){
        if(isset($request->OID) && isset($request->PK_ID) && isset($request->type) && $request->OID != "" && is_numeric($request->OID) && is_numeric($request->PK_ID)){

            $stmt = MyCart::where('email', Auth::user()->email)->where('OID', $request->OID)->get(['OID']);
            if(count($stmt) > 0){
                $update = MyCart::where('email', Auth::user()->email)->where('OID', $request->OID)->update([
                    'type' => $request->type,
                    'PK_ID' => $request->PK_ID
                    ]);
                    if($update){
                        return response()->json(['success' => 'Cart Updated'], 200);
                    }else{
                        abort(500);
                    }
            }else{
                abort(400);
            }

        }else{
            abort(400);
        }
    }
}
