<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\tokens;
use App\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\verfymail_desky;
use Illuminate\Support\Facades\Session;
use \Swift_SmtpTransport;
use Swift_Mailer;
use App\MyCart;
use App\UserPrivacy;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //  protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /* protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|min:3|max:11|regex:/^[\p{L} ]+$/u',
            'lname' => 'required|min:3|max:11|regex:/^[\p{L} ]+$/u',
            'email' => 'required|string|email|max:255|unique:users',
            'phonenumb' => 'required|regex:/[0-9]{9}/|unique:users',
            'country' => 'required|max:20|regex:/^[\p{L} 0-9]+$/u',
            'city' => 'required|min:4|max:25|regex:/^[\p{L} 0-9]+$/u',
            'company' => 'nullable|min:4|max:17|regex:/^[\p{L} 0-9]+$/u',
            'password' => 'required|string|min:8|max:25',
        ], $message = [
            'required' => 'هذا الحقل مطلوب *',

            'email.unique' => 'هذا البريد الالكتروني مستخدم *',
            'email' => 'يرجى ادخال بريد الكتروني صالح *',
            'email.max' => 'يرجى ادخال بريد الكتروني صالح *',
            'phonenumb.unique' => 'رقم الهاتف مستخدم *',
            'phonenumb.regex' => 'يرجى ادخال اسم هاتف صالح (0600000000) *',
            'regex' => 'يرجى التحقق من المدخلات *',
            'fname' => 'يرجى ادخال اسم صالح (3-11 حرف) *',
            'lname' => 'يرجى ادخال اسم صالح (3-11 حرف) *',
            'fname.regex' => 'يرجى ادخال اسم صالح *',
            'lname.regex' => 'يرجى ادخال اسم صالح *',
            'city.min' => 'يرجى ادخال اسم مدينة صالح 4-25 حرف *',
            'city.max' => 'يرجى ادخال اسم مدينة صالح 4-25 حرف *',
            'city.regex' => 'يرجى ادخال اسم مدينة صالح *',
            'company.min' => 'يرجى ادخال اسم شركة صالح *',
            'company.max' => 'يرجى ادخال اسم شركة صالح *',
            'company.regex' => 'يرجى ادخال اسم شركة صالح *',
            'password.min' => 'يجب أن تتكون كلمة السر من 8 أحرف على الأقل *',
            'password.min' => 'كلمة السر أطول من اللازم *',
            'password.confirmed' => 'كلمة السر غير متطابقة *',


        ]);

    }*/

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required|min:3|max:11|regex:/^[\p{L} ]+$/u',
            'lname' => 'required|min:3|max:11|regex:/^[\p{L} ]+$/u',
            'email' => 'required|string|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:80|unique:mysql_neryou.users',
            'phonenumb' => 'required|regex:/[0-9]{9}/|unique:mysql_neryou.users|max:10',
            'country' => 'required|max:20|regex:/^[\p{L} 0-9]+$/u',
            'city' => 'required|min:4|max:25|regex:/^[\p{L} ]+$/u',
            'company' => 'nullable|min:4|max:17|regex:/^[\p{L} 0-9]+$/u',
            'password' => 'required|string|min:8|max:25',
            'typeaccount'=> 'required|integer|max:1|min:0',
            'recaptcha_token' => 'required|recaptcha'

        ], $message = [

            'typeaccount.required' => 'يرجى تحديد نوع الحساب *',
            'typeaccount.max' => 'يرجى تحديد نوع الحساب *',
            'typeaccount.min' => 'يرجى تحديد نوع الحساب *',
            'required' => 'هذا الحقل مطلوب *',
            'recaptcha_token.required' => 'يرجى التحقق من الكابشا *',
            'recaptcha_token.recaptcha' => 'يرجى التحقق من الكابشا *',
            /* Email */
            'email.unique' => 'هذا البريد الالكتروني مستخدم *',
            'email' => 'يرجى ادخال بريد الكتروني صالح *',
            'email.max' => 'يرجى ادخال بريد الكتروني صالح *',
            /* End Email */
            'phonenumb.unique' => 'رقم الهاتف مستخدم *',
            'phonenumb.regex' => 'يرجى ادخال رقم هاتف صالح (0600000000) * ',
            'phonenumb.max' => 'يرجى ادخال رقم هاتف صالح (0600000000) *',
            'regex' => 'يرجى التحقق من المدخلات *',
            /*  Fname Email Validation */
            'fname.max' => 'الاسم أطول من اللازم *',
            'fname.min' => 'الاسم أقصر من اللازم *',
            'lname.max' => 'الاسم أطول من اللازم *',
            'lname.min' => 'الاسم أقصر من اللازم *',
            'fname.regex' => 'يرجى ادخال اسم صالح *',
            'lname.regex' => 'يرجى ادخال اسم صالح *',
            /* City Validation */
            'city.min' => 'يرجى ادخال اسم مدينة صالح 4-25 حرف *',
            'city.max' => 'يرجى ادخال اسم مدينة صالح 4-25 حرف *',
            'city.regex' => 'يرجى ادخال اسم مدينة صالح *',
            /* Company */
            'company.min' => 'يرجى ادخال اسم شركة صالح *',
            'company.max' => 'يرجى ادخال اسم شركة صالح *',
            'company.regex' => 'يرجى ادخال اسم شركة صالح *',
            /* Password */
            'password.min' => 'يجب أن تتكون كلمة السر من 8 أحرف على الأقل *',
            'password.min' => 'كلمة السر أطول من اللازم *',
            'password.confirmed' => 'كلمة السر غير متطابقة *',


        ]);

        $clientIP = \Request::ip();



        $datajson = file_get_contents('database/data.json');
        $jsondata = json_decode($datajson, true);
        $resultcheck = false;
        $country = $request->country;
        foreach ($jsondata['countries'] as $item) {
            if ($item['code'] == $country) {
                $resultcheck = true;
            }


        }
        if ($resultcheck == false) {
            return response()->json(['errors' => ['country' => ['يرجى تحديد بلد صحيح']]], 422);


        }
        $PermissionId = env('PERMISSION_ID');

        if (isset($request->user_type_987251504) && $request->user_type_987251504 == $PermissionId) {
            $status = $request->user_type_status;
        } else {
            $status = "0";
        }
        $ref_alg = Cookie::get('ref');
        //Create a response instance
        if (isset($ref_alg)) {
          //  Cookie::queue('ref_alg', $ref_alg, '5');
//Cookie::queue('ipaddr', $clientIP, '5');
        }
        $stmt = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phonenumb' => $request->phonenumb,
            'company' => $request->company,
            'country' => $request->country,
            'city' => $request->city,
            'status' => $status,
            'password' => Hash::make($request->password),
            'typeaccount' => $request->typeaccount,
        ]);
        $privacy = UserPrivacy::create([
            'email' => $request->email,
            'public_account' => 1,
            'public_devis' => 0,
            'public_facture' => 0,
            'token_share' => null
            ]);
        if ($stmt && $privacy) {
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
            if (Auth::attempt([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phonenumb' => $request->phonenumb,
                'city' => $request->city,
                'company' => $request->comapny,
                'status' => $status,
                'password' => $request->password,
                'typeaccount' => $request->typeaccount,

            ])) {


                $token_verfy = generateRandomString(35);
                $stm = tokens::create(['token' => $token_verfy, 'UID' => Auth::user()->id]);
                if ($stm) {
                    // Setup your gmail mailer
                    $backup = Mail::getSwiftMailer();

                    $transport = new Swift_SmtpTransport('desky.ma', 465, 'ssl');
                    $transport->setUsername('noreply@desky.ma');
                    $transport->setPassword('Yg(H2)&48k!?');
                    $gmail = new Swift_Mailer($transport);


                    // Set the mailer as gmail
                    Mail::setSwiftMailer($gmail);
                    $valueArray2 = [
                        'token' => $token_verfy,

                    ];

                    try {
                        Mail::to($request->email)->send(new verfymail_desky($valueArray2));
                        //return 'Mail send successfully';
                    } catch (\Exception $e) {
                        return 'Error - ' . $e;
                    }
                  /*  if(Cookie::has("register_more")){
                        $register_more = Cookie::get("register_more");
                       // return redirect($register_more.'?ref=registerform&from=controller&u='.Auth::user()->id.'&packs=true');
                       return response()->json(['token' => Session::getId(), 'ref' => $register_more], 200);

                    }else{
                        if (isset($ref_alg)) {
                         //   return redirect($ref_alg.'?ref=registerform&from=controller&u='.Auth::user()->id);
                         return response()->json(['token' => Session::getId(), 'ref' => $ref_alg], 200);

                        }else{
                            return response()->json(['token' => Session::getId(), 'ref' => false], 200);

                          //  return redirect('/u?uid=' . Auth::user()->id . '&ref=registerform');

                        }
                    }*/

                    $cart_id = Cookie::get('cart_id');
                    if($cart_id != ""){
                        $OID = Cookie::get('cart_id');
                        $check = MyCart::where('OID', $OID)->where('status', 0)->get(['OID']);
                        if(count($check) > 0){
                            $stmt = MyCart::where('OID', $OID)->where('status', 0)->update([
                                'UID' => Auth::user()->id,
                                'email' => Auth::user()->email
                            ]);
                            if($stmt){
                                Cookie::queue(
                                    Cookie::forget('cart_id')
                                );
                                return response()->json(['token' => Session::getId(), 'ref' => '/pay/'.Auth::user()->id.'/'.$OID], 200);

                            }else{
                                return response()->json(['token' => Session::getId(), 'ref' => "u"], 200);

                            }
                        }else{
                            return response()->json(['token' => Session::getId(), 'ref' => "u"], 200);

                        }
                    }else{
                        if(Cookie::get('ref')){
                            $ref = str_replace('-','/',Cookie::get('ref'));
                            return response()->json(['token' => Session::getId(), 'ref' => $ref], 200);
                        }else{
                            return response()->json(['token' => Session::getId(), 'ref' => "u"], 200);
                        }
                    }

                } else {
                    return response()->json(['error' => 'لقد حصل خطأ ما أثناء محاولة انشاء المستخدم يرجى اعادة المحاولة'], 422);
                }
            } else {
                return response()->json(['error' => 'لقد حصل خطأ ما أثناء محاولة انشاء المستخدم يرجى اعادة المحاولة'], 422);
            }
        } else {
            return response()->json(['error' => 'لقد حصل خطأ ما أثناء محاولة انشاء المستخدم يرجى اعادة المحاولة'], 422);
        }
    }
    protected function update(Request $request){
        $this->validate($request, [
            'fname' => 'required|min:3|max:11|regex:/^[\p{L} ]+$/u',
            'lname' => 'required|min:3|max:11|regex:/^[\p{L} ]+$/u',
            'phonenumb' => 'required|regex:/[0-9]{9}/|max:10',
            'country' => 'required|max:20|regex:/^[\p{L} 0-9]+$/u',
            'city' => 'required|min:4|max:25|regex:/^[\p{L} 0-9]+$/u',
            'company' => 'nullable|min:4|max:17|regex:/^[\p{L} 0-9]+$/u',
        ], $message = [
            'required' => 'هذا الحقل مطلوب *',

            /* End Email */
            'phonenumb.unique' => 'رقم الهاتف مستخدم *',
            'phonenumb.max' => 'يرجى ادخال رقم هاتف صالح (0600000000) *',
            'phonenumb.regex' => 'يرجى ادخال اسم رقم صالح (0600000000) *',
            'regex' => 'يرجى التحقق من المدخلات *',
            /*  Fname Email Validation */
            'fname' => 'يرجى ادخال اسم صالح (3-11 حرف) *',
            'lname' => 'يرجى ادخال اسم صالح (3-11 حرف) *',
            'fname.regex' => 'يرجى ادخال اسم صالح *',
            'lname.regex' => 'يرجى ادخال اسم صالح *',
            /* City Validation */
            'city.min' => 'يرجى ادخال اسم مدينة صالح 4-25 حرف *',
            'city.max' => 'يرجى ادخال اسم مدينة صالح 4-25 حرف *',
            'city.regex' => 'يرجى ادخال اسم مدينة صالح *',
            /* Company */
            'company.min' => 'يرجى ادخال اسم شركة صالح *',
            'company.max' => 'يرجى ادخال اسم شركة صالح *',
            'company.regex' => 'يرجى ادخال اسم شركة صالح *',

        ]);

        $datajson = file_get_contents('database/data.json');
        $jsondata = json_decode($datajson, true);
        $resultcheck = false;
        $country = $request->country;
        foreach ($jsondata['countries'] as $item) {
            if ($item['code'] == $country) {
                $resultcheck = true;
            }


        }
        if ($resultcheck == false) {
            return response()->json(['errors' => ['country' => ['يرجى تحديد بلد صحيح']]], 422);


        }
        $stmt = User::where("email", Auth::user()->email)->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phonenumb' => $request->phonenumb,
            'country' => $request->country,
            'city' => $request->city,
            'company' => $request->company,
        ]);

    }
}
