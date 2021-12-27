<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendEmail;

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

   // use ResetsPasswords;

    public function obfuscate_email($email)
    {
        $em   = explode("@", $email);
        $name = implode('@', array_slice($em, 0, count($em) - 1));
        $len  = floor(strlen($name) / 2);

        return substr($name, 0, $len) . str_repeat('*', $len) . "@" . end($em);
    }


    public function CheckResetPasswordLimit($email)
    {
        $stmts = DB::table('password_resets')->where('email', $email)->where('created_at', '>', Carbon::now()->subHours(3)->toDateTimeString())->get();

        $count = $stmts->count();
        if ($count >= 5) {
            return true;
        } else {
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
    public function UpdatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:8|max:25|confirmed',
            'g_recaptcha_response' => 'required|captcha',

        ], $message = [
            'required' => 'هذا الحقل مطلوب *',
            'g_recaptcha_response.required' => 'يرجى التحقق من الكابشا *',
            'g_recaptcha_response.captcha' => 'يرجى التحقق من الكابشا *',

            'password.min' => ' يجب أن تتكون كلمة السر من 8 أحرف على الأقل *',
            'password.max' => ' كلمة السر أطول من اللازم *',
            'password.required' => ' هذا الحقل مطلوب *',
            'password.confirmed' => ' كلمة السر غير متطابقة *',
        ]);
        if (isset($request->hashToken)) {
            $stmts = DB::table('password_resets')->where("token", "$request->hashToken")->where('created_at', '>', Carbon::parse('-2 hours'))->get();
            if ($stmts->count() > 0) {
                foreach ($stmts as $stmt);
                $decrypt = Crypt::decryptString($request->hashToken);
                $TokenData = explode("*{@}*", $decrypt);
                $email = $TokenData[0];
                $hashPassword = Hash::make($request->password);
                $UpdateUserInfos = User::where('email', "$email")->update(['password' => "$hashPassword", 'email_verified_at' => date("Y-m-d H:i:s")]);
                if ($UpdateUserInfos) {
                    $deletToken = DB::table('password_resets')->where("token", $request->hashToken)->delete();
                    return response()->json(['Password Updated Succesfully !'], 200);
                } else {
                    return response()->json(['Password Not Updated Succesfully System Error f0x50074245 !'], 500);
                }
            } else {
                return response()->json(['Not Found Token '], 400);
            }
        } else {
            return response()->json(['hashToken Filed ! '], 400);
        }
    }
    public function VerifyToken(Request $request)
    {
        $hashToken = $request->hashToken;

        $stmts = DB::table('password_resets')->where("token", "$hashToken")->where('created_at', '>', Carbon::parse('-2 hours'))->get();
        if ($stmts->count() > 0) {
            $decrypt = Crypt::decryptString($hashToken);
            $TokenData = explode("*{@}*", $decrypt);
            $email = $TokenData[0];
            foreach ($stmts as $stmt);


            $userInfos = User::where('email', "$email")->get(["avatar", "frist_name", "last_name", "username"]);
            foreach ($userInfos as $userInfo);
            $fullname = $userInfo->frist_name . ' ' . $userInfo->last_name;
            return view("auth.passwords.confirm")->with(['ValideToken' => true, 'fullname' => "$fullname", 'avatar' => "$userInfo->avatar", "username" => "$userInfo->username", "HashToken" => "$hashToken"]);
        } else {
            return view("auth.passwords.confirm")->with(['ValideToken' => false]);
        }
    }
    public function ResetPassword(Request $request)
    {
        $this->validate($request,
            [
                'username' => 'required|string|max:100|min:6',
                'g_recaptcha_response' => 'required',
            ],
            $message = [
                'required' => 'هذا الحقل مطلوب *',
                'g_recaptcha_response.required' => 'يرجى التحقق من الكابشا *',
                'g_recaptcha_response.captcha' => 'يرجى التحقق من الكابشا NoCaptcha *',

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
        if ($dbChecks->count() > 0) {
            foreach ($dbChecks as $dbCheck);
            $email = $dbCheck->email;
            $emailhidden = $this->obfuscate_email($email);
            if ($this->CheckResetPasswordLimit($email)) {
                return response()->json(['لقد تجاوزت الحد المسموح به لاعادة تعيين كلمة المرور يرجى المحاولة لاحقا بعد 3 ساعات'], 403);
            } else {
                $token =  bin2hex(random_bytes(20));
                $textToken = $email . "*{@}*" . $token;
                $hashToken = Crypt::encryptString($textToken);
                $stmt = DB::table('password_resets')->insert(['email' => "$email", 'token' => "$hashToken", "created_at" => Carbon::now()]);
                if ($stmt) {
                    $dataEmail = [
                        'token' => $hashToken,
                    ];
                    $datajob = [
                        'to' => $email,
                        'emailData' => new ResetPasswordMail($dataEmail)
                    ];
                    dispatch(new SendEmail($datajob));
                   //   return response()->json(['Mail Sended'], 200);

                 
                } else {
                    return response()->json(['error On STMT'], 500);
                }
            }
        } else {
            return response()->json(['errors' => ['username' => [0 => 'البريد الالكتروني أو اسم المستخدم غير موجود']]], 401);
        }
    }
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
