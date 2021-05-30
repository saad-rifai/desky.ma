@extends('desky.panel.headform')
@section('title', 'خطأ '.$exception->getStatusCode())
@section('description', 'خطأ '.$exception->getStatusCode())
<style>
    .logo-pt{
        display: none !important;
    }
</style>
@section('content')
@if($exception->getStatusCode() == 404)

    <div class="form-border wd-80 uk-margin-top uk-margin-bottom  uk-padding">
       <div class="icon_statu uk-text-center"><img style="max-width: 40%" class="" src="{{asset('image/icon/404.svg')}}"></div>
        <h1 class="uk-error-code uk-text-center">! خطأ رقم {{ $exception->getStatusCode() }}       </h1>
        <p class="uk-text-center">لم يتم العثور على الصفحة المطلوبة يرجى التحقق من الرابط</p>
        <div class="uk-text-center uk-margin"><a href="{{asset('/')}}"><button class="uk-button uk-button-default ">الرئيسية</button></a></div>
    </div>

@endif
@if ($exception->getStatusCode() == 401)
<div class="form-border wd-80 uk-margin-top uk-margin-bottom  uk-padding">
    <div class="icon_statu uk-text-center"><img style="max-width: 40%" class="" src="{{asset('image/icon/Unauthorized-401.svg')}}"></div>
     <h1 class="uk-error-code uk-text-center">! خطأ رقم {{ $exception->getStatusCode() }}       </h1>
     <p class="uk-text-center">غير مسموح لك بالوصول الى هذا المكان</p>
     <div class="uk-text-center uk-margin"><a href="{{asset('/')}}"><button class="uk-button uk-button-default ">الرئيسية</button></a></div>
 </div>
@endif
@if ($exception->getStatusCode() == 402)
<div class="form-border wd-80 uk-margin-top uk-margin-bottom  uk-padding">
    <div class="icon_statu uk-text-center"><img style="max-width: 40%" class="" src="{{asset('image/icon/402.svg')}}"></div>
     <h1 class="uk-error-code uk-text-center">! خطأ رقم {{ $exception->getStatusCode() }}       </h1>
     <p class="uk-text-center">خطتك الحالية لاتسمح لك بالوصول الى هذا المكان, <br>
    ماذا أفعل ؟
    </p>
     <div class="uk-text-center uk-margin" dir="rtl">
        <a href="{{asset('/tarifs')}}"> <button class="uk-button  uk-button-primary">الاشتراك بباقة</button></a>
         <a href="{{asset('/')}}"><button class="uk-button uk-button-default ">الرئيسية</button></a>
        </div>
 </div>
@endif

@if($exception->getStatusCode() != 404 && $exception->getStatusCode() != 401 && $exception->getStatusCode() != 402)

    <div class="form-border wd-80 uk-margin-top uk-margin-bottom  uk-padding">
       <div class="icon_statu uk-text-center"><img style="max-width: 40%" class="" src="{{asset('image/icon/500.svg')}}"></div>
        <h1 class="uk-error-code uk-text-center">! خطأ رقم {{ $exception->getStatusCode() }}       </h1>
        <br>
        <div class="uk-text-center uk-margin"><a href="{{asset('/')}}"><button class="uk-button uk-button-default ">الرئيسية</button></a></div>
    </div>

@endif
@endsection
