@extends('layouts.layout')
@section('title', 'تفعيل الحساب')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
@section('ogimage', asset('image/moqawala.ma.jpg'))
@section('content')
<div  class="form-border wd-80 uk-margin-top uk-margin-bottom uk-card-default uk-padding">
    <h2 class="uk-card-title uk-text-center">يرجى تأكيد بريدك الالكتروني </h2>
    <form dir="rtl" class="uk-grid-small uk-text-center" uk-grid>
@csrf
        <div class="uk-width-1-1@s">
            <img class="icon_form" src="{{ asset('image/icon/undraw_mail_2_tqip.svg') }}" alt="">
            @if (session('resent'))
            <div class="uk-alert-success" uk-alert>
                {{ __('تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني.') }}
            </div>
        @endif
<p dir="rtl">قبل المتابعة ، يرجى التحقق من بريدك الإلكتروني لتفعيل حسابك. <br>
    إذا لم تستلم البريد الإلكتروني
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="uk-button uk-button-link">اضغط هنا لارسال رابط أخر</button>.
    </form>
</p>

        </div>
    </div>


    </form>
</div>
@endsection