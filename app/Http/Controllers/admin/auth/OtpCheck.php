<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\admin\AdminUsers;
use App\AdminAuthToken;
use App\Jobs\SendEmail;
use App\Mail\admin\SendOTP;

class OtpCheck extends Controller
{
    //return view("auth.admin.verifyOTP")
    public function sendOtp(Request $request){
        if(Auth::check()){
            $checkAdminUser = AdminUsers::where('Account_number', Auth::user()->Account_number)->where('status', '0')->count();
            if($checkAdminUser > 0){
                $otpToken = random_int(111111, 999999);
                $createToken = AdminAuthToken::create([
                    'Account_number' => Auth::user()->Account_number,
                    'ip_adress' => $request->ip(),
                    'token' => $otpToken,
                    'last_time_use' => date("Y/m/d H:i:s")
                ]);
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
        ], $messages = [
            'required' => 'يرجى ادخال رمز التحقق',
            'integer' => 'يرجى ادخال رمز تحقق صالح',
            'max' => 'يرجى ادخال رمز تحقق صالح',
            'min' => 'يرجى ادخال رمز تحقق صالح'
        ]);
    }
}
