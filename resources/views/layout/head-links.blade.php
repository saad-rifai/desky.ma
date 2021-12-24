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
    @yield('content')
</body>
</html>