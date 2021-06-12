@extends('desky.layouts.app')
@section('title', 'من أجل ادارة نشاطك من أي مكان وفي أي وقت')
@section('description',
    ' أول مكتب خاص بالمقاول الذاتي على الانترنت لادارة نشاطك التجاري باحترافية من أي مكان وفي أي
    وقت.',)
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
                            <div class="" ><img src="{{ asset('image/desky/landing-page/1.png') }}" width="1050"
                                    alt="dashboard - desky.ma" >
                                </div>
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="content-header uk-text-right uk-margin ">
                                <h1 class="uk-title header uk-margin-large-top ">نظام ادارة نشاط المقاول الذاتي</h1>
                                <h4 class="uk-margin-small-top uk-margin-medium-bottom">أول مكتب خاص بالمقاول الذاتي على الانترنت لادارة نشاطك التجاري
                                    باحترافية من أي مكان وفي أي وقت, ببساطة لم تعهدها من قبل.</h4>
                                </p>
                                <a href="/register"> <button type="button"
                                        class="uk-button uk-button-default btn-call">سجل الأن
                                    </button></a>
                                    <a href="#tarifs" uk-scroll> <button type="button"
                                        class="uk-button uk-button-text">الباقات والأسعار
                                    </button></a>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </header>
    <div class="wd-80 uk-margin uk-margin-bottom" id="aboutservice" uk-scrollspy="cls:uk-animation-fade; repeat: true">
        <article class="uk-article" align="center">

            <h1 style="font-size: 25px" class="uk-article-title">عن الخدمة</h1>
            <p style="width: 100%; max-width: 650px; margin-left: auto; margin-right: auto;" dir="rtl"> تقدم لك <strong>منصة desky.ma</strong>  <strong>نظام احترافي لادارة نشاط المقاول الذاتي </strong> يمكن من خلاله ادارة كافة جوانب عملك تمكنك المنصة من انشاء وادارة الفواتير وعروض أسعار (devis) احترافية ببساطة وسهولة بهويتك البصرية كما تمكنك المنصة من ادارة وتسيير عملائك وانجاز تقارير وتحليلات شهرية وسنوية وتمكنك من حساب وتوقع الضرائب الخاصة بك .</p>
            </article>


    </div>
    <br><br>
    <div class="wd-80 uk-margin uk-text-center ">
        <h1 class="uk-card-title uk-text-center">مالذي تقدمه المنصة</h1>
        <br>
        <br>
        <div class="uk-grid-column-small uk-grid-row-large uk-child-width-1-3@s uk-text-center  uk-flex-center" uk-grid>
            <div>
                <h3 class="uk-card-title c-org">نظام ادارة الفواتير وعروض الأسعار</h3>

                <div class="uk-card uk-card-body"><img
                        src="{{ URL::asset('image/icon/undraw_Documents_re_isxv.svg') }}"
                        alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services"></div>
                <p dir="rtl">تقدم لك منصة <strong>desky</strong> نظام متكامل لادارة الفواتير وعروض الأسعار الخاصة بك وتمكنك من انشاء نماذج فواتير وعروض أسعار احترافية بهويتك البصرية </p>
            </div>
            <div>
                <h3 class="uk-card-title c-org">
                     نظام ادارة العملاء

                    </h3>

                <div class="uk-card uk-card-body"><img src="{{ URL::asset('image/icon/undraw_Friends_online_re_r7pq.svg') }}"
                        alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services"></div>
                <p dir="rtl">تقدم لك منصة <strong>desky</strong> نظام احترافي لادارة عملائك وحفظ المعلومات الخاصة بهم في أمان تام من أجل تجنب ضياعها
                .</p>

            </div>
            <div>
                <h3 class="uk-card-title c-org">التقارير والاحصائيات

                </h3>

                <div class="uk-card uk-card-body"><img src="{{ URL::asset('image/icon/undraw_growth_chart_r99m.svg') }}"
                        alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services"></div>
                <p dir="rtl">تمكنك منصة <strong>desky</strong> من انجاز تقارير واحصائيات سنوية وشهرية وربع سنوية مفصلة تساعدك على تحليل نشاطك التجاري وتطويره وقياس نسبة النمو والمقارنة مع المنافسين.</p>
            </div>
            <div>
                <h3 class="uk-card-title c-org">المحاسبة والضرائب </h3>

                <div class="uk-card uk-card-body"><img src="{{ URL::asset('image/icon/undraw_discount_d4bd.svg') }}"
                        alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services"></div>
                <p dir="rtl">تقدم لك منصة <strong>desky.ma</strong> نظام يساعدك على توقع وحساب الضرائب المستحقة بدقة وبساطة بدون اي مجهود يتم حساب كافة الضرائب تلقائياََ بنائا على الاعدادات المسبقة.</p>
            </div>
        </div>

    </div>
    <br>
    <br>
    <div id="facture" class="wd-90 uk-margin-top ">

        <div uk-scrollspy="cls: uk-animation-slide-right; target: .uk-card-body; delay: 300; repeat: true"
            class="uk-card  uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>


            <div uk-scrollspy="cls: uk-animation-slide-top; delay: 300; repeat: true"
                class="uk-inline uk-card-media-right  ">

                <img height="300px" src="{{ URL::asset('image/desky/landing-page/devis-factures-steps.png') }}" alt="Desky من نحن">

            </div>
            <div class="align-flex">
                <div class="uk-card-body uk-text-right " dir="rtl">
                    <h3 class="uk-card-title">أنشئ فواتيرك وعروض الاسعار الخاصة بك بخطوات بسيطة</h3>
                    <p>تمكنك منصة ديسكي من انشاء فواتيرك وعروض الأسعار الخاصة بك (Devis) احترافية بهويتك البصرية ببساطة وسهولة لم تعهدها من قبل.</p>
                    <a href='/register' target="_blank" uk-toggle> <button type="button"
                            class="uk-button uk-button-primary btn-call">
                            سجل الأن</button></a>
                            <a href="#tarifs" uk-scroll><button class="uk-button uk-button-text">الباقات والأسعار</button> </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div id="facture" class="wd-90 uk-margin-top ">

        <div uk-scrollspy="cls: uk-animation-slide-right; target: .uk-card-body; delay: 300; repeat: true"
            class="uk-card  uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>

            <div class="align-flex">
                <div class="uk-card-body uk-text-right " dir="rtl">
                    <h3 class="uk-card-title">الاحصائيات والتقارير</h3>
                    <p>تمكنك منصة desky.ma من انجاز تقارير واحصائيات سنوية وشهرية وربع سنوية من أجل مراقبة وتحليل نمو نشاطك التجاري.</p>                    <a href='/register' target="_blank" uk-toggle> <button type="button"
                            class="uk-button uk-button-primary btn-call">
                            سجل الأن</button></a>
                            <a href="#tarifs" uk-scroll><button class="uk-button uk-button-text">الباقات والأسعار</button> </a>
                </div>
            </div>
            <div uk-scrollspy="cls: uk-animation-slide-top; delay: 300; repeat: true"
            class="uk-inline uk-card-media-right  ">

            <img height="300px" src="{{ URL::asset('image/desky/landing-page/report-steps.png') }}" alt="Desky من نحن">

        </div>
        </div>
    </div>
    <br>
    <br>
    <div id="facture" class="wd-90 uk-margin-top ">

        <div uk-scrollspy="cls: uk-animation-slide-right; target: .uk-card-body; delay: 300; repeat: true"
            class="uk-card  uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
            <div uk-scrollspy="cls: uk-animation-slide-top; delay: 300; repeat: true"
                class="uk-inline uk-card-media-right  ">

                <img height="300px" src="{{ URL::asset('image/desky/landing-page/impot.png') }}" alt="Desky من نحن">

            </div>
            <div class="align-flex">
                <div class="uk-card-body uk-text-right " dir="rtl">
                    <h3 class="uk-card-title">حساب وتوقع الضرائب</h3>
                    <p>تقدم لك منصة desky.ma نظام لحساب وتوقع الضرائب الخاصة بك  لتجنب المفاجئات </p>                     <a href='/register' target="_blank" uk-toggle> <button type="button"
                            class="uk-button uk-button-primary btn-call">
                            سجل الأن</button></a>
                            <a href="#tarifs" uk-scroll><button class="uk-button uk-button-text">الباقات والأسعار</button> </a>
                </div>
            </div>

        </div>
    </div>
    <br>
    <br>
    <h1 id="tarifs" class="uk-card-title uk-text-center">الباقات والأسعار</h1>
    @include('desky.layouts.packs')



    <br>
    <br>

    <div id="a-propos-de-nous" class="wd-90 uk-margin-top ">

        <div uk-scrollspy="cls: uk-animation-slide-right; target: .uk-card-body; delay: 300; repeat: true"
            class="uk-card  uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
            <div uk-scrollspy="cls: uk-animation-slide-top; delay: 300; repeat: true"
                class="uk-inline uk-card-media-right  uk-cover-container" >
                <canvas height="500px"></canvas>

                <img height="300px" src="{{ URL::asset('image/service/3182762.jpg') }}" alt="Desky من نحن" uk-cover>

            </div>
            <div class="align-flex">
                <div class="uk-card-body uk-text-right " dir="rtl">
                    <h3 class="uk-card-title">من نحن ؟</h3>
                    <p>منصة desky.ma تابعة لشركة NerYou LLC التي تهتم بتطوير ورقمنة السوق المغربية من خلال ابتكار وتطوير حلول عملية وطرحها في السوق, تأسست شركة NerYou LLC سنة 2021 بمدينة طنجة شمال المغرب لتنطلق في رحلتها ومهمتها التي اسست من أجلها وهي تطوير ورقمنة السوق المغربية. </p>                     <a href='/register' target="_blank" uk-toggle> <button type="button"
                            class="uk-button uk-button-primary btn-call">
                            سجل الأن</button></a>
                            <a href="#tarifs" uk-scroll><button class="uk-button uk-button-text">الباقات والأسعار</button> </a>
                </div>
            </div>

        </div>
    </div>
    <br>
    <br>


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
