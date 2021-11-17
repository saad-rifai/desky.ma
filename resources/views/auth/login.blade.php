<!doctype html>

<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="description" content="Free Web tutorials">
    <meta name="author" content="Saad Rifai">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/resetstyle.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->

    <!-- Fonts -->
    <link rel="shortcut icon" href="{{asset('img/icons/favicon-32x32.png')}}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Fonts -->

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css">


    <title>Desky - الدخول</title>
    <!-- Font-awsome -->

    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"
        integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nanobar/0.4.2/nanobar.min.js"
        integrity="sha512-1Al+dnfE+1gI7IBmpUZ8XnZ3l3Nv6cyA+XgdtlaptVNxJcWWRzHxOPzT+2pbp52qtXa2jkwk0MWYSmxslMsHCQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Basic Style for Tags Input -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>


    <div class="page-load" id="page-load"></div>


    <div class="container">
        <div class="logo-brand-top-card mt-5 mb-5">
            <img src="{{ asset('img/brand/logo-web.png') }}" alt="desky - login">
        </div>
        <div class="card p-3 mt-3 mb-5 mx-auto" style="max-width: 750px" dir="rtl">
            <div class="content-form p-3 pt-1">
                <h1 class="card-title mb-4 mt-3">تسجيل الدخول</h1>
         
                <div class="row text-center mt-3 mb-2">
                    <div class="col-sm mb-2">
                        <button class="login-opt facebook"><span class="icon-login-opt"><i
                                    class="fab fa-facebook-f"></i></span> باستخدام فيسبوك </button>

                    </div>
                    <div class="col-sm mb-2">
                        <button class="login-opt google"><span class="icon-login-opt"><i
                                    class="fab fa-google"></i></span> باستخدام جوجل </button>

                    </div>
                </div>
                <div class="strike mt-3 mb-3">
                    <span>أو</span>
                </div>
                <div id="app">
                    <login-form :csrf="'{{csrf_token()}}'" ></login-form>

                </div>
           
            </div>


        </div>
        <div class="card p-3 mt-3 mb-5 mx-auto" style="max-width: 750px" dir="rtl">
            <div class="content-form p-3 mx-auto" >
                <span class="text-center">ليس لديك حساب بعد <a href="{{asset("register")}}">انشاء حساب</a></span>
            </div>
        </div>
    </div>



    <footer dir="rtl">
        <div class=" content-footer">

            <div class="bottom-footer">
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

<script src="{{ asset('js/script.js') }}"></script>

</html>
