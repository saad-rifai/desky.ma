<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

     public function LoginUser(Request $request){
        $this->validate(
            $request,
            [
                 'email' =>'required|string|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:100',
                 'password' => 'required|string|min:8|max:25',
                //'typeaccount' => 'required|integer|max:1|min:0',
               /* 'g_recaptcha_response' => 'required|captcha',*/
            ],
            $message = [
                'required' => 'هذا الحقل مطلوب *',
              /*  'g_recaptcha_response.required' => 'يرجى التحقق من الكابشا *',
                'g_recaptcha_response.captcha' => 'يرجى التحقق من الكابشا *',*/

                'email.email' => ' يرجى ادخال بريد الكتروني صالح *',
                'email.regex' => ' يرجى ادخال بريد الكتروني صالح *',
                'email.max' => '   البريد الاكتروني أطول من اللازم *',
        
                'password.min' => ' يجب أن تتكون كلمة السر من 8 أحرف على الأقل *',
                'password.max' => ' كلمة السر أطول من اللازم *',
                ]

        );
        if($request->remember == true){
            $remember_token = $request->csrf_token;
        }else{
            $remember_token = false;
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember_token)) {
            if(isset($request->previous)){
                return response()->json(['Login Success !', 'previous' => $request->previous ], 200);

            }else{
                return response()->json(['Login Success !' ], 200);

            }

        }else{
            return response()->json(['errors' => ['email' => [0 => 'البريد الالكتروني أو كلمة السر التي أدخلت غير متطابقة']]], 422);

        }
     }

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
