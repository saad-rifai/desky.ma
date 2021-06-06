<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\MyCart;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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
                            return redirect('http://'.env('APP_URL').'/setcookie?s_token='.Session::getId().'&ref=/pay/'.Auth::user()->id.'/'.$OID);
                        }else{
                            return redirect('http://'.env('APP_URL').'/setcookie?s_token='.Session::getId().'');

                        }
                    }else{
                        return redirect('http://'.env('APP_URL').'/setcookie?s_token='.Session::getId().'');

                    }
                }else{
                    if(Cookie::get('ref')){
                        $ref = str_replace('-','/',Cookie::get('ref'));
                        return redirect('http://'.env('APP_URL').'/setcookie?s_token='.Session::getId().'&ref='.$ref);
                    }else{
                       return redirect('http://'.env('APP_URL').'/setcookie?s_token='.Session::getId().'');
                    }
                }


        }else{
            $token = $request->_token;
            return redirect()->intended('AD32020121103@2121/home?token='.$token.'');
        }
    }



        return redirect('login')->with('error', 'كلمة السر أو البريد الالكتروني الذي ادخلته غير صحيح، يرجى التحقق واعادة المحاولة.');
    }

}
