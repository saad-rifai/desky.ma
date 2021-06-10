@extends('desky.layouts.app')

@section('title', 'الباقات والأسعار')
@section('description',' أول مكتب خاص بالمقاول الذاتي على الانترنت لادارة نشاطك التجاري باحترافية من أي مكان وفي أي وقت.',)
@section('ogimage', asset('image/service/2.jpg'))
@section('content')
<header style="height: 400px">
    <div class="uk-child-width-1-1@s uk-light" uk-grid>
        <div>
            <div  class="uk-background-cover uk-height-large uk-panel uk-flex uk-flex-center uk-flex-middle"
                style="background-image: linear-gradient(rgb(255 175 33), rgb(255 111 44)); height: 400px !important">
                <div  class="wd-90 uk-text-center">
                    <div class="content-header uk-text-center">
                        <h1 class="uk-title header">الأسعار والباقات</h1>
                        </p>


                    </div>
                </div>
            </div>
        </div>
</header>
<div style="">
@include('desky.layouts.packs')
</div>



<div id="partners" class="wd-80 uk-text-center uk-margin">
    <h1 class="uk-card-title">
        شركائنا
    </h1>
    <div uk-scrollspy="cls: uk-animation-fade; target: .brand-logo; delay: 500; repeat: true" class="brands">
        <img class="brand-logo" src="image/partners/binga-logo.png" title="BINGA.MA">
        <img class="brand-logo" src="image/partners/moqawala.ma.png" title="MOQAWALA.MA">
        <img class="brand-logo" src="image/partners/logo_wafa.png" title="WAFACACH.MA">
    </div>
</div>
<br>
<br>
@include('desky.layouts.q-a')

@endsection
