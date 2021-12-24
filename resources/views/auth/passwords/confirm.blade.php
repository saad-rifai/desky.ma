@extends('auth.layouts.layout')
@section('title', 'اعادة تعيين كلمة المرور')

@section('content')


    <div class="page-load" id="page-load"></div>


    <div class="container">
        <div class="logo-brand-top-card mt-5 mb-5">
            <img src="{{ asset('img/brand/logo-web.png') }}" alt="desky - login">
        </div>
        <div class="form-head text-center" dir="rtl">
            <h1 class="form-head-title">اعادة تعيين كلمة المرور</h1>
        </div>
        <div class="card p-3 mt-3 mb-5 mx-auto" style="max-width: 500px" dir="rtl">
            <div class="content-form p-3 pt-1">

                <div id="app">
                    @if ($ValideToken && $ValideToken == true)
                        <div class=" pb-3 mb-3 mt-3">
                            <div class="    head-box-article">
                                <div class="row text-center">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar-large-box-article">
                                                    @if ($avatar != null)
                                                        <img src="{{ asset("$avatar") }}" alt="{{ $fullname }}">


                                                        @else
                                                    
                                                    <img src="{{ asset('img/icons/avatar.png') }}"
                                                        alt="{{ $fullname }}">
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="user-name-box-article">
                                                    <h4>
                                                        {{ ucfirst($fullname) }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mr-65 mmt-35">
                                    <div class="col-auto">
                                        <div class="user-info-box-article">
                                            <div class="row">

                                                <div class="col-auto">
                                                    <div class="user-info-box-article">
                                                        <span>@</span>{{ $username }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        <update-password :hashtoken="'{{$HashToken}}'"></update-password>
                    @else

                        <div class="alert alert-danger" role="alert">
                            انتهت صلاحية الرابط، يرجى طلب رمز استعادة كلمة المرور من جديد
                        </div>

                    @endif

                </div>

            </div>


        </div>
        <div class="text-center p-3 mt-3 mb-5 mx-auto" style="max-width: 750px" dir="rtl">
            <div class="content-form p-3 font-Naskh mx-auto">
                <span class="text-center"> تذكرت كلمة المرور ؟ <a href="{{ asset('login') }}">سجل
                        الدخول</a></span>
            </div>
        </div>
    </div>


@stop