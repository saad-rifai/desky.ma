<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

   


    <link href="{{ URL::asset('uikit/dist/css/uikit-rtl.min.css') }}" rel="stylesheet">
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

    <!-- Global site tag (gtag.js) - Google Analytics -->


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
