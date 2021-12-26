<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\admin\AdminUsers;
use App\AdminAuthToken;
use App\Jobs\SendEmail;
use App\Mail\admin\SendOTP;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class OtpCheck extends Controller
{
    //return view("auth.admin.verifyOTP")
    public function sendOtp(Request $request){
        if(Auth::check()){
            $checkAdminUser = AdminUsers::where('Account_number', Auth::user()->Account_number)->where('status', '0')->count();
            if($checkAdminUser > 0){
                $otpToken = random_int(111111, 999999);
                $checkAuthToken = AdminAuthToken::where('Account_number', Auth::user()->Account_number)->count();
                if($checkAuthToken > 0){
                    $createToken = AdminAuthToken::where('Account_number', Auth::user()->Account_number)->update([
                        'ip_adress' => $request->ip(),
                        'token' => $otpToken,
                        'last_time_use' => null
                    ]);
                }else{
                    $createToken = AdminAuthToken::create([
                        'Account_number' => Auth::user()->Account_number,
                        'ip_adress' => $request->ip(),
                        'token' => $otpToken,
                        'last_time_use' => null
                    ]);
                }

                if($createToken){
                    
                    $dataEmail = [
                        'otptoken' => $otpToken,
                        'fullname' => ucfirst(Auth::user()->frist_name).' '.ucfirst(Auth::user()->last_name),
                        'ip_adress' =>  $request->ip()
                    ];
                    $datajob = [
                        'to' => Auth::user()->email,
                        'emailData' => new SendOTP($dataEmail)
                    ];
                    dispatch(new SendEmail($datajob));
                    return view("auth.admin.verifyOTP");
                }else{
                    return response(['error', 'حصل خطأ اثناء محاولة انشاء رمز التحقق'], 500);
                }


            }else{
                abort(403);
            }
        }else{
           return redirect("login");
        }
    }
  
    public function OtpVerifiy(Request $request){
        $this->validate($request,  [
            'otp' => 'required|integer|max:999999|min:111111',
            'captcha' => 'required|captcha',
        ], $messages = [
            'required' => 'يرجى ادخال الرمز',
            'integer' => 'يرجى ادخال رمز تحقق صالح',
            'max' => 'يرجى ادخال رمز تحقق صالح',
            'min' => 'يرجى ادخال رمز تحقق صالح',
            'captcha' => 'رمز الكابشا خاطئ',
        ]);
        $checkAdminUser = AdminUsers::where('Account_number', Auth::user()->Account_number)->where('status', '0')->count();
        if($checkAdminUser > 0){
            /* Validate OTP TOKEN */
            $checkAuthToken = AdminAuthToken::where('Account_number', Auth::user()->Account_number)->where('token', $request->otp)->count();
            if($checkAuthToken > 0){
                /* Crypt Token */
                $CryptToken = Crypt::encryptString($request->otp);
                Cookie::queue(Cookie::forever('admin_token', $CryptToken));
               

              
                   $updateAuthToken = AdminAuthToken::where('Account_number', Auth::user()->Account_number)->where('token', $request->otp)->update([
                       'last_time_use' => date('Y-m-d H:i:s')
                   ]);
                 return response()->json(['success' => true], 200);
               
            }else{
               return response()->json(['errors' => ['otp' => [0 => 'رمز التحقق OTP خاطئ']]], 422);            
            
            }

        }else{
            return response()->json(['forbidden' => 'Encrypted two-factor authentication verification algorithm: You do not have access to this area'], 403);
        }
      
    }
}
