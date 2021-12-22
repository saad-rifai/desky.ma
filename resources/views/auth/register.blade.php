<!doctype html>
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

    <meta property="og:title" content="Desky - انشاء حساب">
    <meta property="og:description" content="@yield('description', $webinfo['description'])">
    <meta property="og:image" content="@yield('thumbnail', asset('img/assets/web-thumbnail.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    <meta property="og:site_name" content="desky.ma">
    <meta name="twitter:image:alt" content="Desky - @yield('title', $webinfo['title'])">
    <!-- style -->
    <link href="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/css/resetstyle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css">

    <!-- style -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="shortcut icon" href="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/asset/favicon-32x32.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Desky - انشاء حساب</title>
    <!-- Font-awsome -->
    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"
        integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nanobar/0.4.2/nanobar.min.js"
        integrity="sha512-1Al+dnfE+1gI7IBmpUZ8XnZ3l3Nv6cyA+XgdtlaptVNxJcWWRzHxOPzT+2pbp52qtXa2jkwk0MWYSmxslMsHCQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Basic Style for Tags Input -->
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer>
    </script> 
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-S1XT2DT4WF"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
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
    <div class="page-load" id="page-load"></div>
    <div class="container">
        <div class="logo-brand-top-card mt-5 mb-5">
            <img src="{{ asset('https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/brand/logo-web.png') }}" alt="desky - login">
        </div>
        <div class="form-head text-center" dir="rtl">
            <h1 class="form-head-title">مرحبا بك سعداء بانضمامك لنا</h1>
            <p class="form-head-text">نحتاج بعض المعلومات منك لانشاء حسابك</p>
        </div>
        <div class="card p-3 mt-3 mb-5 mx-auto" style="max-width: 750px" dir="rtl">
            <div class="content-form p-3 pt-1">



           
      
              <div id="app">
                  <register-form></register-form>
              </div>
            </div>


        </div>
        <div class="text-center p-3 mt-3 mb-5 mx-auto font-Naskh" style="max-width: 750px" dir="rtl">
            <div class="content-form p-3 mx-auto">
                <span class="text-center"> لديك حساب بالفعل ؟ <a href="{{ asset('login') }}">سجل الدخول</a></span>
            </div>
        </div>
    </div>



    <footer dir="rtl">
        <div class=" content-footer">

            <div class="bottom-footer font-Naskh">
                <p class="footer-copyright text-center" dir="rtl">© {{date("Y")}} desky. جميع الحقوق محفوظة.
                </p>
            </div>
        </div>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Suggest Tags Js -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


</html>
