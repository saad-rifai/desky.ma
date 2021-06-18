<!DOCTYPE html>
<html lang="ar">
<head>
    <link rel="icon" href="{{ asset('image/desky/favicon.jpg') }}" type="image/jpg" sizes="17x17">
    <!-- Facebook Pixel Code -->

            <noscript>
                <meta http-equiv="refresh" content="0;url=noscript.html">
              </noscript>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '162243945814000');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=162243945814000&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->    

    <!-- End Facebook Pixel Code -->
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="تقدم لك منصة desky.ma نظام احترافي لادارة نشاط المقاول الذاتي يمكن من خلاله ادارة كافة جوانب عملك تمكنك المنصة من انشاء وادارة الفواتير وعروض أسعار (devis) احترافية ببساطة وسهولة بهويتك البصرية كما تمكنك المنصة من ادارة وتسيير عملائك وانجاز تقارير وتحليلات شهرية وسنوية وتمكنك من حساب وتوقع الضرائب الخاصة بك .">
    <meta name="keywords" content="desky.ma, منصة ديسكي, منصة desky, فاتورة المقاول الذاتي, دوفي المقاول الذاتي, نظام ادارة المقاول الذاتي, منصة ادارة فواتير المقاول الداتي, دوفي المقاول الذاتي, المقاول الذاتي بالمغرب, facture, devis, Autoentrepreneur devis, Autoentrepreneur facture, Auto Entrepreneur, اتحاد المقاوليين الذاتيين بالمغرب, المقاول الذاتي بالمغرب, نظام المقاول الذاتي,E-commerce Autoentrepreneur, Management, عمل المقاول الذاتي, بطاقة المقاول الذاتي, المقاول الذاتي مشروع ناجح, نجاح مقاول ذاتي, قصة نجاح مقاول ذاتي">
    <meta name="author" content="Saad Rifai">
    <!-- SEO -->
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ URL::current() }}">
    <meta name="twitter:title" content="desky - @yield('title')">
    <meta name="twitter:description" content="تقدم لك منصة desky.ma نظام احترافي لادارة نشاط المقاول الذاتي يمكن من خلاله ادارة كافة جوانب عملك تمكنك المنصة من انشاء وادارة الفواتير وعروض أسعار (devis) احترافية ببساطة وسهولة بهويتك البصرية كما تمكنك المنصة من ادارة وتسيير عملائك وانجاز تقارير وتحليلات شهرية وسنوية وتمكنك من حساب وتوقع الضرائب الخاصة بك .">
    <!-- Twitter Summary card images must be at least 120x120px -->
    <meta name="twitter:image" content="/image/desky/brand-cover.jpg">
    <!-- Open Graph data -->
    <meta property="og:title" content="desky - @yield('title')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ URL::asset('') }}" />
    <meta property="og:image" content="/image/desky/brand-cover.jpg" />
    <meta property="og:description" content="تقدم لك منصة desky.ma نظام احترافي لادارة نشاط المقاول الذاتي يمكن من خلاله ادارة كافة جوانب عملك تمكنك المنصة من انشاء وادارة الفواتير وعروض أسعار (devis) احترافية ببساطة وسهولة بهويتك البصرية كما تمكنك المنصة من ادارة وتسيير عملائك وانجاز تقارير وتحليلات شهرية وسنوية وتمكنك من حساب وتوقع الضرائب الخاصة بك ." />
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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-xVVam1KS4+Qt2OrFa+VdRUoXygyKIuNWUUUBZYv+n27STsJ7oDOHJgfF0bNKLMJF" crossorigin="anonymous">
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
<!-- Messenger Plug-in Discussion Code -->
<div id="fb-root"></div>

<!-- Your Plug-in Discussion code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "107158034873357");
  chatbox.setAttribute("attribution", "biz_inbox");
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v11.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/ar_AR/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
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
            <div class="h-75"></div>

            <!-- Header Of Website -->
            <nav class="uk-navbar-container Blue-brand-ayol " id="navbar-desky" dir="rtl" uk-navbar>

                <div class="center-ayol">

                    <div class="uk-navbar-right">
                        <button style="display: none" uk-toggle="target: #offcanvas-slide" type="button"
                            class="toggel-button"><span uk-icon="icon: menu; ratio: 2"></span></button>
                        <div class="logo"><a href="{{ URL::asset('') }}"><img class="logo-ayol" title="Logo - Desky"
                                    src="{{ URL::asset('image/logo-beta.png') }}"></a></div>
                        <div class="uk-navbar-center">

                            <ul class="uk-navbar-nav">
                                @if(Route::getCurrentRoute()->uri() == '/')
                                <li><a href="{{ URL::asset('/#aboutservice') }}" class="uk-button-text">عن الخدمة </a>     </li>
                                <li><a href="{{ URL::asset('/#q&a') }}" class="uk-button-text">الاسئلة الشائعة</a></li>
                                <li><a href="{{ URL::asset('/#tarifs') }}" class="uk-button-text"> الأسعار</a></li>
                                <li><a href="{{ URL::asset('/#a-propos-de-nous') }}" class="uk-button-text"> من نحن</a></li>
                                @else
                                    <li><a href="{{ URL::asset('/À-propos-du-service') }}" class="uk-button-text">عن الخدمة </a>     </li>
                                    <li><a href="{{ URL::asset('/q&a') }}" class="uk-button-text">الاسئلة الشائعة</a></li>
                                    <li><a href="{{ URL::asset('/tarifs') }}" class="uk-button-text"> الأسعار</a></li>
                                    <li><a href="{{ URL::asset('/a-propos-de-nous') }}" class="uk-button-text"> من نحن</a></li>
                                @endif


                                <li><a href="{{ URL::asset('/Contactez-nous') }}" class="uk-button-text"> تواصل معنا</a></li>
                                <!--li><a href="{{ URL::asset('/#q&a') }}" class="uk-button-text"> شبكة المقاولين
                                        الذاتيين</a></li>
                                <li--><!--a class="uk-button-text" href="{{ URL::asset('/contactus') }}">تواصل معنا</a>
                                </li-->
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
                                <li class="l1"><a href="{{asset('u/account')}}"><span uk-icon="user"></span> حسابي </a></li>
                                <li class="l2"><a href="{{asset('u/abonnement')}}"><span uk-icon="credit-card"></span>  الاشتراكات والدفع</a></li>
                                <li class="l3"><a href="{{asset('u/settings')}}"><span uk-icon="file-edit"></span> اعدادات الحساب </a></li>
                                <li class="l4"><a href="{{asset('desk/settings')}}"><span uk-icon="settings"></span> اعدادات المكتب</a></li>
                                <li class="l5"><a href="{{asset('u/privacy')}}"><span uk-icon="lock"></span> اعدادات الخصوصية</a></li>
                                <li class="l6"><a href="/u/payments/history"><span uk-icon="history"></span> سجل المدفوعات</a></li>
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
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form-->

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
                                @if(Route::getCurrentRoute()->uri() == '/')
                                <li><a href="{{ URL::asset('/#aboutservice') }}" class="uk-button-text">عن الخدمة </a>     </li>
                                <li><a href="{{ URL::asset('/#q&a') }}" class="uk-button-text">الاسئلة الشائعة</a></li>
                                <li><a href="{{ URL::asset('/#tarifs') }}" class="uk-button-text"> الأسعار</a></li>
                                <li><a href="{{ URL::asset('/#a-propos-de-nous') }}" class="uk-button-text"> من نحن</a></li>
                                @else
                                    <li><a href="{{ URL::asset('/À-propos-du-service') }}" class="uk-button-text">عن الخدمة </a>     </li>
                                    <li><a href="{{ URL::asset('/q&a') }}" class="uk-button-text">الاسئلة الشائعة</a></li>
                                    <li><a href="{{ URL::asset('/tarifs') }}" class="uk-button-text"> الأسعار</a></li>
                                    <li><a href="{{ URL::asset('/a-propos-de-nous') }}" class="uk-button-text"> من نحن</a></li>
                                @endif
                                <li><a href="{{ URL::asset('/Contactez-nous') }}" class="uk-button-text"> تواصل معنا</a></li>

                            </ul>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-window"></div>
            @yield('content')
        </div>
    </div>
    <footer dir="rtl">
        <div class="wd-80">
            <div class="uk-grid-large" uk-grid>
                <div class="uk-width-1-2@s">

                <ul class="uk-list">
                    <h4><span uk-icon="icon: chevron-left"></span> منصة Desky </h4>
                    <li><a href="{{ URL::asset('/À-propos-du-service') }}" class="uk-button-text"> <span uk-icon="icon: link"></span> عن الخدمة </a>     </li>
                    <li><a href="{{ URL::asset('/q&a') }}" class="uk-button-text"> <span uk-icon="icon: link"></span> الاسئلة الشائعة</a></li>
                    <li><a href="{{ URL::asset('/tarifs') }}" class="uk-button-text"> <span uk-icon="icon: link"></span> الأسعار</a></li>
                    <li><a href="{{ URL::asset('/a-propos-de-nous') }}" class="uk-button-text"> <span uk-icon="icon: link"></span> من نحن</a></li>

                    <li><a href="{{ URL::asset('/politique-de-confidentialite') }}"> <span uk-icon="icon: link"></span> بيان
                            الخصوصية</a></li>
                    <li>
                        <h4>عن منصة Desky.ma </h4>
                        <p class="des-footer" style="color:#4e4e4e">
                            تقدم لك منصة desky.ma نظام احترافي لادارة نشاط المقاول الذاتي يمكن من خلاله ادارة كافة جوانب عملك تمكنك المنصة من انشاء وادارة الفواتير وعروض أسعار (devis) احترافية ببساطة وسهولة بهويتك البصرية كما تمكنك المنصة من ادارة وتسيير عملائك وانجاز تقارير وتحليلات شهرية وسنوية وتمكنك من حساب وتوقع الضرائب الخاصة بك .

                        </p>
                    </li>
                </ul>
                </div>
                <div class="uk-width-1-2@s">
                <ul class="uk-list uk-width-1-1">
                    <h4><span uk-icon="icon: chevron-left"></span> روابط مفيدة</h4>

                    <li><a href="{{ URL::asset('/Contactez-nous') }}"><span
                                uk-icon="icon: link"></span>
                            تواصل معنا</a></li>


                    <h4><span uk-icon="icon: chevron-left"></span> طرق الدفع</h4>

                    <li>
                        <img class="logo-pay-footer" src="{{ URL::asset('image/icon/logo-wafacash.jpg') }}"
                            alt="wafacach - desky.ma">
                            <img class="logo-pay-footer" src="{{ URL::asset('image/partners/cfg-logo.svg') }}"
                            alt="CFG BANK - desky.ma">
                        <!--img class="logo-pay-footer" src="{{ URL::asset('image/icon/visa-mastercard.png') }}"
                            alt="visa master card - desky.ma">
                            <img class="logo-pay-footer" src="{{ URL::asset('image/icon/cmi-logo.png') }}"
                            alt="CMI - desky.ma"-->
                    </li>

                    <h4><span uk-icon="icon: chevron-left"></span> تابعنا على</h4>
                    <li>
                        <div class="socialmedia-container">
                            <a href="{{ $jsondata['socialmedia']['twitter'] }}" class="uk-icon-button"
                                uk-icon="twitter"></a>
                            <a href="{{ $jsondata['socialmedia']['facebook'] }}"
                                class="uk-icon-button  uk-margin-small-right" uk-icon="facebook"></a>
                            <a href="{{ $jsondata['socialmedia']['instagram'] }}"
                                class="uk-icon-button uk-margin-small-right" uk-icon="instagram"></a>
                            <a href="{{ $jsondata['socialmedia']['youtube'] }}"
                                class="uk-icon-button uk-margin-small-right" uk-icon="youtube"></a>

                        </div>
                    </li>
                </ul>
                </div>
            </div>
            <hr style="border-top: 0.5px solid #d8d8d8 ">
            <div id="copyright">
                <div class="container" style="width: auto !important;">
                    <!-- Copyright Text Start -->
                    <p style="color: #3a3a3a" dir="rtl">

                        Desky.ma منتج تابع لشركة NERYOU S.A.R.L جميع الحقوق محفوظة © {{ now()->year }}

                    </p>
                    <!-- Copyright Text End -->
                    <p style="color: 3a3a3a">

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
