<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ URL::asset('uikit/dist/css/uikit-rtl.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/main-style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/dash-style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/desky-style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/mobile-style.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('uikit/dist/js/uikit.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-3.4.1.min.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <!-- Font Awesome Pro CSS -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-xVVam1KS4+Qt2OrFa+VdRUoXygyKIuNWUUUBZYv+n27STsJ7oDOHJgfF0bNKLMJF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>DESKY UI - NAVBAR</title>
</head>
<body>
    <nav class="desky-primary-navbar" uk-navba>
        <div class="navbar-content">
            <div class="desky-navbar-logo">  <a href="http://{{ env('APP_URL').'/' }}"><img src="/image/logo-desky.png" alt="desky.ma logo register"></a></div>
            <div class="nav-items-class">
                <span class="toggel-menu" type="button" uk-toggle="target: #mobile-nav; animation: uk-animation-fade"> <i class="fal fa-bars"></i></span>
                <ul class="uk-navbar-nav"  dir="rtl">
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
                        <div class="uk-navbar-dropdown" uk-dropdown="mode: hover; pos: bottom-right">
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
                            <button class="uk-button uk-button-primary mb-wd-100 uk-width-1-1">جرب مجاناَ</button>

                            <button class="uk-button uk-button-default mb-wd-100 uk-width-1-1">الدخول</button>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

</body>
<script src="{{ URL::asset('uikit/dist/js/uikit-icons.min.js') }}"></script>

<script src="{{ URL::asset('js/main-js.js') }}"></script>
<script src="{{ URL::asset('js/dash-js.js') }}"></script>
</html>
