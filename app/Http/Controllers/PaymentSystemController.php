<?php

namespace App\Http\Controllers;

use App\PaymentSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Subscriptions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\MyCart;
use App\Http\Controllers\AlgNoAuthController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\NotificationPushController;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrder;
use Swift_SmtpTransport;
use Swift_Mailer;
use App\Mail\SuccessPayments;
class PaymentSystemController extends Controller
{
    public function CheckSubscriptions()
    {
        $user_email = Auth::user()->email;
        $packs = DB::table('subscriptions')
            ->join(
                'payment_systems',
                'payment_systems.OID',
                '=',
                'subscriptions.OID'
            )
            ->select(
                'subscriptions.*',
                'payment_systems.status',
                'payment_systems.code'
            )
            ->where('email', Auth::user()->email)
            ->where('payment_systems.buyer_email', Auth::user()->email)
            ->get();
        $points = 0;
        $unlimited = null;
        foreach ($packs as $pack) {
            if ($pack->status == 1) {
                if ($pack->pack_id == 1) {
                    if ($pack->type == 'm') {
                        $olddate = Carbon::parse($pack->created_at);
                        $exdate = $olddate->addDays(31);
                        $timenow = date('Y-m-d H:i:s');
                        if ($timenow < $exdate) {
                            $points = $points + $pack->point;
                        }
                    } elseif ($pack->type == 'y') {
                        $olddate = Carbon::parse($pack->created_at);
                        $exdate = $olddate->addDays(366);
                        $timenow = date('Y-m-d H:i:s');
                        if ($timenow < $exdate) {
                            $points = $points + $pack->point;
                        }
                    }
                } elseif ($pack->pack_id == 2) {
                    if ($pack->type == 'm') {
                        $olddate = Carbon::parse($pack->created_at);
                        $exdate = $olddate->addDays(31);
                        $timenow = date('Y-m-d H:i:s');
                        if ($timenow < $exdate) {
                            $points = $points + $pack->point;
                        }
                    } elseif ($pack->type == 'y') {
                        $olddate = Carbon::parse($pack->created_at);
                        $exdate = $olddate->addDays(366);
                        $timenow = date('Y-m-d H:i:s');
                        if ($timenow < $exdate) {
                            $points = $points + $pack->point;
                        }
                    }
                } elseif ($pack->pack_id == 3) {
                    if ($pack->type == 'm') {
                        $olddate = Carbon::parse($pack->created_at);
                        $exdate = $olddate->addDays(31);
                        $timenow = date('Y-m-d H:i:s');
                        if ($timenow < $exdate) {
                            $points = $points + $pack->point;
                            $unlimited = true;
                        }
                    } elseif ($pack->type == 'y') {
                        $olddate = Carbon::parse($pack->created_at);
                        $exdate = $olddate->addDays(366);
                        $timenow = date('Y-m-d H:i:s');
                        if ($timenow < $exdate) {
                            $points = $points + $pack->point;
                            $unlimited = true;
                        }
                    }
                }
            }
        }
        return ['points' => $points, 'unlimited' => $unlimited];
    }
    public function index(Request $request)
    {
        if (
            isset($request->id) &&
            isset($request->OID) &&
            is_numeric($request->OID) &&
            is_numeric($request->id)
        ) {
            $stmt = MyCart::where('UID', Auth::user()->id)
                ->where('email', Auth::user()->email)
                ->where('OID', $request->OID)
                ->where('status', 0)
                ->get(['OID']);
            foreach ($stmt as $oid);
            if (count($stmt) > 0) {
                $loid = json_encode($oid, true);
                $data = json_decode($loid, true);

                return view('payments', ['oid' => $data['OID']]);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
    public function api(Request $request)
    {
        $transaction_id = $request->id;
        $OID = $request->OID;
        $PayInfos = DB::table('payment_systems')
            ->where('transaction_id', $transaction_id)
            ->where('OID', '#' . $OID)
            ->get();

        $countPayInfo = $PayInfos->count();
        if ($countPayInfo > 0) {
            foreach ($PayInfos as $PayInfo);
            $amount = $PayInfo->amount;
            $SID = $PayInfo->object;
            $nameservices = DB::table('services')
                ->where('SID', $SID)
                ->get();
            foreach ($nameservices as $nameservice);
            $nameservice = $nameservice->name;
            $infosall = [$PayInfo, $nameservice];
            return response()->json($infosall);
        } else {
            abort(404, 'Page not found');
        }
    }

    public function bingapay(
        $email,
        $fname,
        $lname,
        $phone,
        $amount,
        $PID,
        $pack_id,
        $points,
        $type,
        $OID
    ) {
        $NotificationPushController = new NotificationPushController();

        $externalId = $OID;

        $str =
            'PRE-PAY' .
            "$amount" .
            '401090' .
            $externalId .
            "$email" .
            '21af6d8381101b46e1010cc1f11901ed14cae0b9';
        $orderCheckSum = md5($str);
        $client = new Client([
            'base_uri' => env('BINGA_PD_API'),
        ]);
        $d = Carbon::parse(date('Y-m-d'));
        $adddays = $d->addDays(15);
        $date = date('Y-m-d', strtotime($adddays));

        $exdate = $date . 'T' . date('H:i:s') . 'GMT';
        // $date = Carbon::parse();
        //$exdate = $date->addDays(15);

        $response = $client->request('POST', env('BINGA_CREATE_COMMANDE_API'), [
            'auth' => ['moqawala.ma', 'M0Q@wala@0621'],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'apiVersion' => '1.1',
                'externalId' => $externalId,
                'expirationDate' => "$exdate",
                'amount' => "$amount",
                'storeId' => '401090',
                'payUrl' => 'https://s.moqawala.ma/api/v1/partner/binga/notif',
                'buyerFirstName' => "$fname",
                'buyerLastName' => "$lname",
                'buyerEmail' => "$email",
                'buyerAddress' => 'NULL',
                'buyerPhone' => "$phone",
                'orderCheckSum' => $orderCheckSum,
            ],
        ]);

        $res = $response->getBody();
        $someArray = json_decode($res, true);
        $status = $someArray['result'];
        if ($status == 'success') {
            $orderdata = $someArray['orders']['order'];
            $r_amount = $orderdata['amount'];
            $r_externalId = $orderdata['externalId'];
            $r_code = $orderdata['code'];
            $r_email = $orderdata['buyerEmail'];
            $c_status = $orderdata['status'];
            $c_totalAmount = $orderdata['totalAmount'];
            $c_frais = intval($orderdata['totalAmount']) - intval($amount);
            $r_expirationDate = date(
                'Y-m-d H:i:s',
                strtotime($orderdata['expirationDate'])
            );
            $stmt = PaymentSystem::create([
                'OID' => $OID,
                'buyer_email' => $email,
                'transaction_id' => $externalId,
                'amount' => $amount,
                'frais' => $c_frais,
                'status' => 0,
                'object' => '4',
                'code' => $r_code,
                'id_addr' => request()->ip(),
                'method' => '1',
                'exDate' => $r_expirationDate,
            ]);
            if ($stmt) {
                $subs = Subscriptions::create([
                    'OID' => $OID,
                    'email' => $email,
                    'pr_name' => 'Desky',
                    'PID' => $PID,
                    'auto_pay' => 0,
                    'pack_id' => $pack_id,
                    'point' => $points,
                    'start_at' => null,
                    'type' => $type,
                ]);
                if ($subs) {
                    $subject = 'طلب رقم #' . $OID;
                    $message =
                        'تم انشاء طلبك رقم #' .
                        $OID .
                        ' يجب أن تتوجه الى أقرب وكالة وفاكاش من أجل أداء تكلفة الطلب قبل ' .
                        $exdate .
                        ' رمز الأداء (يجب أن تزود موظف وفاكاش بهذا الرقم): ' .
                        $r_code;
                    $link = '/recu/' . $OID;
                    $NotificationPushController->SendPush(
                        $email,
                        'payments@desky.ma',
                        '0',
                        $subject,
                        $message,
                        $link
                    );
                    return response(['sucess' => 'succes subs'], 200);
                } else {
                    return response(['error' => 'error subs '], 400);
                }
            } else {
                return response(['error' => 'error fx0035 '], 400);
            }

            //return response(['Amount' => $r_amount, 'r_externalId' => $r_externalId, 'r_code' => $r_code, 'r_email' => $r_email, 'c_status' => $c_status, 'c_totalAmount'=> $c_totalAmount]);
        } else {
            return response()->json(['error' => 'BINGA::ERROR'], 400);
        }
    }

    public function binga_notification(Request $request)
    {
        if (
            isset($request->code) &&
            is_numeric($request->code) &&
            is_numeric($request->externalId) &&
            isset($request->externalId) &&
            isset($request->expirationDate) &&
            isset($request->amount) &&
            isset($request->buyerEmail) &&
            isset($request->orderCheckSum)
        ) {
            $code = htmlspecialchars($request->code);
            $transaction_id = htmlspecialchars($request->externalId);
            $email = htmlspecialchars($request->buyerEmail);
            $PayInfos = DB::table('payment_systems')
                ->where('transaction_id', $transaction_id)
                ->where('code', $code)
                ->where('buyer_email', $email)
                ->get();
            foreach ($PayInfos as $PayInfo);
            if ($PayInfos->count() > 0) {
                $amount = $PayInfo->amount;

                $str =
                    'PAY' .
                    $amount .
                    '401090' .
                    $PayInfo->transaction_id .
                    $PayInfo->buyer_email .
                    '21af6d8381101b46e1010cc1f11901ed14cae0b9';
                $myhash = md5($str);

                if ($request->orderCheckSum == $myhash) {
                    $stmt = DB::table('payment_systems')
                        ->where('transaction_id', $transaction_id)
                        ->where('code', $code)
                        ->where('buyer_email', $email)
                        ->update(['status' => 1]);

                    if ($stmt) {
                        $date = date('Y-m-d\TH:i:s');
                        return response('100;' . $date)->setStatusCode(200);

                        //Send Notification
                      /*  $NotificationPushController = new NotificationPushController();
                        $subject = '! تم تفعيل باقتك';
                        $message =
                            'مرحبا نعلمك بأنه قد تلقينا دفعتك وقد تم تفعيل باقتك, طلب رقم ' .
                            $transaction_id .
                            '';
                        $link = '/recu/' . $transaction_id;
                        $NotificationPushController->SendPush(
                            $email,
                            'sales@desky.ma',
                            '0',
                            $subject,
                            $message,
                            $link
                        );

                        //SendMail

                        // Do
                        $backup = Mail::getSwiftMailer();

                        $transport = new Swift_SmtpTransport(
                            'desky.ma',
                            465,
                            'ssl'
                        );
                        $transport->setUsername('info@desky.ma');
                        $transport->setPassword('C^CjgA9(XVbC');
                        $gmail = new Swift_Mailer($transport);

                        // Set the mailer as gmail
                        Mail::setSwiftMailer($gmail);

                        // Set the mailer as gmail
                        Mail::setSwiftMailer($gmail);
                        $valueArray = [
                            'OID' => "$transaction_id",
                            'amount' => "$amount",
                        ];

                        try {
                            Mail::to($email)->send(
                                new SuccessPayments($valueArray)
                            );
                            //return 'Mail send successfully';
                        } catch (\Exception $e) {
                        }*/
                    } else {
                        $date = date('Y-m-d\TH:i:s');
                        return response('000;' . $date)->setStatusCode(500);
                    }
                } else {
                    $date = date('Y-m-d\TH:i:s');
                    return response('000;' . $date)->setStatusCode(500);
                }
            } else {
                $date = date('Y-m-d\TH:i:s');
                return response('000;' . $date)->setStatusCode(500);
            }
        } else {
            $date = date('Y-m-d\TH:i:s');
            return response('000;' . $date)->setStatusCode(500);
        }
    }
    public function PaymentProcessing(Request $request)
    {
        if (
            isset($request->token) &&
            isset($request->OID) &&
            isset($request->m) &&
            is_numeric($request->OID) &&
            $request->OID != '' &&
            $request->m != '' &&
            is_numeric($request->m) &&
            $request->m > 0
        ) {
            $csrf_toekn = Session::token();

            if ($request->token == $csrf_toekn) {
                $data = file_get_contents('database/data.json');
                $json = json_decode($data, true);
                if (isset($json['methods_de_paymetnts'][$request->m])) {
                    $datas = MyCart::all()
                        ->where('email', Auth::user()->email)
                        ->where('UID', Auth::user()->id)
                        ->where('OID', $request->OID);
                    if ($datas->count() > 0) {
                        $checkPaymetsTabel = PaymentSystem::where(
                            'buyer_email',
                            Auth::user()->email
                        )
                            ->where('OID', $request->OID)
                            ->get(['OID']);
                        if (count($checkPaymetsTabel) > 0) {
                            return response()->json(
                                ['success' => 'طلبك تم انشائه بالفعل'],
                                200
                            );
                        } else {
                            if ($request->m == '1') {
                                foreach ($datas as $data);
                                if (
                                    isset(
                                        $json['_' . $data->P_ID]['packs'][
                                            $data->PK_ID
                                        ]
                                    )
                                ) {
                                    $PID = $data->P_ID;
                                    $pack_id = $data->PK_ID;
                                    $type = $data->type;
                                    $OID = $request->OID;
                                    if ($data->type == 'm') {
                                        $amount =
                                            $json['_' . $data->P_ID]['packs'][
                                                $data->PK_ID
                                            ]['price'];
                                        $points =
                                            $json['_' . $data->P_ID]['packs'][
                                                $data->PK_ID
                                            ]['points'];
                                        $bingaPay = $this->bingapay(
                                            Auth::user()->email,
                                            Auth::user()->fname,
                                            Auth::user()->lname,
                                            Auth::user()->phonenumb,
                                            $amount,
                                            $PID,
                                            $pack_id,
                                            $points,
                                            $type,
                                            $OID
                                        );
                                    } elseif ($data->type == 'y') {
                                        $points =
                                            intval(
                                                $json['_' . $data->P_ID][
                                                    'packs'
                                                ][$data->PK_ID]['points']
                                            ) * 12;

                                        $amount =
                                            $json['_' . $data->P_ID]['packs'][
                                                $data->PK_ID
                                            ]['price_year'];
                                        $bingaPay = $this->bingapay(
                                            Auth::user()->email,
                                            Auth::user()->fname,
                                            Auth::user()->lname,
                                            Auth::user()->phonenumb,
                                            $amount,
                                            $PID,
                                            $pack_id,
                                            $points,
                                            $type,
                                            $OID
                                        );
                                    } else {
                                        return response()->json([
                                            'error' =>
                                                'تعذر انشاء الطلب fx00457',
                                        ]);
                                    }

                                    if (isset($bingaPay) && $bingaPay) {
                                        return response()->json(
                                            [
                                                'success' =>
                                                    'تم انشاء الطلب بنجاح',
                                            ],
                                            200
                                        );
                                    } else {
                                        return response()->json([
                                            'error' =>
                                                'فشل انشاء الطلب fx00332',
                                        ]);
                                    }
                                } else {
                                    return response()->json([
                                        'error' => 'فشل انشاء الطلب fx00336',
                                    ]);
                                }
                            } elseif ($request->m == '2') {
                                foreach ($datas as $data);
                                if (
                                    isset(
                                        $json['_' . $data->P_ID]['packs'][
                                            $data->PK_ID
                                        ]
                                    )
                                ) {
                                    $PID = $data->P_ID;
                                    $pack_id = $data->PK_ID;
                                    $type = $data->type;
                                    $OID = $request->OID;
                                    if ($data->type == 'm') {
                                        $amount =
                                            $json['_' . $data->P_ID]['packs'][
                                                $data->PK_ID
                                            ]['price'];
                                        $points =
                                            $json['_' . $data->P_ID]['packs'][
                                                $data->PK_ID
                                            ]['points'];

                                        $d = Carbon::parse(date('Y-m-d h:i:s'));
                                        $adddays = $d->addDays(15);
                                        $exDate = date(
                                            'Y-m-d h:i:s',
                                            strtotime($adddays)
                                        );
                                        $stmt = PaymentSystem::create([
                                            'OID' => $OID,
                                            'transaction_id' => $OID,
                                            'buyer_email' => Auth::user()
                                                ->email,
                                            'amount' => $amount,
                                            'frais' => 0,
                                            'status' => 0,
                                            'object' => 4,
                                            'code' => null,
                                            'id_addr' => request()->ip(),
                                            'method' => '2',
                                            'exDate' => $exDate,
                                        ]);
                                        if ($stmt) {
                                            $subs = Subscriptions::create([
                                                'OID' => $OID,
                                                'email' => Auth::user()->email,
                                                'pr_name' => 'Desky',
                                                'PID' => $PID,
                                                'auto_pay' => 0,
                                                'pack_id' => $pack_id,
                                                'point' => $points,
                                                'start_at' => null,
                                                'type' => $type,
                                            ]);
                                        } else {
                                            return response()->json([
                                                'error' =>
                                                    'تعذر انشاء الطلب fx00490',
                                            ]);
                                        }
                                    } elseif ($data->type == 'y') {
                                        $points =
                                            intval(
                                                $json['_' . $data->P_ID][
                                                    'packs'
                                                ][$data->PK_ID]['points']
                                            ) * 12;

                                        $amount =
                                            $json['_' . $data->P_ID]['packs'][
                                                $data->PK_ID
                                            ]['price_year'];
                                        $d = Carbon::parse(date('Y-m-d h:i:s'));
                                        $adddays = $d->addDays(15);
                                        $exDate = date(
                                            'Y-m-d h:i:s',
                                            strtotime($adddays)
                                        );
                                        $stmt = PaymentSystem::create([
                                            'OID' => $OID,
                                            'transaction_id' => $OID,
                                            'buyer_email' => Auth::user()
                                                ->email,
                                            'amount' => $amount,
                                            'frais' => 0,
                                            'status' => 0,
                                            'object' => 4,
                                            'code' => null,
                                            'id_addr' => request()->ip(),
                                            'method' => '2',
                                            'exDate' => $exDate,
                                        ]);
                                        if ($stmt) {
                                            $subs = Subscriptions::create([
                                                'OID' => $OID,
                                                'email' => Auth::user()->email,
                                                'pr_name' => 'Desky',
                                                'PID' => $PID,
                                                'auto_pay' => 0,
                                                'pack_id' => $pack_id,
                                                'point' => $points,
                                                'start_at' => null,
                                                'type' => $type,
                                            ]);
                                        } else {
                                            return response()->json([
                                                'error' =>
                                                    'تعذر انشاء الطلب fx00490',
                                            ]);
                                        }
                                    } else {
                                        return response()->json([
                                            'error' =>
                                                'تعذر انشاء الطلب fx00457',
                                        ]);
                                    }

                                    if ($subs) {
                                        $NotificationPushController = new NotificationPushController();
                                        $subject = 'طلب رقم #' . $OID;
                                        $message =
                                            'تم انشاء طلبك رقم #' .
                                            $OID .
                                            'ندعوك الى اجراء تحويل بنكي من أجل تفعيل باقتك قبل تاريخ ' .
                                            $exDate;
                                        $link = '/recu/' . $OID;
                                        $NotificationPushController->SendPush(
                                            Auth::user()->email,
                                            'sales@desky.ma',
                                            '0',
                                            $subject,
                                            $message,
                                            $link
                                        );
                                        // Do
                                        $backup = Mail::getSwiftMailer();

                                        $transport = new Swift_SmtpTransport(
                                            'desky.ma',
                                            465,
                                            'ssl'
                                        );
                                        $transport->setUsername(
                                            'info@desky.ma'
                                        );
                                        $transport->setPassword('C^CjgA9(XVbC');
                                        $gmail = new Swift_Mailer($transport);

                                        // Set the mailer as gmail
                                        Mail::setSwiftMailer($gmail);

                                        // Set the mailer as gmail
                                        Mail::setSwiftMailer($gmail);
                                        $valueArray = [
                                            'OID' => "$OID",
                                            'method' => '2',
                                            'amount' => "$amount",
                                            'frais' => '0.00',
                                            'total' => "$amount",
                                            'exDate' => "$exDate",
                                        ];

                                        try {
                                            Mail::to(Auth::user()->email)->send(
                                                new NewOrder($valueArray)
                                            );
                                            //return 'Mail send successfully';
                                        } catch (\Exception $e) {
                                        }

                                        return response()->json(
                                            [
                                                'success' =>
                                                    'تم انشاء الطلب بنجاح',
                                            ],
                                            200
                                        );
                                    } else {
                                        return response()->json([
                                            'error' =>
                                                'فشل انشاء الطلب fx00332',
                                        ]);
                                    }
                                } else {
                                    return response()->json([
                                        'error' => 'فشل انشاء الطلب fx00336',
                                    ]);
                                }
                            }
                        }
                        // return response()->json(['success' => 'Votre demande a été créée'], 200);
                    } else {
                        return response()->json(
                            ['error' => 'فشل انشاء طلبك يرجى اعادة المحاولة'],
                            400
                        );
                    }
                } else {
                    return response()->json(
                        ['error' => 'طريقة الدفع غير مدعومة !'],
                        400
                    );
                }
            } else {
                return response()->json(
                    ['error' => 'لم يتم الترخيص لهذا الطلب Token'],
                    401
                );
            }
        } else {
            return response()->json(['error' => 'طلب خاطئ'], 400);
        }
        /*if(isset($request->OID))*/
    }
    public function RecuShow(Request $request)
    {
        if (isset($request->OID) && is_numeric($request->OID)) {
            $email = Auth::user()->email;
            $infos = DB::table('subscriptions')
                ->join(
                    'payment_systems',
                    'payment_systems.OID',
                    '=',
                    'subscriptions.OID'
                )
                ->select(
                    'subscriptions.PID',
                    'subscriptions.pack_id',
                    'subscriptions.email',
                    'subscriptions.type',
                    'payment_systems.*'
                )
                ->where('subscriptions.email', Auth::user()->email)
                ->where('payment_systems.buyer_email', Auth::user()->email)
                ->where('payment_systems.OID', $request->OID)
                ->get();

            if (count($infos) > 0) {
                foreach ($infos as $info);
                if ($info->method == '1') {
                    return view('desky.invoice', [
                        'OID' => $request->OID,
                        'CODE' => $info->code,
                        'method' => '1',
                        'PID' => $info->PID,
                        'pack_id' => $info->pack_id,
                        'type' => $info->type,
                        'amount' => $info->amount,
                        'frais' => $info->frais,
                        'status' => $info->status,
                        'exDate' => $info->exDate,
                    ]);
                } elseif ($info->method == '2') {
                    return view('desky.invoice', [
                        'OID' => $request->OID,
                        'transaction_id' => $info->transaction_id,
                        'method' => '2',
                        'PID' => $info->PID,
                        'pack_id' => $info->pack_id,
                        'type' => $info->type,
                        'amount' => $info->amount,
                        'frais' => $info->frais,
                        'status' => $info->status,
                        'exDate' => $info->exDate,
                    ]);
                } else {
                    abort(500);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
    public function UploadRecu(Request $request)
    {
        if (
            isset($request->token) &&
            $request->token == Session::token() &&
            isset($request->recuFile) &&
            isset($request->OID) &&
            is_numeric($request->OID)
        ) {
            $this->validate(
                $request,
                [
                    'recuFile' => 'required|mimes:png,jpg,jpeg,pdf|max:1000',
                ],
                $message = [
                    'required' => 'يرجى رفع وصل الأداء *',
                    'mimes' =>
                        'هذا الملف غير مدعوم يسمح فقط ب (jpg,png,jpeg,pdf)',
                    'max' => 'هذا الملف أكبر من المسموح به الحد الأقصى 1M',
                ]
            );

            // Check Order
            $Check = PaymentSystem::where('OID', $request->OID)
                ->where('buyer_email', Auth::user()->email)
                ->where('status', 0)
                ->where('method', 2)
                ->get(['OID']);
            if (count($Check) > 0) {
            } else {
                return response()->json(['error' => 'طلب خاطئ'], 400);
            }
            $rand = rand(1111, 9999);
            $ext = $request->recuFile->getClientOriginalExtension();
            $file_name =
                $request->OID .
                '_' .
                $rand .
                '_' .
                date('m-d_H_i_s') .
                '.' .
                $ext;
            $destinationPath_i = 'storage/desky/recu/' . date('Y');
            $FullPathFile = $destinationPath_i . '/' . $file_name;
            $upload = $request->recuFile->move($destinationPath_i, $file_name);
            if ($upload) {
                $stmt = PaymentSystem::where('OID', $request->OID)
                    ->where('buyer_email', Auth::user()->email)
                    ->where('status', 0)
                    ->where('method', 2)
                    ->update(['recuFile' => $FullPathFile, 'status' => 5]);
                if ($stmt) {
                    return response()->json(['success' => 'تم تلقي طلبك'], 200);
                } else {
                    return response()->json(
                        ['error' => 'فشل تحميل الملف *'],
                        500
                    );
                }
            } else {
                return response()->json(['error' => 'فشل تحميل الملف *'], 500);
            }
        } else {
            return response()->json(['error' => 'طلب خاطئ'], 400);
        }
    }
}
