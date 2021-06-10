<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" href="{{ asset('image/desky/favicon.jpg') }}" type="image/jpg" sizes="17x17">
    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '742002670009558');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=742002670009558&ev=PageView&noscript=1" /></noscript>
            <noscript>
                <meta http-equiv="refresh" content="0;url=noscript.html">
              </noscript>


    <!-- End Facebook Pixel Code -->
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="Business plan,
    دراسة الجدوى ,
   برنامج انطلاقة ,
   الدعم الملكي ,
   برنامج تمويل مقاولة ,
    Etude de marche ,
   Etude de faisabilite,
     تمويل بنكي ,
   تمويل بدون فائدة ,
    انشاء مواقع انترنت ,
   التسويق ,
   براندينغ ,
   مقاول ذاتي ,
   مشروع ناجح,
   بطاقة مقاول ذاتي,
   Creation d entreprise au maroc,
   نشاء شركة بالمغرب,
   شركة بالمغرب,
   التسويق  والبراندينغ,
   Autoentrepreuneur facture,
   Autoentrepreuneur devis,
   Moqawala,
   Moqawala.ma,
   AyolSoft,
   Creation siteweb,
   مقاولة,
   منصة مقاولة,
   تصميم موقع الكتروني,
   البيع عبر الانترنت,
   محاكي قرض انطلاقة,
   قرض انطلاقة,
   الاستشارة في برنامج انطلاقة,
   موقع مقاولة,
   منصة moqawala
   ">
    <meta name="author" content="Saad Rifai">
    <!-- SEO -->
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ URL::current() }}">
    <meta name="twitter:title" content="Moqawala - @yield('title')">
    <meta name="twitter:description" content="@yield('description')">
    <!-- Twitter Summary card images must be at least 120x120px -->
    <meta name="twitter:image" content="@yield('ogimage')">
    <!-- Open Graph data -->
    <meta property="og:title" content="Moqawala - @yield('title')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ URL::asset('') }}" />
    <meta property="og:image" content="@yield('ogimage')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:site_name" content="Moqawala.ma" />
    <title>Desky - @yield('title')</title>
    <link href="{{ URL::asset('uikit/dist/css/uikit-rtl.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/main-style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/desky-style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/mobile-style.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('uikit/dist/js/uikit.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-3.4.1.min.js') }}"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href='https://fonts.googleapis.com/css?family=Tajawal' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer>
    </script>
    <!-- Font Awesome Pro CSS -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-xVVam1KS4+Qt2OrFa+VdRUoXygyKIuNWUUUBZYv+n27STsJ7oDOHJgfF0bNKLMJF" crossorigin="anonymous">


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
            <nav class="uk-navbar-container Blue-brand-ayol " id="navbar-desky" dir="rtl" uk-navbar>

                <div class="center-ayol">

                    <div class="uk-navbar-right">
                        <button style="display: none" uk-toggle="target: #offcanvas-slide" type="button"
                            class="toggel-button"><span uk-icon="icon: menu; ratio: 2"></span></button>
                        <div class="logo"><a href="{{ URL::asset('') }}"><img class="logo-ayol" title="Logo - Desky"
                                    src="{{ URL::asset('image/logo-beta.png') }}"></a></div>
                        <div class="uk-navbar-center">

                            <ul class="uk-navbar-nav">
                                <li><a href="{{ URL::asset('/#aboutus') }}" class="uk-button-text">عن الخدمة </a>
                                </li>
                                <li><a href="{{ URL::asset('/#whyus') }}" class="uk-button-text">المميزات</a></li>
                                <li><a href="{{ URL::asset('/q&a') }}" class="uk-button-text">الاسئلة الشائعة</a></li>
                                <li><a href="{{ URL::asset('/tarifs') }}" class="uk-button-text"> الأسعار</a></li>
                                <li><a href="{{ URL::asset('/a-propos-de-nous') }}" class="uk-button-text"> من نحن</a></li>
                                <li><a href="{{ URL::asset('/Contactez-nous') }}" class="uk-button-text"> تواصل معنا</a></li>
                                <!--li><a href="{{ URL::asset('/#q&a') }}" class="uk-button-text"> شبكة المقاولين
                                        الذاتيين</a></li>
                                <li--><!--a class="uk-button-text" href="{{ URL::asset('/contactus') }}">تواصل معنا</a>
                                </li-->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="right-nav">
                    @guest
                        <a href="{{ URL::asset('register') }}?ref={{ url()->current() }}"><button
                                class="uk-button uk-button-primary btn-radio">سجل الأن</button></a>
                        <a href="{{ URL::asset('login') }}?ref={{ url()->current() }}" class="uk-button">الدخول</a>

                    @else

                        <button style="    padding: 10px;" dir="rtl" class="  uk-float-left  user-menu-bar"
                            type="button"> <span class="bell-icon"><i class="fas fa-user"></i></span> </button>
                        <div uk-dropdown="boundary: .boundary">
                            <ul dir="rtl" class="uk-nav uk-dropdown-nav uk-text-right">
                                <li><a href="{{ asset('u/account') }}"><span uk-icon="user"></span> حسابي </a></li>
                                <li><a href="{{ asset('u/payments/history') }}"><span uk-icon="history"></span> سجل المدفوعات</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                              document.getElementById('logout-form').submit();">
                                        <span uk-icon="sign-out"></span> {{ __('تسجيل الخروج') }}
                                    </a></li>
                            </ul>
                        </div>
                        <user-notification></user-notification>
                        <!--button style="    padding: 10px;" dir="rtl" class="  uk-float-left  user-menu-bar"
                            type="button"> <span class="bell-icon"><i class="fas fa-envelope"></i></span> </button>
                        <div uk-dropdown="boundary: .boundary">
                            <ul dir="rtl" class="uk-nav uk-dropdown-nav uk-text-right">
                                <li><a href="{{ asset('u/account?ref=nav_bar') }}"><span uk-icon="user"></span> حسابي
                                    </a>
                                </li>
                                <li><a href="{{ asset('u?ref=nav_bar') }}"><span uk-icon="home"></span> لوحة التحكم</a>
                                </li>
                                <li><a href="{{ asset('u/setting') }}"><span uk-icon="cog"></span> الاعدادت</a></li>

                            </ul>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form-->

                    @endguest


                </div>
            </nav>
            <!-- Mobile Nav -->
            <div id="offcanvas-slide" uk-offcanvas="overlay: true">
                <div class="uk-offcanvas-bar">
                    <button class="uk-offcanvas-close" type="button" uk-close></button>
                    <br>
                    <div class="uk-child-width-expand@s" uk-grid dir="rtl">
                        <div>
                            <h4></h4>
                            <ul class="uk-list uk-list-large">
                                <li><a href="{{ URL::asset('/#aboutus') }}" class="uk-button-text">عن الخدمة </a>
                                </li>
                                <li><a href="{{ URL::asset('/#whyus') }}" class="uk-button-text">المميزات</a></li>
                                <li><a href="{{ URL::asset('/#videos') }}" class="uk-button-text">لماذا نحن</a></li>
                                <li><a href="{{ URL::asset('/tarifs') }}" class="uk-button-text"> الأسعار</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-window"></div>
            @yield('content')
        </div>
    </div>
    <footer dir="rtl">
        <div class="wd-80">
            <div class="uk-grid-large" uk-grid>
                <div class="uk-width-1-2@s">

                <ul class="uk-list">
                    <h4><span uk-icon="icon: chevron-left"></span> منصة Desky </h4>
                    <li><a href="{{ URL::asset('/contactus') }}"><span uk-icon="icon: link"></span> عن الخدمة </a>
                    </li>
                    <li><a href="{{ URL::asset('/contactus') }}"><span uk-icon="icon: link"></span> الأسعار</a></li>
                    <li><a href="{{ URL::asset('/contactus') }}"><span uk-icon="icon: link"></span> شبكة المقاولين
                            الذاتيين بالمغرب</a></li>
                    <li><a href="{{ URL::asset('/contactus') }}"><span uk-icon="icon: link"></span> تواصل معنا</a>
                    </li>
                    <li><a href="{{ URL::asset('/contactus') }}"><span uk-icon="icon: link"></span> شروط
                            الاستخدام</a></li>
                    <li><a href="{{ URL::asset('/contactus') }}"> <span uk-icon="icon: link"></span> بيان
                            الخصوصية</a></li>
                    <li>
                        <h4>عن منصة Desky.ma </h4>
                        <p class="des-footer" style="color:white">
                            تقدم لك منصة desky.ma نظام احترافي لادارة نشاط المقاول الذاتي يمكن من خلاله ادارة كافة جوانب عملك تمكنك المنصة من انشاء وادارة الفواتير وعروض أسعار (devis) احترافية ببساطة وسهولة بهويتك البصرية كما تمكنك المنصة من ادارة وتسيير عملائك وانجاز تقارير وتحليلات شهرية وسنوية وتمكنك من حساب وتوقع الضرائب الخاصة بك .

                        </p>
                    </li>
                </ul>
                </div>
                <div class="uk-width-1-2@s">
                <ul class="uk-list uk-width-1-1">
                    <h4><span uk-icon="icon: chevron-left"></span> روابط مفيدة</h4>
                    <li><a href="{{ URL::asset('/service/etude-de-project') }}"><span uk-icon="icon: link"></span>
                            مكتبة المعرفة</a>
                    </li>
                    <li><a href="{{ URL::asset('/service/je-veux-devenir-auto-entrepreneur') }}"><span
                                uk-icon="icon: link"></span>
                            تواصل معنا</a></li>
                    <li><a href="{{ URL::asset('/service/consultation') }}"><span uk-icon="icon: link"></span>
                            المدونة</a></li>

                    <h4><span uk-icon="icon: chevron-left"></span> طرق الدفع</h4>

                    <li>
                        <img class="logo-pay-footer" src="{{ URL::asset('image/icon/logo-wafacash.jpg') }}"
                            alt="wafacach - desky.ma">
                        <!--img class="logo-pay-footer" src="{{ URL::asset('image/icon/visa-mastercard.png') }}"
                            alt="visa master card - desky.ma">
                            <img class="logo-pay-footer" src="{{ URL::asset('image/icon/cmi-logo.png') }}"
                            alt="CMI - desky.ma"-->
                    </li>

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
                </ul>
                </div>
            </div>
            <hr style="border-top: 0.5px solid #d97900; ">
            <div id="copyright">
                <div class="container" style="width: auto !important;">
                    <!-- Copyright Text Start -->
                    <p style="color: white" dir="rtl">

                        Desky.ma منتج تابع لشركة NERYOU S.A.R.L جميع الحقوق محفوظة © {{ now()->year }}

                    </p>
                    <!-- Copyright Text End -->
                    <p style="color: white">

                        @php

                        @endphp
                    </p>
                </div>
            </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    <script src="{{ URL::asset('uikit/dist/js/uikit-icons.min.js') }}"></script>

    <script src="{{ URL::asset('js/main-js.js') }}"></script>

</body>

</html>
