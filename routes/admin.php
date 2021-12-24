<?php 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

Route::get('check/otp', function () {
    return view("auth.admin.verifyOTP");
});
?>