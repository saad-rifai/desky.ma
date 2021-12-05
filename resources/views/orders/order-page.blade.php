@extends('layout.master')
@section('title', $data->title)
@section('description', $data->description)

@section('content')



    <div class="container mt-5 mb-5">
        <div class="row text-center" dir="rtl">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلبات العروض</li>
                    </ol>
                </nav>
                <h1 align="right" class="breadcrumb-title">{{ $data->title }}</h1>
            </div>
            @if($data->orderCreator)
            <div class="col-sm-auto mt-3" align="right">
               <a href="{{asset("/myorder/$data->OID")}}"> <button class="btn btn-primary btn-sm">ادارة الطلب</button></a>
            </div>
            @endif
        </div>
    </div>

    <div id="app" class="container mb-5 mt-2">
        
        <div class="row" dir="rtl" align="right">
            <div class="col-lg-8">
                @auth
                    @switch($data->status)
                        @case(0)
                            <div class="alert alert-warning" role="alert">
                                طلب قيد المراجعة حاليا, ستتوصل باشعار عند الانتهاء من معالجة طلبك.
                            </div>
                        @break
                        @case(4)
                            <div class="alert alert-warning" role="alert">
                                طلب العروض هذا مغلق لانتهاء مدة نشره. مازال بإمكانك مراجعة العروض المقدمة والتواصل مع المقاوليين.

                            </div>
                        @break
                        @case(5)
                            <div class="alert alert-warning" role="alert">
                                {{ $data->message }}
                            </div>
                        @break
                        @default

                    @endswitch
                @endauth

            </div>
        </div>
        <div class="row justify-content-md-center" dir="rtl">
            <div class="col-sm ">
                <div class="box-left  card p-4 mb-4 mbl-show">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> بطاقة الطلب</h1>
                    <div class="row mx-auto w-100 row-cols-2 " dir="rtl">
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-info-circle"></i> حالة الطلب:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                @switch($data->status)
                                    @case(0)
                                        <span class="badge rounded-pill bg-warning order-status">قيد المراجعة</span>
                                    @break
                                    @case(1)
                                        <span class="badge rounded-pill bg-success order-status">مفتوح</span>
                                    @break
                                    @case(2)
                                        <span class="badge rounded-pill bg-primary order-status"> مرحلة التنفيذ</span>
                                    @break
                                    @case(3)
                                        <span class="badge rounded-pill bg-success order-status">تم الانجاز</span>
                                    @break
                                    @case(4)
                                        <span class="badge rounded-pill bg-danger order-status"> مغلق</span>
                                    @break
                                    @case(5)
                                        <span class="badge rounded-pill bg-danger order-status"> مرفوض</span>
                                    @break
                                    @default

                                @endswitch
                            </span>
                        </div>

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="far fa-clock"></i> تاريخ النشر:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                {{ date('Y-m-d', strtotime($data->created_at)) }}
                            </span>
                        </div>

                        @if ($data->activite != null && $data->activite != '')
                            <div class="col mb-3" align="right">
                                <span class="card-info-title">القطاع, النشاط:</span>
                            </div>
                            <div class="col mb-3" align="right">
                                <span style="font-size: 13px" class="card-info-text">
                                    {{ $data->sector }}, {{ $data->activite }}
                                </span>
                            </div>
                        @endif

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-dollar-sign"></i> الميزانية:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                {{ $data->budget }} MAD
                            </span>
                        </div>


                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-stopwatch"></i> مدة التنفيذ:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                {{ $data->time }}
                            </span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-ticket-alt"></i> عدد العروض:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                عرضان
                            </span>
                        </div>
                        @if ($data->place != null && $data->place != '')

                            <div class="col mb-3" align="right">
                                <span class="card-info-title"><i class="fas fa-map-marker-alt"></i> المدينة:</span>
                            </div>
                            <div class="col mb-3" align="right">
                                <span class="card-info-text">
                                    {{ $data->place }}
                                </span>




                            </div>

                        @endif

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-globe-africa"></i> يمكن الانجاز عن بعد:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                @if ($data->place == null && $data->place == '')
                                    <i class="fas fa-check"></i> نعم
                                @else
                                    <i class="fas fa-times"></i> لا
                                @endif
                            </span>




                        </div>
                    </div>


                </div>

                <div class="box-left mbl-show  mb-4 card p-4 mt-4">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> صاحب الطلب</h1>
                    <a href="{{ asset('/@' . $data->user->username) }}">

                        <div class="box-article pb-3 mb-3">
                            <div class="head-box-article">
                                <div class="row text-center">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar-large-box-article">
                                                    @php
                                                        $avatar = $data->user->avatar;
                                                        if ($avatar == null || $avatar == '') {
                                                            $avatar_url = 'img/icons/avatar.png';
                                                        } else {
                                                            $avatar_url = $avatar;
                                                        }
                                                    @endphp
                                                    <img src="{{ asset($avatar_url) }}"
                                                        alt="{{ $data->user->username }}">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="user-name-box-article">
                                                    <h4 class="user-name">
                                                        {{ ucfirst($data->user->frist_name) }}
                                                        {{ ucfirst($data->user->last_name) }}
                                                        @if ($data->user->verified_account == 2)
                                                            <span style="    margin: 0 !important;" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="حساب مقاول ذاتي تم التحقق منه"
                                                                class="verified-icon verified-2" dir="rtl"></span>
                                                        @endif
                                                        @if ($data->user->verified_account == 1)
                                                            <span style="    margin: 0 !important;" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="حساب تم التحقق منه"
                                                                class="verified-icon verified-1" dir="rtl"></span>

                                                        @endif
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mr-65 mmt-35">
                                    @if ($data->user->AeAccount->job_title)


                                        <div class="col-auto">
                                            <div class="user-info-box-article">
                                                <div class="row">

                                                    <div class="col-auto">
                                                        <div class="user-info-box-article">
                                                            <i class="fas fa-briefcase"></i>
                                                            {{ $data->user->AeAccount->job_title }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-auto">
                                        <div class="user-info-box-article">
                                            <i class="fas fa-map-marker-alt"></i> {{ $data->userCity }}, المغرب
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>

  
                <div class="card p-4 mb-4">
                    <div class="head-card position-relative">
                        @switch($data->status)
                            @case(0)
                                <span
                                    class="badge rounded-pill bg-warning order-status position-absolute top-50 end-0 translate-middle-y">قيد
                                    المراجعة</span>
                            @break
                            @case(1)
                                <span
                                    class="badge rounded-pill bg-success order-status position-absolute top-50 end-0 translate-middle-y">مفتوح</span>
                            @break
                            @case(2)
                                <span
                                    class="badge rounded-pill bg-primary order-status position-absolute top-50 end-0 translate-middle-y">
                                    مرحلة التنفيذ</span>
                            @break
                            @case(3)
                                <span
                                    class="badge rounded-pill bg-success order-status position-absolute top-50 end-0 translate-middle-y">تم
                                    الانجاز</span>
                            @break
                            @case(4)
                                <span
                                    class="badge rounded-pill bg-danger order-status position-absolute top-50 end-0 translate-middle-y">
                                    مغلق</span>
                            @break
                            @case(5)
                                <span
                                    class="badge rounded-pill bg-danger order-status position-absolute top-50 end-0 translate-middle-y">
                                    مرفوض</span>
                            @break
                            @default

                        @endswitch
                        <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> وصف الطلب</h1>
                    </div>
                    <div class="body-card-text">
                        <p class="font-Naskh text-wrap-line">
                            {{ $data->description }}
                        </p>
                    </div>

                </div>
                @if(isset($data->keywords) && $data->keywords != null)
                <div class="card p-4 mb-4">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> الكلمات المفتاحية</h1>
                    <div class="keywords-wraper" dir="rtl" align="right">
                        @foreach($data->keywords as $keyword)
                        <vs-chip>{{$keyword}}<vs-avatar icon="tag"/></vs-chip>
                        @endforeach
                    </div>
                </div>
                @endif
                @if ($data->files && count($data->files) > 0)
                    <div class="card p-4 mb-4">
                        <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> ملفات مرفقة</h1>

                        <div>
                            <ul class="list-group list-group-flush">

                                @foreach ($data->files as $item)
                                    @php
                                        $infoPath = pathinfo(public_path($item));
                                        $extension = $infoPath['extension'];
                                    @endphp

                                    <li class="list-group-item d-flex justify-content-between align-items-center"> <a
                                            href="{{ asset($item) }}" class="text-truncate text-primary"
                                            style="width: 100% !important;max-width: 200px!important;display: block;">
                                            {{ $item }}</a>
                                        <span class="badge bg-primary rounded-pill">{{ $extension }}</span>

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif


                @auth
              
                @switch($data->AllowedToAddOffer)
                    @case(true)
                    <div class="card p-4 mb-4">
                        <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> أضف عرضك</h1>
                        <add-offer :oid="'{{ $data->OID }}'"></add-offer>

                    </div>
                        @break
                    @case(false)
                        @if($data->orderCreator == false && Auth::user()->verified_account != 2)
                        <div class="card p-4 mb-4">
                            <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> أضف عرضك</h1>
                            <p class="text-center font-Naskh">لايمكنك اضافة عرض لأنك لاتمتلك {{$data->orderCreator}} <a href="{{asset("/account/settings#ae_account")}}">حساب مقاول ذاتي</a></p>
                        </div>

                        @endif
                        @break
                    @default
                        
                @endswitch

                @else
                    <div class="card p-4 mb-4">
                        <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> أضف عرضك</h1>
                        <div class=" gap-2 d-md-block text-center">

                            <a href="{{ asset('login?redirect=' . url()->current()) }}">
                                <button type="button" class="btn btn-outline-primary ">الدخول</button>
                            </a>
                            <a href="{{ asset('register?redirect=' . url()->current()) }}">
                                <button type="button" class="btn btn-primary">انشاء حساب</button>
                            </a>
                        </div>
                    </div>
                @endauth
                <offers-list oid="{{ $data->OID }}" status="{{$data->status}}" from_url="{{url()->current()}}" offerget="@if (isset($_GET['offer'])){{ $_GET['offer'] }}@endif"  offerget2="@if (isset($_GET['offer2'])){{ $_GET['offer2'] }}@endif"></offers-list>
            </div>
            <div class="col-sm col-lg-4 ">
                <div class="box-left  card p-4 mbl-hide">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> بطاقة الطلب</h1>

                    <div class="row mx-auto w-100 row-cols-2 " dir="rtl">
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-info-circle"></i> حالة الطلب:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                @switch($data->status)
                                    @case(0)
                                        <span class="badge rounded-pill bg-warning order-status">قيد المراجعة</span>
                                    @break
                                    @case(1)
                                        <span class="badge rounded-pill bg-success order-status">مفتوح</span>
                                    @break
                                    @case(2)
                                        <span class="badge rounded-pill bg-primary order-status"> مرحلة التنفيذ</span>
                                    @break
                                    @case(3)
                                        <span class="badge rounded-pill bg-success order-status">تم الانجاز</span>
                                    @break
                                    @case(4)
                                        <span class="badge rounded-pill bg-danger order-status"> مغلق</span>
                                    @break
                                    @case(5)
                                        <span class="badge rounded-pill bg-danger order-status"> مرفوض</span>
                                    @break
                                    @default

                                @endswitch
                            </span>
                        </div>

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="far fa-clock"></i> تاريخ النشر:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                {{ date('Y-m-d', strtotime($data->created_at)) }}
                            </span>
                        </div>

                        @if ($data->activite != null && $data->activite != '')
                            <div class="col mb-3" align="right">
                                <span class="card-info-title">القطاع, النشاط:</span>
                            </div>
                            <div class="col mb-3" align="right">
                                <span style="font-size: 13px" class="card-info-text">
                                    {{ $data->sector }}, {{ $data->activite }}
                                </span>
                            </div>
                        @endif

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-dollar-sign"></i> الميزانية:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                {{ $data->budget }} MAD
                            </span>
                        </div>


                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-stopwatch"></i> مدة التنفيذ:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                {{ $data->time }}
                            </span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-ticket-alt"></i> عدد العروض:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                عرضان
                            </span>
                        </div>
                        @if ($data->place != null && $data->place != '')

                            <div class="col mb-3" align="right">
                                <span class="card-info-title"><i class="fas fa-map-marker-alt"></i> المدينة:</span>
                            </div>
                            <div class="col mb-3" align="right">
                                <span class="card-info-text">
                                    {{ $data->place }}
                                </span>




                            </div>

                        @endif

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-globe-africa"></i> يمكن الانجاز عن بعد:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                @if ($data->place == null && $data->place == '')
                                    <i class="fas fa-check"></i> نعم
                                @else
                                    <i class="fas fa-times"></i> لا
                                @endif
                            </span>




                        </div>
                    </div>


                </div>
                <div class="box-left mbl-hide  card p-4 mt-4">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> صاحب الطلب</h1>
                    <a href="{{ asset('/@' . $data->user->username) }}">

                        <div class="box-article pb-3 mb-3">
                            <div class="head-box-article">
                                <div class="row text-center">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar-large-box-article">
                                                    @php
                                                        $avatar = $data->user->avatar;
                                                        if ($avatar == null || $avatar == '') {
                                                            $avatar_url = 'img/icons/avatar.png';
                                                        } else {
                                                            $avatar_url = $avatar;
                                                        }
                                                    @endphp
                                                    <img src="{{ asset($avatar_url) }}"
                                                        alt="{{ $data->user->username }}">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="user-name-box-article">
                                                    <h4 class="user-name">
                                                        {{ ucfirst($data->user->frist_name) }}
                                                        {{ ucfirst($data->user->last_name) }}
                                                        @if ($data->user->verified_account == 2)
                                                            <span style="    margin: 0 !important;" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="حساب مقاول ذاتي تم التحقق منه"
                                                                class="verified-icon verified-2" dir="rtl"></span>
                                                        @endif
                                                        @if ($data->user->verified_account == 1)
                                                            <span style="    margin: 0 !important;" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="حساب تم التحقق منه"
                                                                class="verified-icon verified-1" dir="rtl"></span>

                                                        @endif
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mr-65 mmt-35">
                                    @if ($data->user->AeAccount->job_title)


                                        <div class="col-auto">
                                            <div class="user-info-box-article">
                                                <div class="row">

                                                    <div class="col-auto">
                                                        <div class="user-info-box-article">
                                                            <i class="fas fa-briefcase"></i>
                                                            {{ $data->user->AeAccount->job_title }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-auto">
                                        <div class="user-info-box-article">
                                            <i class="fas fa-map-marker-alt"></i> {{ $data->userCity }}, المغرب
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="box-left  card p-4 mt-4">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> شارك الطلب</h1>
                    <div class="mt-2">
                        <input type="text" onclick="this.setSelectionRange(0, this.value.length)" style="cursor: pointer;"
                            readonly="readonly" class="form-control text-center" name=""
                            value="{{ asset('order/' . $data->OID) }}" id="">
                        <div class="footer-social-media mx-auto">
                            <ul class="list-social-media">
                                <li>
                                    <a target="_blank"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ asset('order/' . $data->OID) }}">
                                        <i class="fab fa-facebook-square"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank"
                                        href="http://twitter.com/share?text={{ $data->title }}&url={{ asset('order/' . $data->OID) }}&hashtags=deskymaroc,auto_entrepreneur&via=desky_ma">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank"
                                        href="https://www.linkedin.com/sharing/share-offsite/?url={{ asset('order/' . $data->OID) }}">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
