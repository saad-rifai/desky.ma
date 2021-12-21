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
    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css">


    <title>Desky - خطأ 404</title>
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

<div class="container">
    <div class="row row-cols-1 mx-auto text-center mb-5 align-items-center position-absolute top-50 start-50 translate-middle">
        <div class="col w-100">
            <div class="icon-large-top">
                <img style="max-width: 350px"
                    src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/asset/404+error+with+a+tired+person-bro.png"
                    alt="خطأ 404" />
            </div>
        </div>
        <div class="col w-100 mt-3">
            <p class="text-icon">
              خطأ 404
                <span class="d-block font-Naskh text-secondary">
                   لم يتم العثور على ماتبحث عنه يرجى التحقق من أن العنوان صالح.
    
                </span>
            </p>
    
    
        </div>
        <div class="col">
            <a href="{{ asset('/') }}"><button  type="button" class="btn text-center btn-primary">
                الصفحة الرئيسية</button></a>
        </div>
    </div>
    

</div>
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
    