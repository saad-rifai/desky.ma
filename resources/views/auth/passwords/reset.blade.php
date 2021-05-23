
    
@extends('layouts.layout')
@section('title', 'اعادة تعيين كلمة السر')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
@section('ogimage', asset('image/moqawala.ma.jpg'))
@section('content')
<div  class="form-border wd-80 uk-margin-top uk-margin-bottom uk-card-default uk-padding">
    <h2 class="uk-card-title uk-text-right">اعادة تعيين كلمة السر</h2>
    <form dir="rtl" class="uk-grid-small " action="{{ route('password.update') }}" method="post" uk-grid>
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        @if (isset($_GET['ref']))
        <input type="hidden" name="ref" value="{{ $_GET['ref'] ?? '' }}">

        @endif

<div class="uk-width-1-1@s">

@if (\Session::has('error'))

    <div class="uk-alert-danger" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>{!! \Session::get('error') !!}</p>
    </div>
@endif

</div>
        <div class="uk-width-1-1@s">
            <label class="uk-form-label" for="">البريد الالكتروني </label>
            <div class="uk-form-controls">
            <input class="uk-input @error('email') uk-form-danger @enderror" type="text" name="email"  value="{{ $email ?? old('email') }}"   required placeholder="">
            </div>
        </div>
        @error("email")
        <span class="uk-text-danger" >
            {{ $message }}
        </span>
        @enderror
        <div class="uk-width-1-1@s">
            <label for="">كلمة السر الجديدة</label>
            <div class="uk-form-controls">
            <input class="uk-input @error('password') uk-form-danger @enderror" type="password" name="password" placeholder="" required>
            </div>
        </div>
        @error('password')
        <span class="uk-text-danger" >
            {{ $message }}
        </span>
    @enderror
    <div class="uk-width-1-1@s">
        <label for="">اعادة تأكيد كلمة السر  </label>
        <div class="uk-form-controls">
        <input class="uk-input" type="password" name="password_confirmation" placeholder="" required>
        </div>
    </div>
        <div class="uk-width-1-1@s">
            <button class="uk-button uk-button-primary">الدخول</button>

        </div>

    </form>
</div>
@endsection

    

