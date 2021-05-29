@extends('desky.layouts.app')
@section('title', 'من أجل ادارة نشاطك من أي مكان وفي أي وقت')
@section('description',
    ' أول مكتب خاص بالمقاول الذاتي على الانترنت لادارة نشاطك التجاري باحترافية من أي مكان وفي أي
    وقت.',)
@section('ogimage', asset('image/service/2.jpg'))
@section('content')
@section('back-color', 'background-color-orange')
    @php
    @endphp
    <header>
        <div class="uk-child-width-1-1@s uk-light" uk-grid>
            <div>
                <div class="uk-background-cover uk-height-large uk-panel uk-flex uk-flex-center uk-flex-middle"
                    style="    background-image: linear-gradient(rgba(250, 184, 66, 0.75), rgba(250, 128, 71, 0.74)), url('../image/header.jpg')">
                    <div class="uk-text-center uk-width-1-1" dir="rtl" uk-grid>
                        <div class="uk-width-1-2@s">
                            <div class=""><img src="{{ asset('image/desky/landing-page/dashboard-ae.png') }}" width="1050"
                                    alt="dashboard - desky.ma" ></div>
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="content-header uk-text-right uk-margin ">
                                <h1 class="uk-title header uk-margin-large-top ">نظام ادارة نشاط المقاول الذاتي</h1>
                                <h4 class="uk-margin-small-top uk-margin-medium-bottom">أول مكتب خاص بالمقاول الذاتي على الانترنت لادارة نشاطك التجاري
                                    باحترافية من أي مكان وفي أي وقت, ببساطة لم تعهدها من قبل.</h4>
                                </p>
                                <a href="#form-demande-branding"> <button type="button"
                                        class="uk-button uk-button-default btn-call">سجل الأن
                                    </button></a>
                                    <a href="#form-demande-branding"> <button type="button"
                                        class="uk-button uk-button-text">المزيد
                                    </button></a>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </header>
    <div class="wd-80 uk-margin uk-margin-bottom" id="aboutus" uk-scrollspy="cls:uk-animation-fade; repeat: true">
        <article class="uk-article" align="center">

            <h1 style="font-size: 25px" class="uk-article-title">عن الخدمة</h1>
            <p style="width: 100%; max-width: 650px; margin-left: auto; margin-right: auto;" dir="rtl"> Desky توفر لك عدة
                مزايا منها ادارة نشاطك التجاري كمقاول ذاتي وانشاء الفواتير وعروض الأسعار (الدوفي) بشكل احترافي يمكنك من
                التعامل مع الشركات والمقاولات والدخول الى الصفقات العمومية, بخلاصة منصة Desky ترافقك لانشاء نظام احترافي
                للعمل لرفع رقم المعاملات الخاص بك </p>
        </article>


    </div>
    <br><br>
    <div class="wd-90 uk-margin ">
        <h1 class="uk-card-title uk-text-center">مميزات الخدمة</h1>
        <br>
        <br>
        <div class="uk-grid-column-small uk-grid-row-large uk-child-width-1-4@s uk-text-center" uk-grid>
            <div>
                <h3 class="uk-card-title c-org">في أي وقت ومن أي مكان</h3>

                <div class="uk-card uk-card-body"><img
                        src="{{ URL::asset('image/icon/undraw_real_time_collaboration_c62i.svg') }}"
                        alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services"></div>
                <p dir="rtl">تمكنك منصة Desky من أعداد الفواتير وعروض الاسعار الخاصة بك وارسالها الى عملائك في أي وقت ومن أي
                    مكان </p>
            </div>
            <div>
                <h3 class="uk-card-title c-org">السهولة والاحترافية</h3>

                <div class="uk-card uk-card-body"><img src="{{ URL::asset('image/icon/undraw_Letter_re_8m03.svg') }}"
                        alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services"></div>
                <p dir="rtl">تقدم لك منصة Desky نظام فوترة سهل الاستخدام يمكنك من تنظيم نشاطك كمقاول ذاتي والعمل باحترافية.
                </p>

            </div>
            <div>
                <h3 class="uk-card-title c-org">شبكة المقاولين الذاتيين</h3>

                <div class="uk-card uk-card-body"><img src="{{ URL::asset('image/icon/undraw_Connected_re_lmq2.svg') }}"
                        alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services"></div>
                <p dir="rtl">بانظمامك الى منصة Desky يتم اضافتك الى شبكة المقاولين الذاتيين بالمغرب التي تمكنك من الترويج
                    الى نشاطك وكسب عملاء جدد</p>
            </div>
            <div>
                <h3 class="uk-card-title c-org">تنظيم البيانات </h3>

                <div class="uk-card uk-card-body"><img src="{{ URL::asset('image/icon/undraw_remotely_2j6y.svg') }}"
                        alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services"></div>
                <p dir="rtl">تقدم لك منصة Desky نظام فوترة يمكنك من تنظيم وادارة العملاء والفواتير وعروض الاسعار الخاصة بك
                </p>
            </div>
        </div>

    </div>
    <br>
    <br>
    <div id="facture" class="wd-90 uk-margin-top">

        <div uk-scrollspy="cls: uk-animation-slide-right; target: .uk-card-body; delay: 300; repeat: true"
            class="uk-card  uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>

            <div>
                <div class="uk-card-body uk-text-right" dir="rtl">
                    <h3 class="uk-card-title">ماهي الفاتورة وما أهميتها ؟</h3>
                    <p>Desky هي منصة تابعة لي MOQAWALA.MA التي ساهمة في تأطير وتطوير أكثر من 1000 مقاول ذاتي بالمغرب
                        وساعدتهم على تأسيس نظام عمل ناجح</p>
                    <a href='#form-demande-development-informatique' target="_blank" uk-toggle> <button type="button"
                            class="uk-button uk-button-primary btn-call">
                            سجل الأن</button></a>
                </div>
            </div>
            <div uk-scrollspy="cls: uk-animation-slide-right; delay: 300; repeat: true"
                class="uk-inline uk-card-media-right uk-cover-container">
                <img src="{{ URL::asset('image/service/Modele-de-facture-maroc.jpg') }}" alt="Desky من نحن" uk-cover>

                <canvas width="600" height="400"></canvas>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div id="devis" class="wd-90 uk-margin-top">

        <div uk-scrollspy="cls: uk-animation-slide-right; target: .uk-card-body; delay: 300; repeat: true"
            class="uk-card  uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>

            <div uk-scrollspy="cls: uk-animation-slide-left; delay: 300; repeat: true"
                class="uk-inline uk-card-media-left uk-cover-container">
                <img src="{{ URL::asset('image/service/exemple-de-devis-fr-dexter-750px.png') }}" alt="Desky من نحن"
                    uk-cover>

                <canvas width="600" height="400"></canvas>
            </div>

            <div>
                <div class="uk-card-body uk-text-right" dir="rtl">
                    <h3 class="uk-card-title"> ماهو عرض الأسعار وماهي أهميته ؟</h3>
                    <p>Desky هي منصة تابعة لي MOQAWALA.MA التي ساهمة في تأطير وتطوير أكثر من 1000 مقاول ذاتي بالمغرب
                        وساعدتهم على تأسيس نظام عمل ناجح</p>
                    <a href='#form-demande-development-informatique' target="_blank" uk-toggle> <button type="button"
                            class="uk-button uk-button-primary btn-call">
                            سجل الأن</button></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div id="whyus" class="wd-90 uk-margin-top">

        <div uk-scrollspy="cls: uk-animation-slide-right; target: .uk-card-body; delay: 300; repeat: true"
            class="uk-card  uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
            <div>
                <div class="uk-card-body uk-text-right" dir="rtl">
                    <h3 class="uk-card-title"> من نحن ؟</h3>
                    <p>Desky هي منصة تابعة لي MOQAWALA.MA التي ساهمة في تأطير وتطوير أكثر من 1000 مقاول ذاتي بالمغرب
                        وساعدتهم على تأسيس نظام عمل ناجح</p>
                    <a href='#form-demande-development-informatique' target="_blank" uk-toggle> <button type="button"
                            class="uk-button uk-button-primary btn-call">
                            سجل الأن</button></a>
                </div>
            </div>
            <div uk-scrollspy="cls: uk-animation-slide-right; delay: 300; repeat: true"
                class="uk-inline uk-card-media-left uk-cover-container">
                <img src="{{ URL::asset('image/service/3182762.jpg') }}" alt="Desky من نحن" uk-cover>

                <canvas width="600" height="400"></canvas>
            </div>
        </div>
    </div>
    <br>
    <br>
    <h1 class="uk-card-title uk-text-center">الباقات والأسعار</h1>
    @include('desky.layouts.packs')



    <br>
    <br>

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
