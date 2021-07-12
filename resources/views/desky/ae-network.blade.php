@extends('desky.layouts.app')
@section('title', 'شبكة المقاوليين الذاتيين بالمغرب')
@section('description',
    ' أول مكتب خاص بالمقاول الذاتي على الانترنت لادارة نشاطك التجاري باحترافية من أي مكان وفي أي
    وقت.',)
@section('ogimage', asset('image/service/3182768.jpg'))
@section('content')
    <header>
        <div class="uk-child-width-1-1@s uk-light" uk-grid>
            <div>
                <div class="uk-background-cover uk-height-large uk-panel uk-flex uk-flex-center uk-flex-middle"
                    style="background-image: linear-gradient(#0f0f0fa6, #0f0f0fa6), url(../image/service/3182768.jpg);">
                    <div class="wd-90 uk-text-center">
                        <div class="content-header uk-text-center">
                            <h1 class="uk-title header">مرحباََ بك في أول وأكبر شبكة مقاوليين ذاتيين بالمغرب.</h1>
                            </p>
                            <a href="#form-demande-branding" uk-toggle> <button type="button"
                                    class="uk-button uk-button-primary btn-call">سجل الأن
                                </button></a>

                        </div>
                    </div>
                </div>
            </div>
    </header>
    <div class="wd-90 uk-margin-top" dir="rtl" uk-grid>
        <div class="uk-width-1-4@m">
            <div class="uk-card uk-card-default uk-card-body">
                <h4 class="uk-card-title uk-text-right"><span uk-icon="search"></span>
                    البحث</h4>
                <hr>
                <div class="uk-margin">
                    <label>كلمات مفتاحية</label>
                    <input class="uk-input" type="text" placeholder="">
                </div>
                <div class="uk-margin">
                    <label>القطاع</label>
                    <select class="uk-select">
                        <option> </option>
                        <option>Option 01</option>
                        <option>Option 02</option>
                    </select>
                </div>
                <div class="uk-margin">
                    <label>المدينة</label>
                    <select class="uk-select">
                        <option> </option>
                        <option>Option 01</option>
                        <option>Option 02</option>
                    </select>
                </div>
                <br>

            </div>
            <br>
            <div class="uk-card uk-card-default uk-card-body">
                <h4 class="uk-card-title uk-text-right"><span uk-icon="search"></span>
                    مقاول مميز</h4>
                <hr>
                <table class="uk-table uk-table-middle uk-table-divider">

                    <tbody>
                            <tr>
                                <td>Saad Rifai</td>

                            </tr>
                            <tr>
                                <td>Saad Rifai</td>

                            </tr>
                            <tr>
                                <td>Saad Rifai</td>

                            </tr>
                            <tr>
                                <td>Saad Rifai</td>

                            </tr>
                    </tbody>
                </table>
                <br>

            </div>
        </div>
        <div class="uk-width-expand@m uk-card uk-card-default uk-card-body">

            <h1 class="uk-card-title">لائحة المقاولين الذاتيين بالمغرب</h1>
            @for($i=0; $i < 10; $i++)
            <hr>
            <article class="uk-comment">
                <div class="uk-comment-header">
                    <div class="uk-grid-medium uk-flex-middle" uk-grid>
                        <div class="uk-width-auto" style="position: relative">
                            <img class="uk-comment-avatar" src="{{ asset('image/icon/user.png') }}" width="50" height="50" alt="">

                        </div>
                        <div class="uk-width-expand " style="position: relative;">
                            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">Hiba ghmarti  <span class="verified-badge " uk-tooltip="title: تم التحقق من هذا الحساب; pos: left" title="تم التحقق"><i class="fas fa-badge-check"></i></span></a></h4>
                            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                                <li><a href="#"><i class="fa fa-fw fa-briefcase"></i> التصميم الجرافيكي </a></li>
                                <li><a href="#"><i class="fas fa-map-marker-alt"></i> طنجة, المغرب</a></li>
                            </ul>
                        <button class="uk-button uk-button-primary uk-position-top-left"><i class="fas fa-envelope"></i> التواصل</button>
                        </div>
                    </div>
                </div>
                <div class="uk-comment-body">
                    <p>السلام عليكم معكم اميمة مهندسة طبوغرافية و منذوبة مبيعات لمذة ٣ سنوات و مذخلة بيانات لمذة سنة

                        لذي مهارة الكتابة باللغة العربية الفرنسية و الانجليزية
                        اتقن الترجمة أيضا بين هذه اللغات بطريقة سليمة و بشرية...</p>
                </div>
            </article>
            @endfor
            <ul dir="ltr" class="uk-pagination uk-flex-center" uk-margin>
                <li><a href="#"><span uk-pagination-previous></span></a></li>
                <li><a href="#">1</a></li>
                <li class="uk-disabled"><span>...</span></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li class="uk-active"><span>7</span></li>
                <li><a href="#">8</a></li>
                <li><a href="#"><span uk-pagination-next></span></a></li>
            </ul>
        </div>

    </div>
    <br>
<br>

@endsection
