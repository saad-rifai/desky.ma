<!DOCTYPE html>
<html lang="ar">

<head>
    <link rel="icon" href="{{ asset('image/desky/favicon.jpg') }}" type="image/jpg" sizes="17x17">
    <!-- Facebook Pixel Code -->

    <noscript>
        <meta http-equiv="refresh" content="0;url=noscript.html">
    </noscript>


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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href='https://fonts.googleapis.com/css?family=Tajawal' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer>
    </script>
    <!-- Font Awesome Pro CSS -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-xVVam1KS4+Qt2OrFa+VdRUoXygyKIuNWUUUBZYv+n27STsJ7oDOHJgfF0bNKLMJF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-S1XT2DT4WF"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-S1XT2DT4WF');
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

<div id="neddpay-full" class="uk-modal-full  uk-height-viewport" uk-modal>
    <div class="uk-modal-dialog" dir="rtl">
        <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-height-viewport uk-grid>
            <div dir="rtl" class="uk-padding-large uk-text-right">
                <h1>تحتاج الى الاشتراك بباقة لتتمكن من استعمال المنصة.</h1>
                <p>ندعوك الى اختيار الباقة التي تناسبة من اجل ادارة نشاطك التجاري باحترافية وبساطة</p>
                <a href="/tarifs">
                    <button class="uk-button uk-button-primary">مشاهدة الباقات</button>
                </a>
            </div>

        </div>
    </div>
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

                        <div class="logo"><a href="{{ URL::asset('/u') }}"><img class="logo-ayol"
                                    title="Logo - Desky" src="{{ URL::asset('image/logo-beta.png') }}"></a></div>
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
                                            <li><a href="{{ URL::asset('/creer/client') }}"><i
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
                                    <a href="{{ URL::asset('/facture/list') }}" class="uk-button-text"><i
                                            class="far fa-chart-bar"></i> &nbsp; التحليلات والأدوات</a>
                                    <div uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000; pos: bottom-right"
                                        class="">
                                        <ul class="uk-nav uk-dropdown-nav">
                                            <li><a href="{{ URL::asset('/statistique/mois') }}"><span></span>
                                                    الاحصائيات و التقارير الشهرية</a>
                                            </li>
                                            <li dir="rtl"><a
                                                    href="{{ URL::asset('/statistique/annee') }}"><span></span>
                                                    الاحصائيات التقارير السنوية </a></li>
                                            <li dir="rtl"><a
                                                    href="{{ URL::asset('/statistique/impot') }}"><span></span>
                                                    المحاسبة والضرائب </a></li>



                                        </ul>
                                    </div>
                                </li>
                                <!--li>
                                    <a href="{{ URL::asset('/ae-network') }}" class="uk-button-text"><i class="fas fa-globe"></i> &nbsp; شبكة المقاول</a>

                                </li-->
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

                        <button style="    padding: 10px;" dir="rtl" class="  uk-float-left  user-menu-bar" type="button">
                            <span class="bell-icon"><i class="fas fa-user"></i></span> </button>

                        <div uk-dropdown="boundary: .boundary">
                            <ul dir="rtl" class="uk-nav uk-dropdown-nav uk-text-right">
                                <li><a href="{{ asset('u/account') }}"><span uk-icon="user"></span> حسابي </a></li>
                                <li><a href="{{ asset('u/payments/history') }}"><span uk-icon="history"></span> سجل
                                        المدفوعات</a>
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
                            </div-->
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
                                <img src="{{ asset('image/desky-white-logo.png') }}" alt="desky.ma - white logo">
                            </div>
                            <hr class="uk-divider-icon">

                            <h4></h4>
                            <ul class="uk-list uk-list-large">


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
                                            <li><a href="{{ URL::asset('/creer/client') }}"><i
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
                                    <a href="{{ URL::asset('/facture/list') }}" class="uk-button-text"><i
                                            class="far fa-chart-bar"></i> &nbsp; التحليلات والأدوات</a>
                                    <div uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000; pos: bottom-right"
                                        class="">
                                        <ul class="uk-nav uk-dropdown-nav">
                                            <li><a href="{{ URL::asset('/statistique/mois') }}"><span></span>
                                                    الاحصائيات و التقارير الشهرية</a>
                                            </li>
                                            <li dir="rtl"><a
                                                    href="{{ URL::asset('/statistique/annee') }}"><span></span>
                                                    الاحصائيات التقارير السنوية </a></li>
                                            <li dir="rtl"><a
                                                    href="{{ URL::asset('/statistique/impot') }}"><span></span>
                                                    المحاسبة والضرائب </a></li>



                                        </ul>
                                    </div>
                                </li>

                                <br>
                                <hr class="uk-divider-icon">

                                <div id="copyright">
                                    <div class="container" style="width: auto !important;">
                                        <!-- Copyright Text Start -->
                                        <small dir="rtl">

                                            Desky.ma منتج تابع لشركة NERYOU جميع الحقوق محفوظة © {{ now()->year }}
                                            <br>

                                            <small>v {{ env('APP_VERSION') }} ({{ env('APP_RELEASE_YEAR') }})
                                                @if (env('APP_BETA') == true) BETA
                                                @endif</small>
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
                        <p dir="rtl"><span uk-icon="icon: warning"></span> لقد نفد رصيدك يرجى <a href="/register/pack">تجديد اشتراكك</a>
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
