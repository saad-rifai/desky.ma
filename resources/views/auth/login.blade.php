
@extends('auth.layouts.layout')
@section('title', 'تسجيل الدخول')

@section('content')
   
<div class="page-load" id="page-load"></div>


<div class="container">
    <div class="logo-brand-top-card mt-5 mb-5">
        <img src="{{ asset('https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/brand/logo-web.png') }}" alt="desky - login">
    </div>
    <div class="form-head text-center" dir="rtl">
        <h1 class="form-head-title">مرحبا بعودتك !</h1>
        <p class="form-head-text">سجل الدخول للمتابعة</p>
    </div>
    <div class="card p-3 mt-3 mb-5 mx-auto" style="max-width: 500px" dir="rtl">
        <div class="content-form p-3 pt-1">
     


            <div id="app">
                <login-form :csrf="'{{csrf_token()}}'" ></login-form>

            </div>

        </div>


    </div>
    <div class="font-Naskh p-3 mt-3 mb-5 mx-auto text-center" style="max-width: 500px" dir="rtl">
        <div class="content-form p-3 mx-auto" >
            <span class="text-center">ليس لديك حساب بعد <a href="{{asset("register")}}">انشاء حساب</a></span>
        </div>
    </div>
</div>



@stop