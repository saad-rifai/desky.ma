@extends('desky.layouts.app')
@section('title', 'من أجل ادارة نشاطك من أي مكان وفي أي وقت')
@section('description',
    ' أول مكتب خاص بالمقاول الذاتي على الانترنت لادارة نشاطك التجاري باحترافية من أي مكان وفي أي
    وقت.',)
@section('content')
    @php
    @endphp
    <header>
        <div class="
                    header-content">
            <div class="header-grid uk-grid uk-child-width-1-2@s" uk-grid>
                <div>
                    <div class="text-section">
                        <h1>شبكة المقاولين الذاتيين المحترفين بالمغرب</h1>
                        <p>أول مكتب خاص بالمقاول الذاتي على الانترنت لادارة نشاطك التجاري باحترافية من أي مكان وفي أي وقت,
                            ببساطة لم تعهدها من قبل.
                        </p>
                        <div class="call-to-act-btn">
                            <button class="uk-button uk-button-primary trail-button">جرب مجانا</button>
                            <button class="uk-button  uk-button-default ">الاسعار</button>
                        </div>
                    </div>

                </div>
                <div>
                    <div class="video-section">
                        <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
                            <div class="wistia_responsive_wrapper"
                                style="height:100%;left:0;position:absolute;top:0;width:100%;"><iframe
                                    src="https://fast.wistia.net/embed/iframe/n1ik6rxzxh?videoFoam=true"
                                    title=" [Example Video] Wistia Video Essentials" allow="autoplay; fullscreen"
                                    allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed"
                                    name="wistia_embed" allowfullscreen msallowfullscreen width="100%"
                                    height="100%"></iframe></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </header>

    <!--div class="text-desky-ad-primary"> <p>تخفيض 50% على جميع الباقات</p> </div-->
    <div class="wd-80 uk-margin uk-margin-bottom uk-margin-large-top" id="aboutservice"
        uk-scrollspy="cls:uk-animation-fade; repeat: true">
        <article class="uk-article" align="center">

            <h1 class="uk-article-title" dir="rtl">ما هي منصة Desky ؟</h1>
            <p style="width: 100%; max-width: 650px; margin-left: auto; margin-right: auto;" dir="rtl"> تقدم لك <strong>منصة
                    desky.ma</strong> <strong>نظام احترافي لادارة نشاط المقاول الذاتي </strong> يمكن من خلاله ادارة كافة
                جوانب عملك تمكنك المنصة من انشاء وادارة الفواتير وعروض أسعار (devis) احترافية ببساطة وسهولة بهويتك البصرية
                كما تمكنك المنصة من ادارة وتسيير عملائك وانجاز تقارير وتحليلات شهرية وسنوية وتمكنك من حساب وتوقع الضرائب
                الخاصة بك .</p>
        </article>


    </div>
    <div class="wd-80 uk-margin uk-margin-bottom uk-margin-large-top" uk-scrollspy="cls:uk-animation-fade; repeat: true">
        <div align="center">

            <h1 class="uk-article-title" dir="rtl">أكبر شبكة للمقاولين الذاتيين بالمغرب</h1>

            <div class="users-avatars">
                <div class="users-avatars-content uk-flex uk-flex-center">
                    <div class="user-avatar"><img src="image/users/1.jpg" alt="user avatar"></div>
                    <div class="user-avatar"><img src="image/users/2.jpg" alt="user avatar"></div>
                    <div class="user-avatar"><img src="image/users/3.jpg" alt="user avatar"></div>
                    <div class="user-avatar"><img src="image/users/4.jpg" alt="user avatar"></div>
                    <div class="user-avatar"><img src="image/users/unnamed.jpg" alt="user avatar"></div>
                    <div class="user-avatar"><img src="image/users/f212571c02b2944ec623228d0ef60abd.png" alt="user avatar">
                    </div>
                    <span class="plus-users-avatars">+99</span>
                </div>
            </div>
        </div>


    </div>
    <br><br>
    <div class="wd-80 uk-margin uk-text-center " style="position: relative">
        <div class="white-border-canva"></div>
        <div class="index-100">
            <h1 class="uk-card-title uk-text-center" dir="rtl">مالذي تقدمه منصة desky ؟</h1>
            <br>
            <br>
            <div class="uk-grid-column-small uk-grid-row-large uk-child-width-1-3@s uk-text-center  uk-flex-center" uk-grid>
                <div>

                    <div class="uk-card uk-card-body"><img class="lazy"
                            src="{{ URL::asset('image/icon/tabler-icon-box.png') }}"
                            alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services">
                        <h3 class="uk-card-title ">نظام ادارة الفواتير وعروض الأسعار</h3>

                        <p dir="rtl">تقدم لك منصة <strong>desky</strong> نظام متكامل لادارة الفواتير وعروض الأسعار الخاصة بك
                            وتمكنك
                            من انشاء نماذج فواتير وعروض أسعار احترافية بهويتك البصرية </p>
                    </div>
                </div>
                <div>

                    <div class="uk-card uk-card-body"><img
                            src="{{ URL::asset('image/icon/tabler-icon-device-analytics.png') }}"
                            alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services">
                        <h3 class="uk-card-title ">نظام ادارة الفواتير وعروض الأسعار</h3>

                        <p dir="rtl">تقدم لك منصة <strong>desky</strong> نظام متكامل لادارة الفواتير وعروض الأسعار الخاصة بك
                            وتمكنك
                            من انشاء نماذج فواتير وعروض أسعار احترافية بهويتك البصرية </p>
                    </div>
                </div>
                <div>

                    <div class="uk-card uk-card-body"><img
                            src="{{ URL::asset('image/icon/tabler-icon-file-invoice.png') }}"
                            alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services">
                        <h3 class="uk-card-title ">نظام ادارة الفواتير وعروض الأسعار</h3>

                        <p dir="rtl">تقدم لك منصة <strong>desky</strong> نظام متكامل لادارة الفواتير وعروض الأسعار الخاصة بك
                            وتمكنك
                            من انشاء نماذج فواتير وعروض أسعار احترافية بهويتك البصرية </p>
                    </div>
                </div>
                <div>

                    <div class="uk-card uk-card-body"><img
                            src="{{ URL::asset('image/icon/tabler-icon-receipt-tax.png') }}"
                            alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services">
                        <h3 class="uk-card-title">نظام ادارة الفواتير وعروض الأسعار</h3>

                        <p dir="rtl">تقدم لك منصة <strong>desky</strong> نظام متكامل لادارة الفواتير وعروض الأسعار الخاصة بك
                            وتمكنك
                            من انشاء نماذج فواتير وعروض أسعار احترافية بهويتك البصرية </p>
                    </div>
                </div>
                <div>

                    <div class="uk-card uk-card-body"><img src="{{ URL::asset('image/icon/tabler-icon-social.png') }}"
                            alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services">
                        <h3 class="uk-card-title">نظام ادارة الفواتير وعروض الأسعار</h3>

                        <p dir="rtl">تقدم لك منصة <strong>desky</strong> نظام متكامل لادارة الفواتير وعروض الأسعار الخاصة بك
                            وتمكنك
                            من انشاء نماذج فواتير وعروض أسعار احترافية بهويتك البصرية </p>
                    </div>
                </div>
                <div>

                    <div class="uk-card uk-card-body"><img src="{{ URL::asset('image/icon/tabler-icon-users.png') }}"
                            alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services">
                        <h3 class="uk-card-title ">نظام ادارة الفواتير وعروض الأسعار</h3>

                        <p dir="rtl">تقدم لك منصة <strong>desky</strong> نظام متكامل لادارة الفواتير وعروض الأسعار الخاصة بك
                            وتمكنك
                            من انشاء نماذج فواتير وعروض أسعار احترافية بهويتك البصرية </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <br>
    <br>
    <div id="facture" class="wd-90 uk-margin-top ">

        <div class="uk-card  uk-grid-collapse uk-child-width-1-2@s uk-margin"
            uk-scrollspy="cls:uk-animation-fade; repeat: true" uk-grid>


            <div class="uk-inline uk-card-media-right  ">

                <img class="lazy" height="300px" data-src="{{ URL::asset('image/icon/Connected-cuate.svg') }}"
                    alt="شبكة المقاولين الذاتيين">

            </div>
            <div class="align-flex">
                <div class="uk-card-body uk-text-right " dir="rtl">
                    <h3 class="uk-card-title">دع العملاء المحتملين يتواصلون معك
                        من خلال أكبر شبكة للمقاولين الذاتيين</h3>
                    <p>تمكنك منصة ديسكي من انشاء فواتيرك وعروض الأسعار الخاصة بك (Devis) احترافية بهويتك البصرية ببساطة
                        وسهولة لم تعهدها من قبل.</p>
                    <a href='/register' target="_blank" uk-toggle> <button type="button"
                            class="uk-button uk-button-primary ">
                            سجل الأن</button></a>
                    <a href="#tarifs" uk-scroll><button class="uk-button  uk-button-default ">الاسعار</button> </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div id="facture" class="wd-90 uk-margin-top ">

        <div class="uk-card  uk-grid-collapse uk-child-width-1-2@s uk-margin"
            uk-scrollspy="cls:uk-animation-fade; repeat: true" uk-grid>

            <div class="align-flex">
                <div class="uk-card-body uk-text-right " dir="rtl">
                    <h3 class="uk-card-title">عشرات الصفقات في انتظارك
                        كل يوم</h3>
                    <p>تمكنك منصة desky.ma من انجاز تقارير واحصائيات سنوية وشهرية وربع سنوية من أجل مراقبة وتحليل نمو نشاطك
                        التجاري.</p>
                    <a href='/register' target="_blank" uk-toggle> <button type="button"
                            class="uk-button uk-button-primary ">
                            سجل الأن</button></a>
                    <a href="#tarifs" uk-scroll><button class="uk-button  uk-button-default ">الاسعار</button> </a>
                </div>
            </div>
            <div class="uk-inline uk-card-media-right  ">

                <img height="300px" src="{{ URL::asset('image/icon/Live collaboration-rafiki.svg') }}"
                    alt="الصفقات - desky">

            </div>
        </div>
    </div>
    <br>
    <br>
    <div id="facture" class="wd-90 uk-margin-top ">

        <div uk-scrollspy="cls:uk-animation-fade; repeat: true"
            class="uk-card  uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
            <div class="uk-inline uk-card-media-right  ">

                <img height="300px" src="{{ URL::asset('image/icon/Printing invoices-bro.svg') }}"
                    alt="نظام فوترة - desky">

            </div>
            <div class="align-flex">
                <div class="uk-card-body uk-text-right " dir="rtl">
                    <h3 class="uk-card-title">أنشئ فواتيرك وعروض الاسعار
                        الخاصة بك بخطوات بسيطة</h3>
                    <p>تمكنك منصة ديسكي من انشاء فواتيرك وعروض الأسعار الخاصة بك (Devis) احترافية بهويتك البصرية ببساطة
                        وسهولة لم تعهدها من قبل. </p>
                    <a href='/register' target="_blank" uk-toggle> <button type="button"
                            class="uk-button uk-button-primary ">
                            سجل الأن</button></a>
                    <a href="#tarifs" uk-scroll><button class="uk-button  uk-button-default ">الاسعار</button> </a>
                </div>
            </div>

        </div>
    </div>
    <br>
    <br>
    <div id="facture" class="wd-90 uk-margin-top ">

        <div class="uk-card  uk-grid-collapse uk-child-width-1-2@s uk-margin"
            uk-scrollspy="cls:uk-animation-fade; repeat: true" uk-grid>

            <div class="align-flex">
                <div class="uk-card-body uk-text-right " dir="rtl">
                    <h3 class="uk-card-title">نظام متكامل لإدارة نشاطك
                        وزيادة انتاجيتك
                    </h3>
                    <p>تمكنك منصة desky.ma من انجاز تقارير واحصائيات سنوية وشهرية وربع سنوية من أجل مراقبة وتحليل نمو نشاطك
                        التجاري.</p>
                    <a href='/register' target="_blank" uk-toggle> <button type="button"
                            class="uk-button uk-button-primary ">
                            سجل الأن</button></a>
                    <a href="#tarifs" uk-scroll><button class="uk-button  uk-button-default ">الاسعار</button> </a>
                </div>
            </div>
            <div class="uk-inline uk-card-media-right  ">

                <img height="300px" src="{{ URL::asset('image/icon/Dashboard-pana.svg') }}"
                    alt="نظام ادارة نشاط المقاول الذاتي - desky">

            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="wd-80 uk-margin uk-margin-bottom uk-margin-large-top" uk-scrollspy="cls:uk-animation-fade; repeat: true">
        <div align="center">

            <h1 class="uk-article-title" dir="rtl">اربط المنصة مع تطبيقاتك المفضلة</h1>
            <div  class="brands">
                <img class="brand-logo" src="image/partners/gmail.png" title="Gmail">
                <img class="brand-logo" src="image/partners/google-contact.png" title="google-contact">
                <img class="brand-logo" src="image/partners/google-drive.png" title="google-drive">
                <img class="brand-logo" src="image/partners/infobip.png" title="infobip">
                <img class="brand-logo" src="image/partners/mailchimp.png" title="mailchimp">
            </div>
        </div>
    </div>
    <br>
    <br>
    <h1 id="tarifs" class="uk-card-title uk-text-center">الباقات والأسعار</h1>
    @include('desky.layouts.packs')



    <br>
    <br>

    <div id="comments" class="wd-90 uk-margin-top uk-text-center" style="position: relative">
        <div class="white-border-canva"></div>
        <h1 class="uk-card-title">أراء عملائنا
        </h1>
        @include('desky.layouts.reviews')
<br>
<h1 class="uk-card-title">شركائنا
</h1>
<div  class="brands" style="position: relative">
    <img class="brand-logo" src="image/partners/MCISE-white-title.png" title="Gmail">
    <img class="brand-logo" src="image/partners/infobip-2.png" title="infobip">
    <img class="brand-logo" src="image/partners/logo-startup-maroc.png" title="mailchimp">
</div>
    </div>
    <br>
    <br>

    <div class="wd-80 uk-margin uk-margin-bottom uk-margin-large-top" uk-scrollspy="cls:uk-animation-fade; repeat: true">
        <div align="center">

            <h1 class="uk-article-title" dir="rtl">ماذا تنتظر ؟ انظم الى أكبر شبكة مقاوليين ذاتيين بالمغرب</h1>

            <div class="users-avatars">
                <div class="users-avatars-content uk-flex uk-flex-center">
                    <div class="user-avatar"><img src="image/users/1.jpg" alt="user avatar"></div>
                    <div class="user-avatar"><img src="image/users/2.jpg" alt="user avatar"></div>
                    <div class="user-avatar"><img src="image/users/3.jpg" alt="user avatar"></div>
                    <div class="user-avatar"><img src="image/users/4.jpg" alt="user avatar"></div>
                    <div class="user-avatar"><img src="image/users/unnamed.jpg" alt="user avatar"></div>
                    <div class="user-avatar"><img src="image/users/f212571c02b2944ec623228d0ef60abd.png" alt="user avatar">
                    </div>
                    <span class="plus-users-avatars">+99</span>
                </div>
                <div class="uk-margin">
                    <button class="uk-button uk-button-primary uk-button-small uk-width-1-5@s">جرب مجانا</button>
                </div>
            </div>
        </div>


    </div>

    <br>
    <br>

@endsection
