@extends('desky.panel.headform')
@section('title', 'اعادة تعيين كلمة السر')

@section('content')
<br>
<script src='https://www.google.com/recaptcha/api.js'></script>

<div class="form-border wd-80 uk-margin-top uk-margin-bottom uk-card-default uk-padding ">
@if (isset($error))
<div class="uk-text-center">
<div class="icon_statu"><img src="{{ URL::asset('image/icon/error.png') }}" alt=""></div>
<h1 class="uk-card-title " dir="rtl">{{$error}}</h1>
<a href="{{'http://'.env('APP_URL').'?Home.do&ref=email_verfy&t='}}"><button class="uk-button uk-button-primary">الرئيسة</button></a>
</div>
@endif

@if(isset($success))
@if ($errors->any())
<div class="uk-alert-danger uk-text-right" dir="rtl" uk-alert>
    <p>

        @php
        foreach ($errors->all() as $error);
        echo $error;
        @endphp
      </p>


</div>
@endif
<form class="uk-text-right" dir="rtl" action="/ResetPassword/NewPass/new/{{$success}}" method="POST">
@csrf

<h1 class="uk-card-title " dir="rtl">اعادة تعيين كلمة السر</h1>
<hr class="uk-divider-icon">

<div uk-grid>
    <div class="uk-width-1-2@s">
        <label for="password" >كلمة السر الجديدة</label>
        <div class="uk-margin" >

            <input class="uk-input" type="password" name="password" id="password" >
        </div>
    </div>
    <div class="uk-width-1-2@s">
        <label for="password_confirmation" >اعادة تأكيد كلمة السر</label>
        <div class="uk-margin" >

            <input class="uk-input" type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
    </div>
    <div class="uk-width-1-1@s">
        <div class="uk-margin" >

        <div class="g-recaptcha" id="recaptcha-main" data-sitekey="{{config('services.recaptcha.key')}}"></div>
        </div>
      </div>
</div>

<div class="uk-margin " >
    <button class="uk-button uk-button-primary" type="submit">حفظ</button>

</div>

</form>
</div>

@endif
@endsection
