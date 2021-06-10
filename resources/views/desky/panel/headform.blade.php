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
@php
$datajson = file_get_contents('database/data.json');
$jsondata = json_decode($datajson, true);
@endphp
<div id="form-loading" class="form-loading">
    <span class="uk-position-center" uk-spinner="ratio: 3"></span>

</div>

<body id="body">




    <div class="chat-window"></div>



    <br>
    <br>
    <img src="{{ asset('image/logo-beta.png') }}" height="30px" class="logo-pt"
        alt="Desky.ma - Moqawala.ma - Register">
    <div id="app">
        @yield('content')

    </div>
    <p dir="rtl" class="footer-text-small"> Desky.ma منتج تابع لشركة NERYOU S.A.R.L جميع الحقوق محفوظة ©
        {{ now()->year }}
    </p>

    <script src="{{ URL::asset('uikit/dist/js/uikit-icons.min.js') }}"></script>

    <script src="{{ URL::asset('js/main-js.js') }}"></script>

</body>

</html>
