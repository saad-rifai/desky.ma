@guest

@extends('desky.panel.headform')

@section('title', 'تسجيل الدخول')
@section('content')
<div  class="form-border wd-80 uk-margin-top uk-margin-bottom uk-card-default uk-padding">
    <h2 class="uk-card-title uk-text-right">تسجيل الدخول </h2>
    <hr class="uk-divider-icon">

    <form dir="rtl" class="uk-grid-small " action="{{ asset("/auth/login")}}" method="post" uk-grid>
        <input type="hidden" name="ref" value="{{ $_GET['ref'] ?? '' }}">

@csrf
<div class="uk-width-1-1@s">

@if (\Session::has('error'))

    <div class="uk-alert-danger" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>{!! \Session::get('error') !!}</p>
    </div>
@endif
@if (\Session::has('password_update'))

    <div class="uk-alert-success" uk-alert>
        <p>{!! \Session::get('password_update') !!}</p>
    </div>
@endif
</div>
<div class="uk-width-1-2@s">
    <button class="uk-button google-btn uk-width-1-1"><i class="fab fa-google"></i> باستخدام جوجل </button>
</div>
<div class="uk-width-1-2@s">
    <button class="uk-button facebook-btn uk-width-1-1"><i class="fab fa-facebook-f"></i> باستخدام فيسبوك </button>

</div>
<div  class="uk-width-1-1@s">
  <br>


</div>
        <div class="uk-width-1-1@s">

            <label class="uk-form-label" for=""> </label>
            <div class="uk-form-controls desky-input">
            <input  class="uk-input @error('email') uk-form-danger @enderror" type="text" name="email"  required >
            <span class="label-input">البريد الالكتروني</span>

            </div>
        </div>
        @error("email")
        <span class="uk-text-danger" >
            {{ $message }}
        </span>
        @enderror
        <div class="uk-width-1-1@s">
            <div class="uk-form-controls">

            <input class="uk-input" type="password" name="password" required>
            <span class="label-input">كلمة السر</span>

            <a href="reset_password" class="uk-link-text"> اعادة تعيين كلمة السر</a>
            </div>
        </div>
        @error('password')
        <span class="uk-text-danger" >
            {{ $message }}
        </span>
    @enderror
        <div class="uk-width-1-1">

            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                <label><input class="uk-checkbox" name="remember" id="remember" type="checkbox"> تذكرني</label>
            </div>
        </div>
        <div class="uk-width-1-1@s">
            <button class="uk-button uk-button-primary">الدخول</button>

        </div>
        <div class="uk-width-1-1@s uk-text-center">
<p>لاتمتلك حساب بعد ؟ <a href="http://account.{{env('APP_URL')}}/register?ref={{ $_GET['ref'] ?? 'false' }}">انشئ حسابك الأن</a></p>
        </div>
    </form>
</div>
@endsection


@else

@php
  return redirect()->intended('/');
@endphp
@endguest
