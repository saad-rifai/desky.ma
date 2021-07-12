<!DOCTYPE html>
<html lang="ar">

<head>
    <link rel="icon" href="{{ asset('image/desky/favicon.jpg') }}" type="image/jpg" sizes="17x17">
    <!-- Facebook Pixel Code -->

    <noscript>
        <meta http-equiv="refresh" content="0;url=noscript.html">
    </noscript>

    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=162243945814000&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->

    <!-- End Facebook Pixel Code -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="تقدم لك منصة desky.ma نظام احترافي لادارة نشاط المقاول الذاتي يمكن من خلاله ادارة كافة جوانب عملك تمكنك المنصة من انشاء وادارة الفواتير وعروض أسعار (devis) احترافية ببساطة وسهولة بهويتك البصرية كما تمكنك المنصة من ادارة وتسيير عملائك وانجاز تقارير وتحليلات شهرية وسنوية وتمكنك من حساب وتوقع الضرائب الخاصة بك .">
    <meta name="keywords"
        content="desky.ma, منصة ديسكي, منصة desky, فاتورة المقاول الذاتي, دوفي المقاول الذاتي, نظام ادارة المقاول الذاتي, منصة ادارة فواتير المقاول الداتي, دوفي المقاول الذاتي, المقاول الذاتي بالمغرب, facture, devis, Autoentrepreneur devis, Autoentrepreneur facture, Auto Entrepreneur, اتحاد المقاوليين الذاتيين بالمغرب, المقاول الذاتي بالمغرب, نظام المقاول الذاتي,E-commerce Autoentrepreneur, Management, عمل المقاول الذاتي, بطاقة المقاول الذاتي, المقاول الذاتي مشروع ناجح, نجاح مقاول ذاتي, قصة نجاح مقاول ذاتي">
    <meta name="author" content="Saad Rifai">
    <!-- SEO -->
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ URL::current() }}">
    <meta name="twitter:title" content="desky - @yield('title')">
    <meta name="twitter:description"
        content="تقدم لك منصة desky.ma نظام احترافي لادارة نشاط المقاول الذاتي يمكن من خلاله ادارة كافة جوانب عملك تمكنك المنصة من انشاء وادارة الفواتير وعروض أسعار (devis) احترافية ببساطة وسهولة بهويتك البصرية كما تمكنك المنصة من ادارة وتسيير عملائك وانجاز تقارير وتحليلات شهرية وسنوية وتمكنك من حساب وتوقع الضرائب الخاصة بك .">
    <!-- Twitter Summary card images must be at least 120x120px -->
    <meta name="twitter:image" content="/image/desky/brand-cover.jpg">
    <!-- Open Graph data -->
    <meta property="og:title" content="desky - @yield('title')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ URL::asset('') }}" />
    <meta property="og:image" content="/image/desky/brand-cover.jpg" />
    <meta property="og:description"
        content="تقدم لك منصة desky.ma نظام احترافي لادارة نشاط المقاول الذاتي يمكن من خلاله ادارة كافة جوانب عملك تمكنك المنصة من انشاء وادارة الفواتير وعروض أسعار (devis) احترافية ببساطة وسهولة بهويتك البصرية كما تمكنك المنصة من ادارة وتسيير عملائك وانجاز تقارير وتحليلات شهرية وسنوية وتمكنك من حساب وتوقع الضرائب الخاصة بك ." />
    <meta property="og:site_name" content="desky.ma" />
    <title>Desky - @yield('title')</title>
    <link href="{{ URL::asset('uikit/dist/css/uikit-rtl.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/main-style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/desky-style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/mobile-style.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('uikit/dist/js/uikit.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js">
    </script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer>
    </script>
    <!-- Font Awesome Pro CSS -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-xVVam1KS4+Qt2OrFa+VdRUoXygyKIuNWUUUBZYv+n27STsJ7oDOHJgfF0bNKLMJF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

@php
$datajson = file_get_contents('database/data.json');
$jsondata = json_decode($datajson, true);
@endphp
<div id="form-loading" class="form-loading">
    <span class="uk-position-center" uk-spinner="ratio: 3"></span>
</div>

<body id="body">
    <div id="app">
        <div>
            <div class="h-75"></div>

            <!-- Header Of Website -->

            <nav class="desky-primary-navbar" uk-navba>
                <div class="navbar-content">
                    <div class="desky-navbar-logo"> <a href="http://{{ env('APP_URL') . '/' }}"><img
                                src="/image/logo-desky.png" alt="desky.ma logo register"></a></div>
                    <div class="nav-items-class">

                        <ul class="uk-navbar-nav desky-links-nav" dir="rtl">
                            <li class="uk-active"><a href="#" class="line-hover">المميزات</a></li>
                            <li class="uk-active"><a href="#" class="line-hover">الأسعار</a></li>
                            <li>
                                <a href="#" class="uk-dropdown-link">شبكة المقاولين الذاتيين</a>
                                <div class="uk-navbar-dropdown" uk-dropdown="mode: hover">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li><a href="#">تصفح الصفقات</a></li>
                                        <li><a href="#">تصفح المقاوليين الذاتيين</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#" class="uk-dropdown-link">الموارد</a>
                                <div class="uk-navbar-dropdown" uk-dropdown="mode: hover;pos: bottom-left">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li><a href="#">المدونة</a></li>
                                        <li><a href="#">مركز المساعدة</a></li>
                                        <li><a href="#">التواصل مع المبيعات</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-call-to-act@desky">
                                <button class="uk-button uk-button-default">الدخول</button>
                                <button class="uk-button uk-button-primary">جرب مجاناَ</button>

                            </li>


                        </ul>
                        <ul class="uk-navbar-nav" dir="rtl" hidden>

                            <li class="nav-auth-tool@desky">
                                <ul class="uk-navbar-nav" dir="rtl">
                                    <li>
                                        <span class="nav-not-badge">2</span>
                                        <a href="javascript:void(0)"><span class="icon-link-nav">
                                                <i class="fas fa-envelope"></i>
                                            </span></a>
                                        <div class="uk-navbar-dropdown nav-drop "
                                            uk-dropdown="mode: click; boundary: .navbar-content; pos: bottom-left;   boundary-align: true">
                                            <h1 class="title-dropmenu">الرسائل</h1>
                                            <div class="bell-content">
                                                <div class="notification-section">
                                                    <div class="notification-content ">
                                                        <div class="notification-avatar"><img
                                                                src="/image/users/f212571c02b2944ec623228d0ef60abd.png"
                                                                alt=""></div>
                                                        <div class="notification-text">
                                                            <div class="notification-title message-text">
                                                                <h1>
                                                                    <span class="message-user-name"><span
                                                                            class="verify-badge"
                                                                            uk-tooltip="title: لقد تم اثبات ملكية الحساب"></span>
                                                                        Salma Rebah </span>
                                                                    <br>
                                                                    تقدم لك منصة desky.ma نظام احترافي لادارة نشاط
                                                                    المقاول الذاتي يمكن من خلاله ادارة كافة جوانب عملك
                                                                    تمكنك المنصة من انشاء وادارة الفواتير وعروض أسعار
                                                                    (devis) احترافية ببساطة وسهولة بهويتك البصرية كما
                                                                    تمكنك المنصة من ادارة وتسيير عملائك وانجاز تقارير
                                                                    وتحليلات شهرية وسنوية وتمكنك من حساب وتوقع الضرائب
                                                                    الخاصة بك .
                                                                </h1>
                                                            </div>
                                                            <div class="not-time"><span><i class="far fa-clock"></i> قبل
                                                                    10 دقائق </span></div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="notification-content ">
                                                        <span class="not-read-not"></span>
                                                        <div class="notification-avatar"><img
                                                                src="/image/users/f212571c02b2944ec623228d0ef60abd.png"
                                                                alt=""></div>
                                                        <div class="notification-text">
                                                            <div class="notification-title message-text">
                                                                <h1>
                                                                    <span class="message-user-name"><span
                                                                            class="verify-badge"
                                                                            uk-tooltip="title: لقد تم اثبات ملكية الحساب"></span>
                                                                        Salma Rebah </span>
                                                                    <br>
                                                                    5oya ana brit devis bax nedfa3 n intilaka 3ad nxrih
                                                                    nxa2alah ila5roj credit
                                                                </h1>
                                                            </div>
                                                            <div class="not-time"><span><i class="far fa-clock"></i> قبل
                                                                    10 دقائق </span></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="footer-dropdown-not uk-margin uk-text-center">
                                                <button class="uk-button uk-button-primary uk-button-small">جميع
                                                    الرسائل</button>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="nav-not-badge">10</span>
                                        <a href="javascript:void(0)"><span class="icon-link-nav">
                                                <i class="fas fa-bell"></i>
                                            </span></a>
                                        <div class="uk-navbar-dropdown nav-drop bell-drop"
                                            uk-dropdown="mode: click; boundary: .navbar-content; pos: bottom-left;   boundary-align: true">
                                            <h1 class="title-dropmenu">الاشعارات</h1>
                                            <div class="bell-content">
                                                <div class="notification-section">
                                                    <div class="notification-content ">
                                                        <div class="notification-avatar"><img
                                                                src="/image/users/f212571c02b2944ec623228d0ef60abd.png"
                                                                alt=""></div>
                                                        <div class="notification-text">
                                                            <div class="notification-title">
                                                                <h1>لقد تم ايقاف حسابك بسبب انتهاك سياساتنا يرجى التواصل
                                                                    مع الدعم</h1>
                                                            </div>
                                                            <div class="not-time"><span><i class="far fa-clock"></i> قبل
                                                                    10 دقائق </span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="margin:0">
                                                <div class="notification-section not-not-read">
                                                    <div class="notification-content ">
                                                        <div class="notification-avatar"><img
                                                                src="/image/users/f212571c02b2944ec623228d0ef60abd.png"
                                                                alt=""></div>
                                                        <div class="notification-text">
                                                            <div class="notification-title">
                                                                <h1>تم قبول مشروعك، وأصبح جاهزا لتلقي العروض كتابة مقال
                                                                    تعريفي بمنصة رقمية لادارة الأنشطة التجارية</h1>
                                                            </div>
                                                            <div class="not-time"><span><i class="far fa-clock"></i> قبل
                                                                    10 دقائق </span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="margin:0">
                                                <div class="notification-section">
                                                    <div class="notification-content ">
                                                        <div class="notification-avatar"><img
                                                                src="/image/users/support@desky.png" alt=""></div>
                                                        <div class="notification-text">
                                                            <div class="notification-title">
                                                                <h1>لقد تم ايقاف حسابك بسبب انتهاك سياساتنا يرجى التواصل
                                                                    مع الدعم</h1>
                                                            </div>
                                                            <div class="not-time"><span><i class="far fa-clock"></i> قبل
                                                                    10 دقائق </span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="margin:0">
                                                <div class="notification-section">
                                                    <div class="notification-content ">
                                                        <div class="notification-avatar"><img
                                                                src="/image/users/f212571c02b2944ec623228d0ef60abd.png"
                                                                alt=""></div>
                                                        <div class="notification-text">
                                                            <div class="notification-title">
                                                                <h1>لقد تم ايقاف حسابك بسبب انتهاك سياساتنا يرجى التواصل
                                                                    مع الدعم</h1>
                                                            </div>
                                                            <div class="not-time"><span><i class="far fa-clock"></i> قبل
                                                                    10 دقائق </span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="footer-dropdown-not uk-margin uk-text-center">
                                                <button class="uk-button uk-button-primary uk-button-small">جميع
                                                    الاشعارات</button>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><span class="avatar-user">
                                                <img src="/image/users/f212571c02b2944ec623228d0ef60abd.png"
                                                    alt="saad rifai">
                                            </span></a>
                                        <div class="uk-navbar-dropdown" dir="rtl" uk-dropdown="mode: click">
                                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                                <li><a href="#"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a>
                                                </li>
                                                <li><a href="#"><i class="far fa-user-circle"></i> حسابي </a></li>
                                                <li><a href="#"><i class="fas fa-credit-card"></i> الاشتراكات والدفع</a>
                                                </li>
                                                <li><a href="#"><i class="fas fa-cog"></i> الاعدادات</a></li>
                                                <hr style="margin: 0">
                                                <li><a href="#"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
                                                </li>
                                            </ul>

                                        </div>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                        <span class="toggel-menu" type="button"
                            uk-toggle="target: #mobile-nav; animation: uk-animation-fade"> <i
                                class="fal fa-bars"></i></span>
                    </div>


                </div>
                <div id="mobile-nav" class="mobile-nav" hidden>
                    <div class="mobile-nav-content">
                        <div class="uk-width-1-1@s uk-width-2-4@m" dir="rtl">
                            <ul class="uk-nav-default uk-nav-parent-icon mb-nav-ul" uk-nav="multiple: true">
                                <li><a href="#">المميزات</a></li>
                                <li class="uk-parent">
                                    <a href="#">شبكة المقاولين الذاتيين</a>
                                    <ul class="uk-nav-sub">
                                        <li><a href="#">تصفح الصفقات</a></li>
                                        <li><a href="#">تصفح المقاوليين الذاتيين</a></li>

                                    </ul>
                                </li>
                                <li class="uk-parent">
                                    <a href="#">الأسعار</a>
                                    <ul class="uk-nav-sub">
                                        <li><a href="#">Sub item</a></li>
                                        <li><a href="#">Sub item</a></li>
                                    </ul>
                                </li>
                                <li class="nav-call-to-act@desky">
                                    <button class="uk-button uk-button-primary mb-wd-100 uk-width-1-1">جرب
                                        مجاناَ</button>

                                    <button class="uk-button uk-button-default mb-wd-100 uk-width-1-1">الدخول</button>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            @yield('content')
        </div>
    </div>
    <footer dir="rtl">
        <div class="wd-80">
            <div class="footer-badge"> <img src="image/partners/sectigo_trust_seal_lg_2x.png" alt="sectigo_trust"></div>
            <div class="uk-grid-large uk-margin-large-bottom" uk-grid>
                <div class="uk-width-1-4@s">

                    <ul class="uk-list">
                        <h4><span uk-icon="icon: chevron-left"></span> منصة Desky </h4>
                        <li><a href="{{ URL::asset('/À-propos-du-service') }}" class="uk-button-text"> <span
                                    uk-icon="icon: link"></span> نبذة عن المنصة </a> </li>
                        <li><a href="{{ URL::asset('/q&a') }}" class="uk-button-text"> <span
                                    uk-icon="icon: link"></span> الاسئلة الشائعة</a></li>
                        <li><a href="{{ URL::asset('/tarifs') }}" class="uk-button-text"> <span
                                    uk-icon="icon: link"></span> الأسعار</a></li>
                        <li><a href="{{ URL::asset('/a-propos-de-nous') }}" class="uk-button-text"> <span
                                    uk-icon="icon: link"></span> قائمة المقاولين</a></li>

                        <li><a href="{{ URL::asset('/politique-de-confidentialite') }}"> <span
                                    uk-icon="icon: link"></span> قائمة الصفقات</a></li>
                        <li><a href="{{ URL::asset('/politique-de-confidentialite') }}"> <span
                                    uk-icon="icon: link"></span> بيان الخصوصية</a></li>
                        <li><a href="{{ URL::asset('/politique-de-confidentialite') }}"> <span
                                    uk-icon="icon: link"></span> شروط الاستخدام</a></li>
                        <li><a href="{{ URL::asset('/politique-de-confidentialite') }}"> <span
                                    uk-icon="icon: link"></span> قسم التبليغ</a></li>

                    </ul>
                </div>
                <div class="uk-width-1-4@s">
                    <ul class="uk-list">
                        <h4><span uk-icon="icon: chevron-left"></span> الشركة </h4>
                        <li><a href="{{ URL::asset('/À-propos-du-service') }}" class="uk-button-text"> <span
                                    uk-icon="icon: link"></span> عن الشركة </a> </li>
                        <li><a href="{{ URL::asset('/q&a') }}" class="uk-button-text"> <span
                                    uk-icon="icon: link"></span> الوظائف</a></li>
                        <li><a href="{{ URL::asset('/tarifs') }}" class="uk-button-text"> <span
                                    uk-icon="icon: link"></span> المدونة</a></li>
                        <li><a href="{{ URL::asset('/a-propos-de-nous') }}" class="uk-button-text"> <span
                                    uk-icon="icon: link"></span> تواصل معنا</a></li>

                    </ul>
                </div>
                <div class="uk-width-1-4@s">
                    <ul class="uk-list">
                        <h4><span uk-icon="icon: chevron-left"></span> موارد</h4>
                        <li><a href="{{ URL::asset('/À-propos-du-service') }}" class="uk-button-text"> <span
                                    uk-icon="icon: link"></span> المدونة</a> </li>
                        <li><a href="{{ URL::asset('/q&a') }}" class="uk-button-text"> <span
                                    uk-icon="icon: link"></span> مركز المساعدة</a></li>
                        <li><a href="{{ URL::asset('/tarifs') }}" class="uk-button-text"> <span
                                    uk-icon="icon: link"></span> خدمة العملاء</a></li>
                        <li><a href="{{ URL::asset('/a-propos-de-nous') }}" class="uk-button-text"> <span
                                    uk-icon="icon: link"></span>تواصل معنا</a></li>

                    </ul>
                </div>
                <div class="uk-width-1-4@s">
                    <ul class="uk-list uk-width-1-1">


                        <h4><span uk-icon="icon: chevron-left"></span> تابعنا على</h4>
                        <li>
                            <div class="socialmedia-container">
                                <a href="{{ $jsondata['socialmedia']['twitter'] }}" class="uk-icon-button"
                                    uk-icon="twitter"></a>
                                <a href="{{ $jsondata['socialmedia']['facebook'] }}"
                                    class="uk-icon-button  uk-margin-small-right" uk-icon="facebook"></a>
                                <a href="{{ $jsondata['socialmedia']['instagram'] }}"
                                    class="uk-icon-button uk-margin-small-right" uk-icon="instagram"></a>
                                <a href="{{ $jsondata['socialmedia']['youtube'] }}"
                                    class="uk-icon-button uk-margin-small-right" uk-icon="youtube"></a>

                            </div>
                        </li>


                        <h4><span uk-icon="icon: chevron-left"></span> طرق الدفع المتاحة</h4>

                        <li class="uk-flex" uk-flex>
                            <img class="logo-pay-footer"
                                src="{{ URL::asset('image/icon/payments-methods/visa-color.svg') }}" alt="VISA"
                                uk-tooltip="title: الدفع بالفيزا">
                            <img class="logo-pay-footer"
                                src="{{ URL::asset('image/icon/payments-methods/mastercard-color.svg') }}"
                                alt="mastercard" uk-tooltip="title: الدفع بماستر كارد">
                            <img class="logo-pay-footer"
                                src="{{ URL::asset('image/icon/payments-methods/cash-dollar-color.svg') }}"
                                alt="cash" uk-tooltip="title: الدفع نقدا">
                            <img class="logo-pay-footer"
                                src="{{ URL::asset('image/icon/payments-methods/discover-color.svg') }}"
                                alt="discover" uk-tooltip="title: الدفع بديسكوفر">
                        </li>
                    </ul>
                </div>
            </div>
            <hr style="border-top: 0.5px solid #d8d8d8 ">
            <div id="copyright">
                <div class="container" style="width: auto !important;">
                    <!-- Copyright Text Start -->
                    <p style="color: #3a3a3a" dir="rtl">

                        Desky.ma منتج تابع لشركة NERYOU S.A.R.L جميع الحقوق محفوظة © {{ now()->year }}

                    </p>
                    <!-- Copyright Text End -->
                    <p style="color: 3a3a3a">

                        v {{ env('APP_VERSION') }} ({{ env('APP_RELEASE_YEAR') }}) @if (env('APP_BETA') == true) BETA @endif


                    </p>
                </div>
            </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    <script src="{{ URL::asset('uikit/dist/js/uikit-icons.min.js') }}"></script>

    <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>
    <script src="{{ URL::asset('js/main-js.js') }}"></script>

</body>

</html>
