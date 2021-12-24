
@extends('auth.layouts.layout')
@section('title', 'انشاء حساب')

@section('content')
    <div class="page-load" id="page-load"></div>
    <div class="container">
        <div class="logo-brand-top-card mt-5 mb-5">
            <img src="{{ asset('https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/brand/logo-web.png') }}" alt="desky - login">
        </div>
        <div class="form-head text-center" dir="rtl">
            <h1 class="form-head-title">مرحبا بك سعداء بانضمامك لنا</h1>
            <p class="form-head-text">نحتاج بعض المعلومات منك لانشاء حسابك</p>
        </div>
        <div class="card p-3 mt-3 mb-5 mx-auto" style="max-width: 750px" dir="rtl">
            <div class="content-form p-3 pt-1">



           
      
              <div id="app">
                  <register-form></register-form>
              </div>
            </div>


        </div>
        <div class="text-center p-3 mt-3 mb-5 mx-auto font-Naskh" style="max-width: 750px" dir="rtl">
            <div class="content-form p-3 mx-auto">
                <span class="text-center"> لديك حساب بالفعل ؟ <a href="{{ asset('login') }}">سجل الدخول</a></span>
            </div>
        </div>
    </div>

@stop