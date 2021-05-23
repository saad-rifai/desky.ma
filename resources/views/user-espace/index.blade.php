@extends('layouts.layout')
@section('title', 'حسابي')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
@section('ogimage', asset('image/moqawala.ma.jpg'))
@section('content')
    @php

    $datajson = file_get_contents('database/data.json');
    $jsondatas = json_decode($datajson, true);
    @endphp
    <div class="wd-80 uk-margin-small-top uk-margin-small-bottom">
        <style>
        </style>
        <div dir="rtl" class="uk-text-center " uk-grid>

            <div class="uk-width-1-4@m">
                <div class="uk-card uk-card-default uk-card-body" uk-sticky="bottom: true">
                    <h4 class="uk-card-title uk-text-right">
                        مرحبا Saad Rifai !</h4>
                    <hr>


                    <ul dir="rtl" class="uk-list uk-list-divider uk-text-right user-menu">
                        <li class="active"><a href="#"><span uk-icon="user"></span> حسابي </a></li>
                        <li><a href="u/services"><span uk-icon="list"></span> خدماتي</a></li>
                        <li><a href="u/products"><span uk-icon="grid"></span> منتجاتي</a></li>
                        <li><a href="u/history"><span uk-icon="history"></span> سجل المدفوعات</a></li>
                        <li><a href="u/setting"><span uk-icon="cog"></span> الاعدادات </a></li>

                    </ul>
                    <br>

                </div>
            </div>
            <div class="uk-width-expand@m">
                <div class="uk-card uk-card-default uk-card-body">
                    <h4 class="uk-card-title uk-text-right">
                        <span uk-icon="user"></span> حسابي
                    </h4>
                    <hr>
                    <div class="uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <h1 class="uk-card-title">{{ $totalactive }}</h1>
                                <p>خدماتي المكتملة</p>
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <h1 class="uk-card-title">0</h1>
                                <p>منتجاتي المفعلة</p>
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <h1 class="uk-card-title">4</h1>
                                <p>فواتير غير مدفوعة</p>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h4 class="uk-card-title uk-text-right">
                        معلوماتي الشخصية </h4>
                    <div dir="rtl" class="uk-grid-small" uk-grid>

                        <div class="uk-width-1-2@s">
                            <input class="uk-input" type="text" disabled value="{{ Auth::user()->fname }} ">
                        </div>
                        <div class="uk-width-1-2@s">
                            <input class="uk-input" type="text" disabled value=" {{ Auth::user()->lname }} ">
                        </div>
                        <div class="uk-width-1-1@s">
                            <input class="uk-input" type="text" disabled value=" {{ Auth::user()->email }} ">
                        </div>
                        <div class="uk-width-1-2@s">
                            <input class="uk-input" type="text" disabled value=" {{ Auth::user()->phonenumb }} ">
                        </div>
                        <div class="uk-width-1-2@s">
                            <input class="uk-input" type="text" disabled placeholder=" {{ Auth::user()->company }} ">
                        </div>
                        <div class="uk-width-1-2@s">
                            <select disabled class="uk-select" id="form-stacked-select">
                                <option value="">-- اختيار --</option>
                                @foreach ($jsondatas['countries'] as $item)

                                    <option value="{{ $item['code'] }}">{{ $item['name'] }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="uk-width-1-2@s">
                            <input class="uk-input" disabled type="text" value=" {{ Auth::user()->city }} ">
                        </div>


                        <div class="uk-width-1-1@s uk-text-right">
                            <p> <a href="u/setting"><span uk-icon="cog"></span> تعديل المعلومات</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
