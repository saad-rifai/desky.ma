<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\tokens;
use App\Mail\ResetPassword;
use App\User;
use \Swift_SmtpTransport;
use Swift_Mailer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordUpdated;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Location\Position;
use Stevebauman\Location\Drivers\Driver;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    public function ResetPassword(Request $request){
        if(isset($request->sendMail)){

            $this->validate($request, [

                '_token' => 'required',
                'email' => 'required|email|exists:mysql_neryou.users'
            ],
            $message =
            [
            'required' => 'هذا الحقل مطلوب *',
            'email.exists' => 'هذا البريد الالكتروني غير مسجل *',
            'email.email' => 'يرجى ادخال بريد الكتروني صالح *',
            ]);

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
            $token = generateRandomString(30);
            $stmt = tokens::create(['token' => $token, 'email' => $request->email]);
            if($stmt){
                  // Setup your gmail mailer
                  $backup = Mail::getSwiftMailer();

                  $transport = new Swift_SmtpTransport('desky.ma', 465, 'ssl');
                  $transport->setUsername('noreply@desky.ma');
                  $transport->setPassword('Yg(H2)&48k!?');
                  $gmail = new Swift_Mailer($transport);


                  // Set the mailer as gmail
                  Mail::setSwiftMailer($gmail);
                  $valueArray2 = [
                      'token' => $token,

                  ];

                  try {
                      Mail::to($request->email)->send(new ResetPassword($valueArray2));
                      //return 'Mail send successfully';
                  } catch (\Exception $e) {
                      return 'Error - ' . $e;
                  }
                  return redirect('reset_password')->with('success' , 'تم ارسال رسالة اعادة تعيين البريد الالكتروني الى بريدك, في حال لم تجدها يرجى التحقق من مجلد spam');
            }else{
                return redirect('reset_password')->with('error' , 'حدث خطأ ما يرجى اعادة المحاولة واذا استمر المشكل معك يرجى التواصل معنا');

            }
        }elseif($request->ResetPass){
            if(isset($request->token)  && $request->token != ""){
                $Checks = tokens::all()->where('token', $request->token);
                if($Checks->count() > 0){
                    foreach($Checks as $Check);
                    $exDate = $Check->created_at->addMinutes(60);
                    $dateNow = Carbon::now();
                    if($dateNow > $exDate){
                        return view('auth.password-reset-status', ['error' => 'لقد انتهت صلاحية هذا الرابط ']);
                    }else{
                        return view('auth.password-reset-status', ['success' => $request->token]);
                    }
                }else{
                    abort(404);
                }
            }else{
                abort(404);
            }
        }elseif($request->NewPass){
            if(isset($request->token)  && $request->token != ""){
                $Checks = tokens::all()->where('token', $request->token);
                if($Checks->count() > 0){
                    foreach($Checks as $Check);
                    $exDate = $Check->created_at->addMinutes(60);
                    $dateNow = Carbon::now();
                    if($dateNow > $exDate){
                        return view('auth.password-reset-status', ['error' => 'لقد انتهت صلاحية هذا الرابط ']);
                    }else{
                        $email = $Check->email;
                        $this->validate($request, [

                            '_token' => 'required',
                            'password' => 'required|string|min:8|max:25|confirmed',
                            'g-recaptcha-response' => 'required|recaptcha'
                        ],
                        $message =
                        [
                        'password.required' => 'يرجى ادخال كلمة سر صالحة *',
                        'password.min' => 'يجب أن تتكون كلمة السر من 8 احرف على الأقل *',
                        'password.max' => 'كلمة السر أطول من اللازم *',
                        'password.confirmed' => 'كلمة السر غير متطابقة *',

                        'g-recaptcha-response.required' => 'يرجى التحقق من الكابشا *',
                        'g-recaptcha-response.recaptcha' => 'يرجى التحقق من الكابشا *'

                        ]);
                        $stmt = User::where('email', $email)->update([
                            'password' => Hash::make($request->password)
                        ]);
                        if($stmt){
                  // Setup your gmail mailer
                  $backup = Mail::getSwiftMailer();

                  $transport = new Swift_SmtpTransport('desky.ma', 465, 'ssl');
                  $transport->setUsername('noreply@desky.ma');
                  $transport->setPassword('Yg(H2)&48k!?');
                  $gmail = new Swift_Mailer($transport);
                  $ip = request()->ip();
                  $ipdata = \Location::get($ip);
                  if(!empty($ipdata)){
                    $details = $ip.' - '.$ipdata->countryName.' - '.$ipdata->regionName.' - '.$ipdata->cityName.' - '.$ipdata->zipCode.' - '.date("Y-m-d H:i:s");

                  }else{
                      $details = $ip.' - No Data';
                  }
                  // Set the mailer as gmail
                  Mail::setSwiftMailer($gmail);
                  $valueArray2 = [
                      'email' => $email,
                      'details' => $details

                  ];

                  try {
                      Mail::to($email)->send(new PasswordUpdated($valueArray2));
                      //return 'Mail send successfully';
                  } catch (\Exception $e) {
                      return 'Error - ' . $e;
                  }
                  tokens::where('token', $request->token)->delete();

                  return redirect('login')->with(['password_update', 'تم تحديث كلمة المرور بنجاح !']);
                        }else{
                            return redirect()->back()->with('error' , 'حدث خطأ ما يرجى اعادة المحاولة واذا استمر المشكل معك يرجى التواصل معنا');

                        }
                    }
                }else{
                    abort(404);
                }
            }else{
                abort(404);
            }

        }else{
            abort(404);

        }
    }

}
