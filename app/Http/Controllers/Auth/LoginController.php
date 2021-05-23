<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /*protected function redirectTo()

    {
        $status = Auth::user()->status;
        if($status == "0"){

        }else{

        }

       return $status;

    }*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',

        ], $message = [
            'required' => 'هذا الحقل مطلوب *',
            'email.email' => 'يرجى ادخال بريد الكتروني صالح',

        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $status = Auth::user()->status;
            if($status == "0"){
                if($request->ref){
                    return redirect('http://'.env('APP_URL').'/setcookie?s_token='.Session::getId().'&ref='.$request->ref);
                }else{
                   return redirect('http://'.env('APP_URL').'/setcookie?s_token='.Session::getId().'');
                }

        }else{
            $token = $request->_token;
            return redirect()->intended('AD32020121103@2121/home?token='.$token.'');
        }
    }



        return redirect('login')->with('error', 'كلمة السر أو البريد الالكتروني الذي ادخلته غير صحيح، يرجى التحقق واعادة المحاولة.');
    }

}
