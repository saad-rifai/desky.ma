<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ContantUs;
use Illuminate\Support\Facades\Auth;

class ContantUsController extends Controller
{
    public function SendMessage(Request $request){
    $this->validate($request,[
        'fname' => 'required|min:4|max:17|regex:/^[\p{L} ]+$/u',
        'lname' => 'required|min:4|max:17|regex:/^[\p{L} ]+$/u',
        'email' => 'required|string|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:80',
        'category' => 'required|integer|max:3|min:0',
        'subject' => 'required|min:5|max:25|regex:/^[\p{L} 0-9]+$/u',
        'message' => 'required|string|min:10|max:400',
        'phone' => 'nullable|regex:/[0-9]{9}/',
        'recaptcha_token' => 'required|recaptcha',


    ], [
        'required' => 'هذا الحقل مطلوب *',
        'fname.min' => 'الاسم أقصر من الازم *',
        'lname.min' => 'الاسم أقصر من الازم *',
        'lname.max' => 'الاسم أطول من الازم *',
        'fname.max' => 'الاسم أطول من الازم *',
        'email.email' => 'يرجى ادخال بريد الكتروني صالح *',
        'email.regex' => 'يرجى ادخال بريد الكتروني صالح *',
        'email.max' => 'يرجى ادخال بريد الكتروني صالح *',
        'email.string' => 'يرجى ادخال بريد الكتروني صالح [S] *',
        'category.integer' => 'يرجى تحديد تصنيف *',
        'category.max' => 'يرجى تحديد تصنيف *',
        'category.min' => 'يرجى تحديد تصنيف *',
        'subject.min' => 'عنوان الرسالة أقصر من اللازم *',
        'subject.max' => 'عنوان الرسالة أطول من اللازم *',
        'subject.regex' => 'يرجى التحقق من المدخلات *',
        'message.regex' => 'يرجى التحقق من المدخلات *',
        'message.min' => 'الرسالة أقصر من اللازم *',
        'message.max' => 'الرسالة أطول من اللازم *',
        'phone.regex' => 'يرجى ادخال رقم هاتف صالح (06 00 00 00 00) *',
        'recaptcha_token.required' => 'يرجى التحقق من الكابشا *',
        'recaptcha_token.recaptcha' => 'يرجى التحقق من الكابشا *',

    ]);
    if(Auth::check()){
        $AuthEmail = Auth::user()->email;
    }else{
        $AuthEmail = null;
    }
    $stmt = ContantUs::create([
        'fname' => $request->fname,
        'lname' => $request->lname,
        'email' => $request->email,
        'phone' => $request->phone,
        'category' => $request->category,
        'subject' => $request->subject,
        'message' => $request->message,
        'ip_addr' => request()->ip(),
        'USER_AGENT' => request()->userAgent(),
        'Auth_email' => $AuthEmail
    ]);
    if($stmt){
        return response()->json(['تم ارسال الرسالة'], 200);
    }else{
        return response()->json(['error' => 'حدث خطأ ما يرجى اعادة المحاولة !'], 500);

    }
    }
}
