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
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZC8QSMPXQG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-ZC8QSMPXQG');

    </script>

</head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            <feedback></feedback>

            <div class="h-85"></div>
            <!-- Header Of Website -->
            <nav class="uk-navbar-container Blue-brand-ayol " id="navbar-desky" dir="rtl" uk-navbar>

                <div class="center-ayol">

                    <div class="uk-navbar-right">
                        <button uk-toggle="target: #offcanvas-slide" type="button" class="toggel-button"><span
                                uk-icon="icon: menu; ratio: 2"></span></button>

                        <div class="logo"><a href="{{ URL::asset('/u') }}"><img class="logo-ayol" title="Logo - Desky"
                                    src="{{ URL::asset('image/logo-beta.png') }}"></a></div>
                        <div class="uk-navbar-center">

                            <ul class="uk-navbar-nav">
                                <li> <a href="{{ URL::asset('/u') }}" class="uk-button-text"><i
                                            class="fas fa-tachometer-alt"></i> &nbsp; لوحة التحكم</a>
                                </li>
                                <li>
                                    <a href="{{ URL::asset('/clients/list') }}" class="uk-button-text"><i
                                            class="fas fa-users"></i> &nbsp; العملاء</a>
                                    <div uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000; pos: bottom-right"
                                        class="">


                                        <ul class="uk-nav uk-dropdown-nav">

                                            <li><a href="{{ URL::asset('/clients/list') }}"><i
                                                        class="fas fa-list"></i>
                                                    قائمة العملاء</a>
                                            </li>
                                            <li><a
                                                    href="{{ URL::asset('/creer/client') }}"><i
                                                        class="fas fa-plus"></i>
                                                    انشاء عميل</a></li>


                                        </ul>

                                    </div>
                                </li>
                                <li>
                                    <a href="{{ URL::asset('/devis/list') }}" class="uk-button-text"> <i
                                            class="fas fa-file-invoice-dollar"></i> &nbsp; عروض الاسعار</a>
                                    <div uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000; pos: bottom-right"
                                        class="">


                                        <ul class="uk-nav uk-dropdown-nav">

                                            <li><a href="{{ URL::asset('/creer/devis') }}"><i
                                                        class="fas fa-plus"></i>
                                                    انشاء عرض اسعار</a>
                                            </li>
                                            <li dir="rtl"><a href="{{ URL::asset('/devis/list') }}"><i
                                                        class="fas fa-list"></i>
                                                    قائمة عروض الاسعار</a></li>



                                        </ul>

                                    </div>
                                </li>
                                <li>
                                    <a href="{{ URL::asset('/facture/list') }}" class="uk-button-text"> <i
                                            class="fas fa-file-invoice"></i> &nbsp; الفواتير</a>
                                    <div uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000; pos: bottom-right"
                                        class="">


                                        <ul class="uk-nav uk-dropdown-nav">
                                            <li><a href="{{ URL::asset('/creer/facture') }}"><i
                                                        class="fas fa-plus"></i>
                                                    انشاء فاتورة</a>
                                            </li>
                                            <li dir="rtl"><a href="{{ URL::asset('/facture/list') }}"><i
                                                        class="fas fa-list"></i>
                                                    قائمة الفواتير</a></li>

                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="{{ URL::asset('/facture/list') }}" class="uk-button-text"><i class="far fa-chart-bar"></i> &nbsp; التحليلات والأدوات</a>
                                    <div uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000; pos: bottom-right"
                                        class="">
                                        <ul class="uk-nav uk-dropdown-nav">
                                            <li><a href="{{ URL::asset('/service/etude-de-project') }}"><span></span>
                                                 الاحصائيات و التقارير الربع سنوية</a>
                                        </li>
                                        <li dir="rtl"><a
                                                href="{{ URL::asset('/statistique/annee') }}"><span></span>
                                                الاحصائيات التقارير السنوية </a></li>
                                                <li dir="rtl"><a
                                                    href="{{ URL::asset('/service/je-veux-devenir-auto-entrepreneur') }}"><span></span>
                                                    المحاسبة والضرائب </a></li>
    
    

                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="{{ URL::asset('/ae-network') }}" class="uk-button-text"><i class="fas fa-globe"></i> &nbsp; شبكة المقاول</a>
                            
                                </li>
                            </ul>


                            </ul>


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
                                <li><a href="{{ asset('u/services') }}"><span uk-icon="list"></span> خدماتي</a></li>
                                <li><a href="{{ asset('u/products') }}"><span uk-icon="grid"></span> منتجاتي</a></li>
                                <li><a href="{{ asset('u/history') }}"><span uk-icon="history"></span> سجل المدفوعات</a>
                                </li>
                                <li><a href="{{ asset('u/setting') }}"><span uk-icon="cog"></span> الاعدادات </a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                              document.getElementById('logout-form').submit();">
                                        <span uk-icon="sign-out"></span> {{ __('تسجيل الخروج') }}
                                    </a></li>
                            </ul>
                        </div>
                        <user-notification></user-notification>
                        <button style="    padding: 10px;" dir="rtl" class="  uk-float-left  user-menu-bar"
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
                        </form>

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
                            <div class="mobile-nav-logo">
                                <img src="{{asset('image/desky-white-logo.png')}}" alt="desky.ma - white logo">
                            </div>
                            <hr class="uk-divider-icon">

                            <h4></h4>
                            <ul class="uk-list uk-list-large">
                                <li> <a href="{{ URL::asset('/u') }}" class="uk-link"><i
                                    class="fas fa-tachometer-alt"></i> &nbsp; لوحة التحكم</a>
                                </li>
                                <li>
                                    <a href="{{ URL::asset('/clients/list') }}" ><i
                                            class="fas fa-users"></i> &nbsp; العملاء</a>
                                    <div uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000; pos: bottom-right"
                                        class="">


                                        <ul class="uk-nav uk-dropdown-nav">

                                            <li><a href="{{ URL::asset('/clients/list') }}"><i
                                                        class="fas fa-list"></i>
                                                    قائمة العملاء</a>
                                            </li>
                                            <li><a
                                                    href="{{ URL::asset('/creer/client') }}"><i
                                                        class="fas fa-plus"></i>
                                                    انشاء عميل</a></li>


                                        </ul>

                                    </div>
                                </li>
                                <li>
                                    <a href="{{ URL::asset('/devis/list') }}" > <i
                                            class="fas fa-file-invoice-dollar"></i> &nbsp; عروض الاسعار</a>
                                    <div uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000; pos: bottom-right"
                                        class="">


                                        <ul class="uk-nav uk-dropdown-nav">

                                            <li><a href="{{ URL::asset('/creer/devis') }}"><i
                                                        class="fas fa-plus"></i>
                                                    انشاء عرض اسعار</a>
                                            </li>
                                            <li dir="rtl"><a href="{{ URL::asset('/devis/list') }}"><i
                                                        class="fas fa-list"></i>
                                                    قائمة عروض الاسعار</a></li>



                                        </ul>

                                    </div>
                                </li>
                                <li>
                                    <a href="{{ URL::asset('/facture/list') }}" > <i
                                            class="fas fa-file-invoice"></i> &nbsp; الفواتير</a>
                                    <div uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000; pos: bottom-right"
                                        class="">


                                        <ul class="uk-nav uk-dropdown-nav">
                                            <li><a href="{{ URL::asset('/creer/facture') }}"><i
                                                        class="fas fa-plus"></i>
                                                    انشاء فاتورة</a>
                                            </li>
                                            <li dir="rtl"><a href="{{ URL::asset('/facture/list') }}"><i
                                                        class="fas fa-list"></i>
                                                    قائمة الفواتير</a></li>

                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="" ><i class="far fa-chart-bar"></i> &nbsp; التحليلات والأدوات</a>
                                    <div uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000; pos: bottom-right"
                                        class="">
                                        <ul class="uk-nav uk-dropdown-nav">
                                            <li><a href="{{ URL::asset('/statistique/anne') }}"><span></span>
                                                الاحصائيات والتقارير السنوية</a>
                                        </li>
                                        <li><a href="{{ URL::asset('/service/etude-de-project') }}"><span></span>
                                            الاحصائيات والتقارير الربع سنوية</a>
                                    </li>
                                        <li dir="rtl"><a
                                                href="{{ URL::asset('/service/je-veux-devenir-auto-entrepreneur') }}"><span></span>
                                                المحاسبة</a></li>

                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="{{ URL::asset('/ae-network') }}" ><i
                                        class="fas fa-cog"></i> &nbsp; شبكة المقاول</a>
                     
                                </li>
                                <br>
                                <hr class="uk-divider-icon">

                                <div id="copyright">
                                    <div class="container" style="width: auto !important;">
                                        <!-- Copyright Text Start -->
                                        <small dir="rtl">

                                            Desky.ma منتج تابع لشركة NERYOU جميع الحقوق محفوظة © {{ now()->year }}
                                            <br>

                                            <small>v {{ env('APP_VERSION') }} ({{ env('APP_RELEASE_YEAR') }}) @if (env('APP_BETA') == true) BETA @endif</small>
                                        </small>

                                    </div>
                                </div>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-window"></div>

            <!--div class="cokies-section" id="cokiessection">
    <p>We use cookies to ensure you get the best experience on our site. If you continue to use it, we will consider
        that you accept the use of cookies. <button onclick="closecokie()" type="button">I agree</button></p>
</div-->
            <!-- End Header Of Website -->
            @auth
                @if (Auth::user()->email_verified_at == null)
                    <div class="alert-f-w danger">
                        <p dir="rtl"><span uk-icon="icon: warning"></span> لقد أرسلنا لك رسالة التفعيل الى بريدك الالكتروني
                            يرجى التحقق من بريدك </p>
                    </div>
                @endif
                @php

                    $c_products = DB::table('subscriptions')
                        ->where('email', Auth::user()->email)
                        ->get();
                    $c_products = $c_products->count();
                @endphp
                @if ($c_products < 1)
                    <div class="alert-f-w warning">
                        <p dir="rtl"><span uk-icon="icon: warning"></span> لقد نفد رصيدك يرجى <a href="#">تجديد اشتراكك</a>
                        </p>
                    </div>
                @endif
            @endauth



            @yield('content')
        </div>
    </div>
    <footer dir="rtl" style="width: 100%;
    background-color: #ffffff;
    padding-top: 55px;
    padding-bottom: 0;">




        <div id="copyright">
            <div class="container" style="width: auto !important;">
                <!-- Copyright Text Start -->
                <p dir="rtl">

                    Desky.ma منتج تابع لشركة NERYOU جميع الحقوق محفوظة © {{ now()->year }}
                    <br>
                    <small><i class="fas fa-lock"></i> يتم تشفير جميع البيانات الحساسة </small>
                    <br>
                    <small>v {{ env('APP_VERSION') }} ({{ env('APP_RELEASE_YEAR') }}) @if (env('APP_BETA') == true) BETA @endif</small>
                </p>

            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    <script src="{{ URL::asset('uikit/dist/js/uikit-icons.min.js') }}"></script>

    <script src="{{ URL::asset('js/main-js.js') }}"></script>

</body>

</html>
