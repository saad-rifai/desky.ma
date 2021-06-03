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
<div id="reviews" class="wd-90 uk-text-center uk-margin">
    <h1 class="uk-card-title">تعليقات</h1>
    <br>
    <div class="uk-slider-container-offset" uk-slider>

        <div class="uk-position-relative uk-visible-toggle" tabindex="-1">

            <ul class="uk-slider-items uk-child-width-1-3@s uk-grid">
                <li>
                    <div class="chiffre-border">
                        <div class="uk-comment-avatar" style="background-image: url('image/users/173560799_947125385828314_3570436792996144561_n.jpg')">
                        </div>
                        <h4 class="info-comment"> Saad Rifai
                            <br>
                            <small dir="rtl">منهدس برمجيات, NerYou LLC</small>

                        </h4>
                        <div class="starts-icons"><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span></div>

                        <p class="comment-custmer" dir="rtl">
                            على الرغم من أني كنت مساهم في تطوير المنصة أصبحت لا أستطيع الاستغناء عن المنصة في اعداد الفواتير وعروض الأسعار وتحليل التقارير.
                        </p>
                    </div>
                </li>
                <li>
                    <div class="chiffre-border">
                        <div class="uk-comment-avatar" style="background-image: url('image/users/121278590_3664561140255144_7541311586304254054_n.jpg')"></div>
                        <h4 class="info-comment"> Adil Miftah
                            <br>
                            <small  dir="rtl">المدير التنفيذي, NerYou LLC</small>
                        </h4>
                        <div class="starts-icons"><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span><span
                                class="material-icons">star</span><span class="material-icons">star</span></div>

                        <p class="comment-custmer" dir="rtl"> لقد عملنا على تطوير حل لادارة نشاط المقاول الذاتي بطريقة مبسطة وعملية وقوية وأمنة وبعد عمل طويل قد تم اطلاق منصة desky.ma التي جمعت كل مايحتاج المقاول الذاتي لادارة وتطوير نشاطه التجاري</p>
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
