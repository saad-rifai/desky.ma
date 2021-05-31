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
    public function bingapay(){
        $externalId = rand(111111111111111,999999999999999);
        $str = "PRE-PAY"."199"."4010".$externalId."rifaisaad3@gmail.com"."4010653ddd7e9b8cece2779bbed423ce";
        $orderCheckSum = md5($str);
        $client = new Client([
            'base_uri' => 'http://preprod.binga.ma'
        ]);

        $response = $client->request('POST',
            '/bingaApi/api/orders/json/pay',
            [
                'auth' => ['Binga.ma', 'Binga'],
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                'form_params' => [
                    'apiVersion' => '1.1',
                    'externalId' => $externalId,
                    'expirationDate' => '2021-05-01T10:30:30GMT',
                    'amount' => '199',
                    'storeId' => '4010',
                    'payUrl' => 'https://desky.ma/?ref=test',
                    'buyerFirstName' => 'Saad',
                    'buyerLastName' => 'Rifai   ',
                    'buyerEmail' => 'rifaisaad3@gmail.com',
                    'buyerAddress' => 'NULL',
                    'buyerPhone' => '06671013733',
                    'orderCheckSum' => $orderCheckSum
                ]

            ]
        );

    return $response;
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
            '4010'.
            $PayInfo->transaction_id.
            $PayInfo->buyer_email .
            '4010653ddd7e9b8cece2779bbed423ce';
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
