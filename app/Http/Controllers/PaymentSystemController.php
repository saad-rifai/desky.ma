<?php

namespace App\Http\Controllers;

use App\PaymentSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Subscriptions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function CheckSubscriptions(){
         $user_email = Auth::user()->email;
         $packs =  DB::table('subscriptions')
         ->join('payment_systems', 'payment_systems.OID', '=', 'subscriptions.OID')
         ->select('subscriptions.*', 'payment_systems.status','payment_systems.code')
         ->where('email', Auth::user()->email)
         ->where('payment_systems.buyer_email', Auth::user()->email)
         ->get();
         $points = 0;
         $unlimited = NULL;
         foreach($packs as $pack){
             if($pack->status == 1){
             if($pack->pack_id == 1){
                 if($pack->type == "m"){
                    $olddate = Carbon::parse($pack->created_at);
                    $exdate = $olddate->addDays(31);
                    $timenow = date("Y-m-d H:i:s");
                    if ($timenow < $exdate) {
                        $points = ($points + $pack->point);
                    }
                 }elseif($pack->type == "y"){
                    $olddate = Carbon::parse($pack->created_at);
                    $exdate = $olddate->addDays(366);
                    $timenow = date("Y-m-d H:i:s");
                    if ($timenow < $exdate) {
                        $points = ($points + $pack->point);
                    }
                 }
             }elseif($pack->pack_id == 2){
                if($pack->type == "m"){
                   $olddate = Carbon::parse($pack->created_at);
                   $exdate = $olddate->addDays(31);
                   $timenow = date("Y-m-d H:i:s");
                   if ($timenow < $exdate) {
                       $points = ($points + $pack->point);
                   }
                }elseif($pack->type == "y"){
                   $olddate = Carbon::parse($pack->created_at);
                   $exdate = $olddate->addDays(366);
                   $timenow = date("Y-m-d H:i:s");
                   if ($timenow < $exdate) {
                       $points = ($points + $pack->point);
                   }
                }
            }elseif($pack->pack_id == 3){
                if($pack->type == "m"){
                   $olddate = Carbon::parse($pack->created_at);
                   $exdate = $olddate->addDays(31);
                   $timenow = date("Y-m-d H:i:s");
                   if ($timenow < $exdate) {
                       $points = ($points + $pack->point);
                       $unlimited = true;

                   }
                }elseif($pack->type == "y"){
                   $olddate = Carbon::parse($pack->created_at);
                   $exdate = $olddate->addDays(366);
                   $timenow = date("Y-m-d H:i:s");
                   if ($timenow < $exdate) {
                       $points = ($points + $pack->point);
                       $unlimited = true;

                   }
                }
            }
        }
         }
         return array('points' => $points, 'unlimited' => $unlimited);
     }
    public function index(Request $request)
    {
        $transaction_id = $request->id;
        $OID = $request->OID;
        $PayInfos = DB::table('payment_systems')
        ->where('transaction_id', $transaction_id )
        ->where('OID', '#'.$OID)
        ->get();

        $countPayInfo = $PayInfos->count();
        if($countPayInfo > 0){
            foreach($PayInfos as $PayInfo);
            $amount = $PayInfo->amount;
            $SID = $PayInfo->object;
            $nameservices = DB::table('services')
            ->where('SID', $SID )
            ->get();
            foreach($nameservices as $nameservice);
            $nameservice = $nameservice->name;
            return view('payments', ['amount' => $amount, 'nameservice' => $nameservice]);

        }else{
            abort(404, 'Page not found');

        }
    }
    public function api(Request $request)
    {
        $transaction_id = $request->id;
        $OID = $request->OID;
        $PayInfos = DB::table('payment_systems')
        ->where('transaction_id', $transaction_id )
        ->where('OID', '#'.$OID)
        ->get();

        $countPayInfo = $PayInfos->count();
        if($countPayInfo > 0){
            foreach($PayInfos as $PayInfo);
            $amount = $PayInfo->amount;
            $SID = $PayInfo->object;
            $nameservices = DB::table('services')
            ->where('SID', $SID )
            ->get();
            foreach($nameservices as $nameservice);
            $nameservice = $nameservice->name;
            $infosall = array($PayInfo, $nameservice);
            return response()->json($infosall);

        }else{
            abort(404, 'Page not found');

        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function bingapay(Request $request){
        $email=$request->email;
        $fname=$request->fname;
        $lname=$request->lname;
        $phone=$request->phone;
        $amount=$request->amount;

        $permitted_chars = '0123456789';

function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}



        $externalId = generate_string($permitted_chars,13);
        $OID = generate_string($permitted_chars,13);
        $str = "PRE-PAY"."$amount"."401090".$externalId."$email"."21af6d8381101b46e1010cc1f11901ed14cae0b9";
        $orderCheckSum = md5($str);
        $client = new Client([
            'base_uri' => 'https://api.binga.ma'
        ]);
        $d = Carbon::parse(date("Y-m-d"));
        $adddays = $d->addDays(15);
        $date = date("Y-m-d", strtotime($adddays));

        $exdate=$date."T".date("H:i:s").'GMT';
       // $date = Carbon::parse();
        //$exdate = $date->addDays(15);

        $response = $client->request('POST',
            '/bingaApi/api/orders/pay',
            [
                'auth' => ['moqawala.ma', 'M0Q@wala@0621'],
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                'form_params' => [
                    'apiVersion' => '1.1',
                    'externalId' => $externalId,
                    'expirationDate' => "$exdate",
                    'amount' => "$amount",
                    'storeId' => '401090',
                    'payUrl' => 'https://s.moqawala.ma/api/v1/partner/binga/notif',
                    'buyerFirstName' => "$$fname",
                    'buyerLastName' => "$lname",
                    'buyerEmail' => "$email",
                    'buyerAddress' => 'NULL',
                    'buyerPhone' => "$phone",
                    'orderCheckSum' => $orderCheckSum
                ]

            ]
        );

    $res = $response->getBody();
    $someArray = json_decode($res, true);
    /*$status  = $someArray['result'];
    if($status == "success"){
        $orderdata = $someArray['orders']['order'];
        $r_amount = $orderdata['amount'];
        $r_externalId = $orderdata['externalId'];
        $r_code = $orderdata['code'];
        $r_email = $orderdata['buyerEmail'];
        $c_status =  $orderdata['status'];
        $c_totalAmount =  $orderdata['totalAmount'];
        $stmt = PaymentSystem::create([
            'OID' => $OID,
            'buyer_email' => $email,
            'transaction_id' => $externalId,
            'amount' => $amount,
            'status' => 0,
            'object' => '4',
            'code' => $r_code,
            'id_addr' => $request->ip(),
            'method' => '1'
        ]);
        if($stmt){
            return response("La demande numéro ".$r_code." a été créée. Vous pouvez vous rendre dans l'une des agences Wafacach pour payer en espèces Montant total:".$c_totalAmount, 200);
        }else{
            return response("Votre demande n'a pas pu être créée", 500);
        }
        //return response(['Amount' => $r_amount, 'r_externalId' => $r_externalId, 'r_code' => $r_code, 'r_email' => $r_email, 'c_status' => $c_status, 'c_totalAmount'=> $c_totalAmount]);
    }else{

        return $response->getBody().'<br> '.$exdate;
    }
*/
print_r($someArray);


    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function binga_notification(Request $request){
        if(isset($request->code) && is_numeric($request->code) && is_numeric($request->externalId) && isset($request->externalId) && isset($request->expirationDate) && isset($request->amount) && isset($request->buyerEmail) && isset($request->orderCheckSum)){
          $code = htmlspecialchars($request->code);
          $transaction_id = htmlspecialchars($request->externalId);
          $email = htmlspecialchars($request->buyerEmail);
          $PayInfos = DB::table('payment_systems')
          ->where('transaction_id', $transaction_id)
          ->where('code', $code)
          ->where('buyer_email', $email)
          ->get();
          foreach($PayInfos as $PayInfo);
          if($PayInfos->count() > 0){
              $amount =  $PayInfo->amount.'.00';

            $str =
            'PAY'.
            $amount.
            '401090'.
            $PayInfo->transaction_id.
            $PayInfo->buyer_email .
            '21af6d8381101b46e1010cc1f11901ed14cae0b9';
            $myhash = md5($str);

            if($request->orderCheckSum == $myhash){
                $stmt =  DB::table('payment_systems')
                ->where('transaction_id', $transaction_id)
                ->where('code', $code)
                ->where('buyer_email', $email)->update(['status' => 1]);
                if($stmt){
                    $date = date("Y-m-d\TH:i:s");
                    return response('100;'.$date)->setStatusCode(200);
                }else{
                    $date = date("Y-m-d\TH:i:s");
                    return response('000;'.$date)->setStatusCode(500);
                }

            }else{
                $date = date("Y-m-d\TH:i:s");
                return response('000;'.$date)->setStatusCode(500);
            }



          }else{
            $date = date("Y-m-d\TH:i:s");
            return response('000;'.$date)->setStatusCode(500);
          }


        }else{
            $date = date("Y-m-d\TH:i:s");
            return response('000;'.$date)->setStatusCode(500);

        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentSystem  $paymentSystem
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentSystem $paymentSystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentSystem  $paymentSystem
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentSystem $paymentSystem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentSystem  $paymentSystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentSystem $paymentSystem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentSystem  $paymentSystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentSystem $paymentSystem)
    {
        //
    }
}
