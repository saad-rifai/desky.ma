<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use \Swift_SmtpTransport;
use Swift_Mailer;



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

    use ResetsPasswords;

    public function obfuscate_email($email)
    {
        $em   = explode("@",$email);
        $name = implode('@', array_slice($em, 0, count($em)-1));
        $len  = floor(strlen($name)/2);
    
        return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
    }
    

    public function CheckResetPasswordLimit($email){
        $stmts = DB::table('password_resets')->where('email', $email)->where('created_at', '>', Carbon::now()->subHours(3)->toDateTimeString())->get();

        $count = $stmts->count();
        if($count >= 5){
            return true;
        }else{
            return false;
        }
       // dd($stmts);
       /* foreach($stmts as $stmt){
            $currentDateTime = Carbon::now();
            $newDateTime = Carbon::now()->addMinute(60);
            $dateChnage = strtotime($stmt->created_at);
            if(Carbon::parse($dateChnage)->addMinute(60) < $newDateTime){
                echo 'expired <br>';
            }else{
                echo 'OK <br>';
            }
        }*/

    }
    public function ResetPassword(Request $request){
        $this->validate(
            $request,
            [
                 'username' =>'required|string|max:100|min:6',
                'g_recaptcha_response' => 'required|captcha',
            ],
            $message = [
                'required' => 'هذا الحقل مطلوب *',
                'g_recaptcha_response.required' => 'يرجى التحقق من الكابشا *',
                'g_recaptcha_response.captcha' => 'يرجى التحقق من الكابشا *',

                'username.max' => '   البريد الاكتروني أو أسم المستخدم أطول من اللازم *',
                'username.min' => '   البريد الاكتروني أو أسم المستخدم أقصر من اللازم *',
                'username.string' => '   يرجى التحقق من المدخلات *',

                ]

        );
        $username = $request->username;
        $dbChecks = DB::table('users')
        ->where('email', "$username")
        ->orWhere('username', "$username")
        ->get("email");
        if($dbChecks->count() > 0){
        foreach($dbChecks as $dbCheck);
        $email = $dbCheck->email;
        $emailhidden = $this->obfuscate_email($email);
        if($this->CheckResetPasswordLimit($email)){
            return response()->json(['لقد تجاوزت الحد المسموح به لاعادة تعيين كلمة المرور يرجى المحاولة لاحقا بعد 3 ساعات'], 403);

        }else{
           $token =  bin2hex(random_bytes(20));
           $textToken = $email."@".$token;
           $hashToken = Crypt::encryptString($textToken);
           $stmt = DB::table('password_resets')->insert(['email' => "$email", 'token' => "$hashToken", "created_at" => Carbon::now()]);
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
                      'token' => $hashToken,

                  ];

                  try {
                      Mail::to($email)->send(new ResetPassword($valueArray2));
                      return response()->json(['Mail Send Sucsess !', 'email' => $emailhidden], 200);
                  } catch (\Exception $e) {
                      //return 'Error - ' . $e;
                      return response()->json(['Mail Filed !'], 500);

                  }



           }else{
               return response()->json(['error On STMT'], 500);
           }
        }



        }else{
            return response()->json(['errors' => ['username' => [0 => 'البريد الالكتروني أو اسم المستخدم غير متطابق']]], 401);

        }
      
    }
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
