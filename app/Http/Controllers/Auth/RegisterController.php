<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifiyEmail;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Account_limits;
use App\Jobs\SendEmail;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /*  protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }*/

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */






    public function RegisterUser(Request $request)
    {

        //Validate User Data

        $this->validate(
            $request,
            [
                'User__fname' => 'required|min:3|max:11|regex:/^[\p{L} ]+$/u',
                'User__lname' => 'required|min:3|max:11|regex:/^[\p{L} ]+$/u',
                'User__email' => 'required|string|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:100|unique:users,email',
                'User__phone' => 'required|regex:/[0-9]{9}/|unique:users,phone_number|max:10',
                'User__cities' => 'required|max:5|regex:/^[\p{L} 0-9]+$/u',
                'User__gender' => 'required|integer|max:2|min:1',
                'User__type' => 'required|integer|max:2|min:1',
                'User__password' => 'required|string|min:8|max:25',
                'terms' => 'required|in:true',
                //'typeaccount' => 'required|integer|max:1|min:0',
                'g_recaptcha_response' => 'required|captcha',
            ],
            $message = [
                'required' => 'هذا الحقل مطلوب *',
                'g_recaptcha_response.required' => 'يرجى التحقق من الكابشا *',
                'g_recaptcha_response.captcha' => 'يرجى التحقق من الكابشا *',

                'terms.required' => 'يجب الموفقة على شروط الاستخدام وسياسة الخصوصية *',
                'terms.in' => 'يجب الموفقة على شروط الاستخدام وسياسة الخصوصية *',

                'User__fname.min' => ' يرجى ادخال اسم صالح *',
                'User__fname.regex' => ' يرجى ادخال اسم صالح *',
                'User__fname.max' => 'الاسم أطول من اللازم *',

                'User__lname.max' => 'الاسم أطول من اللازم *',
                'User__lname.min' => ' يرجى ادخال اسم صالح *',
                'User__lname.regex' => ' يرجى ادخال اسم صالح *',

                'User__email.regex' => ' يرجى ادخال بريد الكتروني صالح *',
                'User__email.max' => '   البريد الاكتروني أطول من اللازم *',
                'User__email.unique' => 'هذا البريد الالكتروني مسجل من قبل  *',
                'User__email.email' => ' يرجى ادخال بريد الكتروني صالح *',


                'User__phone.unique' => 'رقم الهاتف الذي ادخلته مسجل من قبل *',
                'User__phone.regex' => 'يرجى ادخال رقم هاتف صالح مثال: (0601020304) *',
                'User__phone.max' => 'رقم الهاتف الذي ادخلته أطول من اللازم يجب أن يتكون من 10 أرقام مثال: (0601020304) *',

                'User__cities.regex' => ' يرجى تحديد المدينة *',
                'User__cities.max' => ' يرجى تحديد المدينة *',

                'User__gender.max' => ' يرجى تحديد الجنس *',
                'User__gender.min' => ' يرجى تحديد الجنس *',
                'User__gender.integer' => ' يرجى تحديد الجنس *',

                'User__type.max' => ' يرجى تحديد النوع *',
                'User__type.min' => ' يرجى تحديد النوع *',
                'User__type.integer' => ' يرجى تحديد النوع *',

                'User__password.min' => ' يجب أن تتكون كلمة السر من 8 أحرف على الأقل *',
                'User__password.max' => ' كلمة السر أطول من اللازم *',
            ]

        );

        $datajson = file_get_contents('data/json/list-moroccan-cities.json');
        $jsondata = json_decode($datajson, true);
        $resultcheck = true;
        $cityid = $request->User__cities;
       foreach ($jsondata as $item) {
            if ($item['id'] == $cityid) {
                $resultcheck = true;
            }
        }
        if ($resultcheck == true) {
            $AccountNumber = random_int(100000, 9999999999);
            $verifiy_token = Str::random(25);
            $stmt = User::create([
                'frist_name' => $request->User__fname,
                'last_name' => $request->User__lname,
                'phone_number' => $request->User__phone,
                'email' => $request->User__email,
                'country' => 'MA',
                'city' => $request->User__cities,
                'gender' => $request->User__gender,
                'type' => $request->User__type,
                'avatar' => NULL,
                'description	' => NULL,
                'sector' => NULL,
                'activity' => NULL,
                'status' => 0,
                'source' => 'REGISTER__FORM',
                'password' => Hash::make($request->User__password),
                'MAC_Address' => NULL,
                'IP_Address' => $request->ip(),
                'Account_number' => $AccountNumber,
                'verifiy_token' => $verifiy_token,
                'username' => $request->User__lname . '_' . $AccountNumber

            ]);
            if ($stmt) {
                $Account_limits = Account_limits::create([
                    'Account_number' => $AccountNumber,
                    'Number_of_orders_per_month' => 5,
                    'Number_of_offers_per_month' => '5'
                ]);
                if (Auth::attempt([
                    'email' => $request->User__email,
                    'password' => $request->User__password,

                ])) {
                    $dataEmail = [
                        'token' => $verifiy_token,
                        'fullname' => $request->User__fname . ' ' . $request->User__lname,
                        'AccountNumber' => $AccountNumber
                    ];
                    $datajob = [
                        'to' => $request->User__email,
                        'emailData' => new VerifiyEmail($dataEmail)
                    ];
                    dispatch(new SendEmail($datajob));
                    $s_token = Session::getId();
                    return response()->json(['s_token' => $s_token], 200);

                } else {
                    return response()->json(['error' => 'Account Not Created'], 500);

                }
            } else {
                return response()->json(['error' => 'حصل خطأ اثناء محاولة انشاء الحساب يرجى اعادة المحاولة (ERR:101031)'], 500);
            }
        } else {
            return response()->json(['errors' => ['User__cities' => [0 => 'يرجى اختيار مدينة صالحة']]], 422);
        }

    }
    public function RequesFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderCallback__Facebook()
    {
        $user = Socialite::driver('facebook')->user();

        if (isset($user->id)) {
            dd($user);
        } else {
            return 'Auth False !';
        }
    }




    public function RequesGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback__Google()
    {
        $user = Socialite::driver('google')->user();

        if (isset($user->id)) {
            dd($user);
        } else {
            return 'Auth False !';
        }
    }
}
