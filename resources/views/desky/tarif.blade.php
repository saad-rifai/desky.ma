@extends('desky.layouts.app')

@section('title', 'من أجل ادارة نشاطك من أي مكان وفي أي وقت')
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
<div id="reviews" class="wd-90 uk-text-center uk-margin">
    <h1 class="uk-card-title">أراء عملائنا</h1>
    <br>
    <div class="uk-slider-container-offset" uk-slider>

        <div class="uk-position-relative uk-visible-toggle" tabindex="-1">

            <ul class="uk-slider-items uk-child-width-1-3@s uk-grid">
                <li>
                    <div class="chiffre-border">
                        <h4 class="info-comment"> BEN HAKOU SALR AU</h4>
                        <div class="starts-icons"><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span></div>

                        <p class="comment-custmer" dir="rtl">
                            شكرا على الاحترافية في العمل
                        </p>
                    </div>
                </li>
                <li>
                    <div class="chiffre-border">
                        <h4 class="info-comment"> Pain O'choix</h4>
                        <div class="starts-icons"><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span></div>

                        <p class="comment-custmer" dir="rtl"> بفضل الله ثم انتم لليوم غانبدا مشروعي </p>
                    </div>
                </li>

                <li>
                    <div class="chiffre-border">
                        <h4 class="info-comment">Jahhar car </h4>
                        <div class="starts-icons"><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span></div>

                        <p class="comment-custmer" dir="rtl">
                            فريق احترافي شكرا لانكم ساندتوني باش نلقا تمويل نديماري بيه مشروعي
                        </p>
                    </div>
                </li>
                </li>
                <li>
                    <div class="chiffre-border">
                        <h4 class="info-comment">Promande car </h4>
                        <div class="starts-icons"><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span></div>

                        <p class="comment-custmer" dir="rtl">

                            انا كنقلب من شحال هتدي لي غادي يرافقني باش نلقا تمويل و نخلي مشروعي في الانترنت شكرا لكم
                        </p>
                    </div>
                </li>
                </li>
                <li>
                    <div class="chiffre-border">
                        <h4 class="info-comment">Red Rdk trans </h4>
                        <div class="starts-icons"><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span></div>

                        <p class="comment-custmer" dir="rtl">
                            اول مرة جيت للمغرب نبدا شركة ديالي للنقل تلاقيت مع فريق احترافي بعقلية عصرية شكرا على
                            المجهودات ديالكم
                        </p>
                    </div>
                </li>
            </ul>

            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous
                uk-slider-item="previous"></a>
            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
                uk-slider-item="next"></a>

        </div>

        <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

    </div>
    <!-- Slide  -->

</div>
<br>
<br>


<div id="partners" class="wd-80 uk-text-center uk-margin">
    <h1 class="uk-card-title">
        شركائنا
    </h1>
    <div uk-scrollspy="cls: uk-animation-fade; target: .brand-logo; delay: 500; repeat: true" class="brands">
        <img class="brand-logo" src="image/logo.png" title="MOQAWALA.MA">
    </div>
</div>
<br>
<br>
@include('desky.layouts.q-a')

@endsection
