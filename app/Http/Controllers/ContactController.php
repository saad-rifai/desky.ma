<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required|min:5|max:17|regex:/^[\p{L} ]+$/u',
            'email' => 'required|email',
            'phonenumb' => 'required|regex:/[0-9]{9}/',
            'subject' => 'required|min:5|max:25|regex:/^[\p{L} 0-9]+$/u',
            'message' => 'required|min:25|max:700',


        ], $message = [
            /* full name validation */
            'fullname.required' => 'يرجى ادخال الاسم *',
            'fullname.regex' => 'يرجى ادخال اسم صالح *',
            'fullname.min' => 'يرجى ادخال اسم صالح *',
            'fullname.max' => 'الاسم أطول من اللازم *',
            /* Email validation */
            'email.required' => 'يرجى ادخال البريد الالكتروني *',
            'email.email' => 'يرجى ادخال بريد الكتروني صالح exmple@exmple.com *',
            /* phone number validation */
            'phonenumb.required' => 'يرجى ادخال رقم الهاتف *',
            'phonenumb.integer' => 'يرجى ادخال رقم هاتف صالح (ex: 0606060606) *',
            'phonenumb.regex' => 'يرجى ادخال رقم هاتف صالح (ex: 0606060606) *',
            /* Subject validation */
            'subject.required' => 'يرجى ادخال الموضوع *',
            'subject.regex' => 'يرجى ادخال موضوع صالح *',
            'subject.min' => 'يرجى ادخال موضوع صالح *',
            'subject.max' => 'النص أطول من اللازم *',
            /* Message validation */
            'message.required' => 'يرجى ادخال الرسالة *',
            'message.regex' => 'يرجى ادخال رسالة (مسموح فقط بالحروف والأرقام) *',
            'message.min' => 'يرجى ادخال الرسالة (25-700 حرف) *',
            'message.max' => 'يرجى ادخال الرسالة (25-700 حرف) *',
        ]);

        return Contact::create([
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'phonenumb' => $request['phonenumb'],
            'subject' => $request['subject'],
            'message' => $request['message'],


        ]);
        return response()->json(
            [
                'success' => true,
                'message' => 'تم تلقي رسالتك'
            ]
        );
    }
}