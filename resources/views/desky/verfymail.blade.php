@extends('desky.panel.headform')
@section('title', 'من أجل ادارة نشاطك من أي مكان وفي أي وقت')
@section('description',
    ' أول مكتب خاص بالمقاول الذاتي على الانترنت لادارة نشاطك التجاري باحترافية من أي مكان وفي أي
    وقت.',)
@section('ogimage', asset('image/service/2.jpg'))
@section('content')
<br>
<!--div class="wd-80 uk-card uk-card-default uk-card-body  uk-margin uk-text-center">
    <div class="icon_statu"><img src="{{ URL::asset('image/icon/success.png') }}" alt=""></div>
    <h1 class="uk-card-title " dir="rtl">تم تأكيد بريدك الالكتروني بنجاح !</h1>
   <a href="{{ URL::asset('') }}"><button class="uk-button uk-button-primary">الرئيسة</button></a>

</div-->
<div class="wd-80 uk-card uk-card-default uk-card-body  uk-margin uk-text-center">
@if ($succes == false)
<div class="icon_statu"><img src="{{ URL::asset('image/icon/error.png') }}" alt=""></div>
<h1 class="uk-card-title " dir="rtl">لقد فشل تأكيد بريدك الالكتروني يرجى اعادة المحاولة لاحقاََ</h1>
<a href="{{ route('homepage') }}"><button class="uk-button uk-button-primary">الرئيسة</button></a>


@else

@endif
<div class="icon_statu"><img src="{{ URL::asset('image/icon/success.png') }}" alt=""></div>
<h1 class="uk-card-title " dir="rtl">تم تأكيد بريدك الالكتروني بنجاح !</h1>
<a href="{{ route('homepage') }}"><button class="uk-button uk-button-primary">الرئيسة</button></a>
</div>


@endsection
