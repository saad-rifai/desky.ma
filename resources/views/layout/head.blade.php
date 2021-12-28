<!DOCTYPE html>

<html lang="ar">
@php

$webinfos = file_get_contents('data/json/webinfo.json');
$webinfos = json_decode($webinfos, true);
foreach ($webinfos as $webinfo);
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="{{ $webinfo['keywords'] }}">
    <meta name="description" content=" @yield('description', $webinfo['description'])">
    <meta name="author" content="NERYOU SARL">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:type" content="website" />

    <meta property="og:title" content="Desky - @yield('title', $webinfo['title'])">
    <meta property="og:description" content="@yield('description', $webinfo['description'])">
    <meta property="og:image" content="@yield('thumbnail', asset('img/assets/web-thumbnail.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    <meta property="og:site_name" content="desky.ma">
    <meta name="twitter:image:alt" content="Desky - @yield('title', $webinfo['title'])">
    <title>Desky - @yield('title', $webinfo['title'])</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/navbar.js') }}" defer></script>

    <!-- Styles -->

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Fonts -->

    
    <!-- style -->
    <link rel="stylesheet" href="{{asset('css/min/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/min/resetstyle.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css">

    <!-- style -->

    <link rel="shortcut icon" id="favicon"
        href="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/asset/favicon-32x32.png" type="image/x-icon">


    <!-- Font Awesome Pro CSS -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-xVVam1KS4+Qt2OrFa+VdRUoXygyKIuNWUUUBZYv+n27STsJ7oDOHJgfF0bNKLMJF" crossorigin="anonymous">
    <!-- Jquery -->

    <script src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/js/library/nanobar.min.js"></script>

    <!-- Basic Style for Tags Input -->
    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        }
    </script>

    <!-- Google Analytics -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-S1XT2DT4WF"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-S1XT2DT4WF');
    </script>
    <script type='text/javascript'>
        window.smartlook||(function(d) {
          var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
          var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
          c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
          })(document);
          smartlook('init', '2116c3d407e509ec35e5e7310e0ccd81e60825ad');
      </script>
</head>

<body>

    <!-- Nav Bar  -->
    <nav dir="rtl" class="navbar navbar-expand-lg navbar-light bg-light web-navbar" id="navbar">
        <div class="container-fluid container">
            <a class="navbar-brand beta" href="{{ asset('/') }}" dir="rtl" data-toggle="tooltip"
                title="هذه المنصة لازالت قيد التطوير والتحسين">

                <img class="logo-web "
                    src="{{ asset('https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/brand/logo-web.png') }}"
                    alt="logo brand desky">
            </a>


            <div class="collapse navbar-collapse" id="PhoneNavbar">
                <ul class="navbar-nav mx-auto  mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle dropdown-hover" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-expanded="false">
                            المقاولين الذاتيين <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ asset('auto-entrepreneurs?href=navbar') }}"><i
                                    class="fas fa-users"></i> تصفح المقاولين الذاتيين</a>
                            <!--a href="#" class="dropdown-item" data-toggle="tooltip" data-placement="bottom"
                                title="جميع المقاولين الذاتيين اللذين تعاقدت معهم"><i class="fas fa-file-contract"></i>
                                جميع العقود</a-->
                        </div>

                    </li>



                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-expanded="false">
                            طلبات العروض <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ asset('orders') }}"><i class="fas fa-folders"></i>
                                جميع طلبات العروض المفتوحة</a>
                            <a class="dropdown-item"
                                href="{{ asset('new/order?from=navbar&token=' . csrf_token()) }}"><i
                                    class="fas fa-folder-plus"></i> نشر طلب عروض</a>
                            @auth
                                <a class="dropdown-item" href="{{ asset('MyOrders') }}"><i class="fas fa-folder"></i>
                                    طلباتي </a>

                                <a class="dropdown-item" href="{{ asset('MyOffers') }}"><i
                                        class="fas fa-ticket-alt"></i> عروضي</a>
                            @endauth

                        </div>

                    </li>
                </ul>
                @guest
                    <div class="btn-act-section" dir="rtl">

                        <div class="non-auth">
                            <a href="{{ asset('login') }}">
                                <button type="button" class="btn btn-outline-primary ">الدخول</button>
                            </a>
                            <a href="{{ asset('register') }}">
                                <button type="button" class="btn btn-primary">انشاء حساب</button>
                            </a>
                        </div>
                    </div>
                @endguest
            </div>
            <div class="" style="    margin-right: auto;
                padding-left: 5px;" dir="rtl">
                @auth

                    <div class="auth-user">
                        <div class="row">
                            <div class="col-auto pm-0">

                                <notification-menu></notification-menu>

                            </div>
                            <div class="col-auto pm-0">
                                <nav-menu-messages></nav-menu-messages>
                            </div>
                            <div class="col-auto pm-0">

                                <navbar-menu :user="{{ Auth::user() }}"></navbar-menu>
                            </div>



                        </div>
                    </div>
                @endauth

            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#MobileMenuHumber"
                aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="page-load" id="page-load"></div>
    <!-- Nav Bar  -->


    <div class="offcanvas offcanvas-start" dir="rtl" tabindex="-1" id="MobileMenuHumber"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                <a class="navbar-brand beta" href="{{ asset('/') }}" dir="rtl">

                    <img class="logo-web " src="{{ asset('/img/brand/logo-web.png') }}" alt="logo brand desky">
                </a>

            </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-group list-unstyled">

                <li class="nav-item ">
                    <a class="nav-link" href="#">
                        المقاولين الذاتيين
                    </a>
                    <ul class="list-group list-group-flush list-unstyled">
                        <li>
                            <a class="dropdown-item" href="{{ asset('auto-entrepreneurs?href=navbar') }}"><i
                                    class="fas fa-users"></i> تصفح المقاولين الذاتيين</a>
                        </li>
                        <li>
                            <!--a href="#" class="dropdown-item" data-toggle="tooltip" data-placement="bottom"
                                title="جميع المقاولين الذاتيين اللذين تعاقدت معهم"><i class="fas fa-file-contract"></i>
                                جميع العقود</a-->
                        </li>

                    </ul>

                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ asset('orders') }}">
                        طلبات العروض
                    </a>
                    <ul class="list-group list-group-flush list-unstyled">
                        <li>
                            <a class="dropdown-item" href="{{ asset('orders') }}"><i class="fas fa-folders"></i>
                                جميع طلبات العروض المفتوحة</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ asset('MyOrders') }}"><i class="fas fa-folder"></i>
                                طلباتي </a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                                href="{{ asset('new/order?from=navbar&token=' . csrf_token()) }}"><i
                                    class="fas fa-folder-plus"></i> نشر طلب عروض</a>
                        </li>
                    </ul>

                </li>
                @guest
                    <div class="btn-act-section mt-3" dir="rtl">

                        <div class="non-auth">
                            <a href="{{ asset('login') }}">
                                <button type="button" class="btn btn-outline-primary w-100 mb-3">الدخول</button>
                            </a>
                            <a href="{{ asset('register') }}">
                                <button type="button" class="btn btn-primary w-100">انشاء حساب</button>
                            </a>
                        </div>
                    </div>
                @endguest
            </ul>
        </div>
    </div>
    <div class="page-wrapper-desky">
        @if (isset($_GET['newTicket']) && $_GET['newTicket'] == true)
        <div class="info-banner bg-success">
            <h1 class="info-banner-text">تم انشاء تذكرتك بنجاح سوف تتلقى رداََ في الساعات المقبلة</h1>
        </div>
        @endif
        <div class="info-banner bg-brand font-Naskh" dir="rtl">
            <div class="container">
                <div class="row justify-content-center align-items-center text-center mb-3">
                    <div class="col-auto"><h1 class="fs-6 pt-3 text-white" data-toggle="tooltip" data-placement="bottom" title="عند تفعيل حساب المقاول الذاتي الخاص بك ستتمكن من تقديم عروضك على الطلبات وسيتمكن العملاء من التواصل معك والبحث عنك في محركات البحث ديسكي.">حساب المقاول الذاتي الخاص بك غير مفعل بعد قدم طلب لتفعيله الأن </h1></div> 
                    <div class="col-auto mt-2"><button class="btn btn-outline-light btn-sm">تفعيل حساب المقاول الذاتي</button></div>
    
                </div>
            </div>

        </div>
        @if (Auth::check() && Auth::user()->email_verified_at == null)
        <div class="info-banner bg-warning">
            <h1 class="info-banner-text">لقد ارسلنا لك رسالة تأكيد البريد الالكتروني يرجى الحقق من بريدك</h1>
        </div>
        @endif

        @yield('content')
    </div>
