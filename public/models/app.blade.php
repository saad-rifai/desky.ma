<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

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

<div id="form-loading" class="form-loading"></div>

<body id="body">


    <!-- Mobile Nav -->



    <!--div class="cokies-section" id="cokiessection">
    <p>We use cookies to ensure you get the best experience on our site. If you continue to use it, we will consider
        that you accept the use of cookies. <button onclick="closecokie()" type="button">I agree</button></p>
</div-->
    <!-- End Header Of Website -->


    <div id="app">

        @yield('content')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    <script src="{{ URL::asset('uikit/dist/js/uikit-icons.min.js') }}"></script>

    <script src="{{ URL::asset('js/main-js.js') }}"></script>

</body>

</html>
