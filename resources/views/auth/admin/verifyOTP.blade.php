@extends('auth.layouts.layout')
@section('title', 'رمز التحقق OTP')
<script src="{{ asset('js/admin.js') }}" defer></script>

@section('content')
<div class="page-load" id="page-load"></div>


<div class="container">
    <div class="logo-brand-top-card mt-5 mb-5">
        <img src="{{ asset('img/brand/logo-web.png') }}" alt="desky - login">
    </div>
    <div class="form-head text-center" dir="rtl">
        <h1 class="form-head-title">رمز التحقق OTP</h1>
    </div>
    <div class="card p-3 mt-3 mb-5 mx-auto" style="max-width: 500px" dir="rtl">
        <div class="content-form p-3 pt-1">

            <div id="admin">
                <opt-check :csrf="'{{csrf_token()}}'"></opt-check>

            </div>
       
        </div>


    </div>
    <div class="text-center p-3 mt-3 mb-5 mx-auto" style="max-width: 750px" dir="rtl">
        <div class="content-form p-3 mx-auto" >
            <span class="text-center font-Naskh"> تذكرت كلمة المرور ؟ <a href="{{ asset('login') }}">سجل الدخول</a></span>
        </div>
    </div>
</div>
@stop