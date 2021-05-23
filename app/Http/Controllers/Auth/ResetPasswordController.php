<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Request;
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

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => 'required|confirmed|min:8|max:25',
        ];
    }

    protected function validationErrorMessages()
    {
        return [
            'required' => 'هذا الحقل مطلوب *',
            'email.exists' => 'هذا البريد الالكتروني غير مسجل *',
            'email.email' => 'يرجى ادخال بريد الكتروني صالح *',
            'password.confirmed' => 'كلمة السر غير متطابقة *',
            'password.min' => 'يجب أن تتكون كلمة السر من 8 أحرف على الأقل *',
            'password.max' => 'كلمة السر أطول من اللازم *',
        ];
    }
    protected $redirectTo = RouteServiceProvider::HOME;
}
