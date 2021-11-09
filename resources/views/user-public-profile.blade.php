@extends('layout.master')
@section('title', "$data->frist_name $data->last_name")
@if ($data->description != '' && $data->description != null)
@section('description', "$data->description")
@endif

@section('content')
    <!-- Modal preview  -->




    <!-- Modal preview  -->
    <div class="bg-brand-h150"></div>
    <div class="container" id="app">
        <div class="row mx-auto user-head-pf" dir="rtl">
            <div class="col-auto ">
                <div class="position-relative" style="width: max-content">

                    @if ($data->isOnline($data->Account_number))
                        <span
                            class="position-absolute top-0 start-100 translate-middle p-2 bg-success online-status border border-light rounded-circle"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="متصل">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    @endif


                    <div class="avatar-user-large ">
                        @php
                            $avatar = $data->avatar;
                            if ($avatar == null || $avatar == '') {
                                $avatar_url = 'img/icons/avatar.png';
                            } else {
                                $avatar_url = $avatar;
                            }
                        @endphp
                        <img src="{{ asset($avatar_url) }}" alt="{{ $data->username }}">
                    </div>
                </div>
            </div>
            <div class="col mt-2">
                <h1 class="user-name">{{ ucfirst($data->frist_name) }} {{ ucfirst($data->last_name) }}
                    @if ($data->verified_account == 2)
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="حساب مقاول ذاتي تم التحقق منه"
                            class="verified-icon verified-2" dir="rtl"></span>
                    @endif
                    @if ($data->verified_account == 1)
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="حساب تم التحقق منه"
                            class="verified-icon verified-1" dir="rtl"></span>

                    @endif
                </h1>
                <br>
                <div class="row" style="    margin-top: -30px;">

                    <div class="col-auto">
                        <div class="user-info-box-article">
                            @if ($data->aeInfos != null && $data->aeInfos != '')
                                <i class="fas fa-briefcase"></i> {{ $data->aeInfos->job_title }}
                            @else
                                <i class="fas fa-briefcase"></i> حساب عميل

                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="user-info-box-article">
                            <i class="fas fa-map-marker-alt"></i> {{ $data->cityName }} , المغرب
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="user-info-box-article">

                            <span class="user-rating-stars" dir="rtl">
                                <vs-tooltip text="{{ intval($data->rating) }}">

                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < intval($data->rating))
                                            <i class="fas fa-star"></i>

                                        @else
                                            <i class="far fa-star"></i>

                                        @endif


                                    @endfor

                                </vs-tooltip>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto mt-2">
                @if (Auth::check() && $data->Account_number == Auth::user()->Account_number)
                    <a href="{{ asset('/account/settings') }}">
                        <button class="btn btn-primary btn-sm">تعديل الحساب</button>
                    </a>

                @else
                    <button class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i></button>
                    <span class="dropdown">
                        <button class="btn btn-outline-primary btn-sm" id="menu_user" data-toggle="dropdown"
                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                        <ul class="dropdown-menu" aria-labelledby="menu_user">
                            <li><a class="dropdown-item" href="#">مراسلة</a></li>
                            <li><a class="dropdown-item" href="#">التبليغ</a></li>
                        </ul>
                    </span>
                @endif
            </div>
        </div>

        <div class="row mx-auto mt-5 mb-5" dir="rtl">
            <div class="col-sm mb-4">
                <div class="card p-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">نبذة عني</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">معرض الأعمال</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">التقييمات</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-3 body-card-text" id="home" role="tabpanel"
                            aria-labelledby="home-tab">

                            <p>
                                @php 
                                if ($data->description != '' && $data->description != null) {
                                        echo $data->description;
                                    } else {
                                        echo 'لم يكتب النبذة الشخصية';
                                } @endphp
                            </p>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @if(Auth::check() && $data->Account_number == Auth::user()->Account_number)
                            <div class="action-tab-sc mt-3 mb-3" style="text-align: left">
                                <button class="btn btn-primary btn-sm ">اضافة عمل</button>
                            </div>
                            @endif
                   <portfolio-section :account_number="{{$data->Account_number}}"></portfolio-section>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <user-ratings-list :ac="{{ $data->Account_number }}"></user-ratings-list>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-3">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> معلومات</h1>
                    <div class="row mx-auto w-100 row-cols-2 " dir="rtl">
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"> نوع الحساب:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                @if ($data->type != 1 && $data->verified_account != 2)
                                    حساب عميل

                                @else
                                مقاول ذاتي
                                @endif
                            </span>
                        </div>

                        @if ($data->activite != null && $data->activite != '')
                            <div class="col mb-3" align="right">
                                <span class="card-info-title">القطاع, النشاط:</span>
                            </div>
                            <div class="col mb-3" align="right">
                                <span style="font-size: 13px" class="card-info-text">
                                    {{ $data->activite }}
                                </span>
                            </div>
                        @endif



                        <div class="col mb-3" align="right">
                            <span class="card-info-title"> تاريخ الانضمام:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                {{ date('Y-m-d', strtotime($data->created_at)) }}
                            </span>
                        </div>


                        <div class="col mb-3" align="right">
                            <span class="card-info-title"> الصفقات الناجحة:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                11
                            </span>
                        </div>
                        @if ($data->cityName != null && $data->cityName != '')

                            <div class="col mb-3" align="right">
                                <span class="card-info-title"> الدولة, المدينة:</span>
                            </div>
                            <div class="col mb-3" align="right">
                                <span class="card-info-text">
                                    المغرب, {{ $data->cityName }}
                                </span>
                            </div>

                        @endif
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"> التقييم:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                <span class="user-rating-stars" dir="rtl">
                                    <vs-tooltip text="{{ intval($data->rating) }}">

                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < intval($data->rating))
                                                <i class="fas fa-star"></i>

                                            @else
                                                <i class="far fa-star"></i>

                                            @endif


                                        @endfor

                                    </vs-tooltip>
                                </span>
                            </span>
                        </div>

                    </div>

                </div>

                <div class="card p-3 mt-4">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> أوسمة</h1>
                    <div class="alert alert-light text-center" role="alert">
                        لايوجد</div>

                </div>
            </div>
        </div>

    </div>




@stop
