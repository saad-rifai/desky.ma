@extends('layouts.layout')
@section('title', 'اعادة تعيين كلمة السعر')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
@section('ogimage', asset('image/moqawala.ma.jpg'))
@section('content')
<div  class="form-border wd-80 uk-margin-top uk-margin-bottom uk-card-default uk-padding">
    <h2 class="uk-card-title uk-text-right">اعادة تعيين كلمة السعر</h2>
    @if (session('status'))
    <div class="uk-alert-success" dir="rtl" uk-alert>
        لقد أرسلنا رسالة اعادة تعيين كلمة السر الى بريدك الالكتروني.
    </div>
    @endif
    <form dir="rtl" class="uk-grid-small " action="{{ route('password.email') }}" method="POST" uk-grid>
@csrf
        <div class="uk-width-1-1@s">
            <label class="uk-form-label" for="">البريد الالكتروني <span class="red">*</span></label>
            <div class="uk-form-controls">
            <input class="uk-input @error('email') uk-form-danger @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus type="email" placeholder="">
        </div>
        @error('email')
        <span class="uk-text-danger">
            @php if($message == "passwords.user") { echo 'البريد الالكتروني غير مسجل *'; }elseif($message == "validation.email") {
                 echo 'يرجى ادخال بريد الكتروني صالح *';
            }elseif($message == "validation.required") {
                echo 'يرجى ادخال البريد الالكتروني *';
            }else {
                echo $message;
            }
             @endphp
        </span>
    @enderror
    </div>
        <div class="uk-width-1-1@s">
            <button class="uk-button uk-button-primary">ارسال</button>

        </div>

    </form>
</div>
@endsection