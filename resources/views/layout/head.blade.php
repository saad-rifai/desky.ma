<!doctype html>

<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="description" content=" @yield('description', 'tests')">
    <meta name="author" content="Saad Rifai">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/resetstyle.css') }}">
    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Fonts -->


    <link rel="shortcut icon" href="{{ asset('img/icons/favicon-32x32.png') }}" type="image/x-icon">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css">
    <title>Desky - @yield('title')</title>
    <!-- Font Awesome Pro CSS -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-xVVam1KS4+Qt2OrFa+VdRUoXygyKIuNWUUUBZYv+n27STsJ7oDOHJgfF0bNKLMJF" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nanobar/0.4.2/nanobar.min.js"
        integrity="sha512-1Al+dnfE+1gI7IBmpUZ8XnZ3l3Nv6cyA+XgdtlaptVNxJcWWRzHxOPzT+2pbp52qtXa2jkwk0MWYSmxslMsHCQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Basic Style for Tags Input -->
    <link href="{{ asset('css/fotorama.css') }}" rel="stylesheet">
        <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        }
    </script>
</head>
<body>
    <!-- Nav Bar  -->
    <nav dir="rtl" class="navbar navbar-expand-lg navbar-light bg-light web-navbar">
        <div class="container-fluid container">
            <a class="navbar-brand" href="{{ asset('/') }}"><img class="logo-web"
                    src="{{ asset('/img/brand/logo-web.png') }}" alt="logo brand desky"></a>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto  mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ asset('auto-entrepreneurs') }}">تصفح
                            المقاولين</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('orders') }}">طلبات العروض</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ asset('new/order?from=navbar&token=' . csrf_token()) }}">اضف
                            طلب عروض</a>
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
                                <div id="drop-group">
                                    <button class="icon-dropdown " id="menu-btn" data-target="menu_bell" type="button">
                                        <i class="fas fa-bell"></i>
                                    </button>
                                    <div class="menu-dropdown-lg" id="menu_bell">
                                        <div class="menu-dropdown-lg-content position-relative">

                                            <h5 class="menu-title mb-4 mt-2" style="font-size: 14px"> الاشعارات</h1>

                                                <a href="#" class="position-absolute top-0 end-0"
                                                    style="font-size: 12px">الكل</a>


                                                @for ($i = 1; $i < 5; $i++)
                                                    <div class="box-article pb-3 mb-3">
                                                        <div class="    head-box-article">
                                                            <div class="row text-center">
                                                                <div class="col">
                                                                    <div class="row">

                                                                        <div class="col-auto">
                                                                            <div class="notification-title">
                                                                                <h4>
                                                                                    ندعوك الى <a href="#">توثيق حسابك</a>
                                                                                    لكي تتمكن من التقديم على طلبات العروض
                                                                                </h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <span class="date-not">قبل 10 ساعات</span>

                                                        </div>

                                                    </div>

                                                @endfor

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto pm-0">
                                <div id="drop-group-2">
                                    <button class="icon-dropdown " id="menu-btn-2" data-target="message_bell" type="button">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <div class="menu-dropdown-lg" id="message_bell">
                                        <div class="menu-dropdown-lg-content position-relative">

                                            <h5 class="menu-title mb-4 mt-2" style="font-size: 14px"> الرسائل</h1>

                                                <a href="#" class="position-absolute top-0 end-0"
                                                    style="font-size: 12px">الكل</a>


                                                @for ($i = 1; $i < 5; $i++)
                                                    <div class="box-article pb-3 mb-3">
                                                        <div class="    head-box-article">
                                                            <div class="row text-center">
                                                                <div class="col">
                                                                    <div class="row">
                                                                        <div class="col-auto">
                                                                            <div class="user-info-box-article-avatar">
                                                                                <img src="{{ asset('img/users/' . $i . '.jpg') }}"
                                                                                    alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-auto">
                                                                            <div class="user-name-box-article">
                                                                                <h4>
                                                                                    Saad Rifai
                                                                                </h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="body-box-article  mr-menu ">
                                                            <p class="box-article-description ">
                                                                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                                                                توليد
                                                                هذا النص من مولد النص
                                                                العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص
                                                                الأخرى إضافة إلى زيادة عدد الحروف
                                                                التى يولدها التطبيق.

                                                            </p>
                                                        </div>
                                                    </div>

                                                @endfor

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto pm-0">
                                <div class="dropdown">
                                    <div class="user-info-box-article-avatar " data-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset(request()->Avatar) }}" id="menu_user"
                                            alt="{{ Auth::user()->frist_name . ' ' . Auth::user()->last_name }} - avatar">

                                    </div>
                                    <ul class="dropdown-menu shadow-sm" aria-labelledby="menu_user" style="left: 0;top: 60px;">
                                        <li><a class="dropdown-item item-w-icn" href="{{asset('/')}}"><span class="bg-icn"><i class="fas fa-tachometer-alt"></i></span> لوحة التحكم</a></li>
                                        <li><a class="dropdown-item item-w-icn" href="{{asset('@'.auth::user()->username)}}"><span class="bg-icn"><i class="fas fa-at"></i></span> حسابي</a></li>
                                        <li><a class="dropdown-item item-w-icn" href="{{asset('account/settings')}}"><span class="bg-icn"><i class="fas fa-cog"></i></span> اعدادات</a></li>
                                        <li><a class="dropdown-item item-w-icn" href="{{route('logout')}}"><span class="bg-icn"><i class="fas fa-sign-out-alt"></i></span> تسجيل الخروج</a></li>
                                        
                                        
                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                @endauth

            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="page-load" id="page-load"></div>
    <!-- Nav Bar  -->

    @yield('content')
