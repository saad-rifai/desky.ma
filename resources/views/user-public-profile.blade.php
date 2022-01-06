@extends('layout.master')
@section('title', "$data->frist_name $data->last_name")
@if ($data->description != '' && $data->description != null)
    @section('description', "$data->description")
@endif

@section('content')
    <!-- Modal preview  -->
    <div class="modal fade" id="ShareProfile" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true" dir="rtl">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        مشاركة الملف الشخصي
                    </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="row row-cols-1 mx-auto" style="max-width: 550px">
                            <div class="col">
                                <div class="mb-3">
                                    <div class="position-relative">

                                        <input type="text" onclick="this.setSelectionRange(0, this.value.length)"
                                            style="cursor: pointer;" readonly="readonly" class="form-control text-center"
                                            name="" value="{{ asset('/@' . $data->username) }}">
                                        <span class="icon-input-btn">
                                            <i class="far fa-clone"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="footer-social-media mx-auto">
                                    <ul class="list-social-media">
                                        <li>
                                            <a target="_blank"
                                                href="https://www.facebook.com/sharer/sharer.php?u={{ asset('/@' . $data->username) }}"
                                                data-toggle="tooltip" data-placement="top" title="مشاركة على فيسبوك">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a target="_blank"
                                                href="http://twitter.com/share?text=حسابي على منصة ديسكي&url={{ asset('/@' . $data->username) }}&hashtags=deskymaroc,auto_entrepreneur&via=desky_ma"
                                                data-toggle="tooltip" data-placement="top" title="مشاركةعلى تويتر">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a target="_blank"
                                                href="https://www.linkedin.com/sharing/share-offsite/?url={{ asset('/@' . $data->username) }}"
                                                data-toggle="tooltip" data-placement="top" title="مشاركة على لينكد ان">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        اغلاق
                    </button>

                </div>
            </div>
        </div>
    </div>



    <!-- Modal preview  -->
    <div class="bg-brand-h150"></div>
    <div class="container" id="app">
        <div class="row mx-auto user-head-pf" dir="rtl">
            <div class="col-auto ">
                <div class="position-relative" style="width: max-content">

                    @if ($data->isOnline($data->Account_number))
                        <span
                            class="position-absolute top-0 start-100 translate-middle p-2 bg-success online-status online-status-lg  border border-light rounded-circle"
                            data-toggle="tooltip" data-placement="top" title="متصل">
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
                        <span data-toggle="tooltip" data-placement="top" title="حساب مقاول ذاتي تم التحقق منه"
                            class="verified-icon verified-2" dir="rtl"></span>
                    @endif
                    @if ($data->verified_account == 1)
                        <span data-toggle="tooltip" data-placement="top" title="حساب تم التحقق منه"
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
                    <button data-target="#ShareProfile" data-toggle="modal" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-share-alt"></i>
                    </button>

                @else
                    <report-popup about="0" from_url="{{ url()->current() }}" to="{{ $data->Account_number }}">
                    </report-popup>
                    @if ($data->verified_account == 2)

                        <new-message to="{{ $data->Account_number }}"></new-message>
                        <button class="btn btn-primary btn-sm" href="#NewMessageModal" type="button" data-toggle="modal"
                            data-target="#NewMessageModal"><i class="fas fa-envelope"></i></button>
                    @endif
                    <span class="dropdown">

                        <button class="btn btn-outline-primary btn-sm" id="menu_user" data-toggle="dropdown"
                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>

                        <ul class="dropdown-menu" aria-labelledby="menu_user">
                            @if ($data->verified_account == 2)
                                <li><a class="dropdown-item" href="#NewMessageModal" type="button"
                                        data-toggle="modal">مراسلة</a></li>

                            @endif
                            <li><a class="dropdown-item" type="button" href="#ShareProfile" data-toggle="modal">مشاركة
                                    الملف</a></li>
                            <li><a class="dropdown-item" data-toggle="modal" href="#reportModal"
                                    data-target="#reportModal">التبليغ</a></li>
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
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#portfolio"
                                type="button" role="tab" aria-controls="portfolio" aria-selected="false">معرض
                                الأعمال</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#rating"
                                type="button" role="tab" aria-controls="rating" aria-selected="false">التقييمات</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-3 body-card-text" id="home" role="tabpanel"
                            aria-labelledby="home-tab">

                            <p class="font-Naskh">
                                @php
                                    if ($data->description != '' && $data->description != null) {
                                        echo $data->description;
                                    } else {
                                        echo 'لم يكتب النبذة الشخصية';
                                } @endphp
                            </p>
                        </div>
                        <div class="tab-pane fade" id="portfolio" role="tabpanel" aria-labelledby="profile-tab">
                            @if (Auth::check() && $data->Account_number == Auth::user()->Account_number)
                                <div class="action-tab-sc mt-3 mb-3" style="text-align: left">
                                    <a href="{{ asset('portfolio/create/') }}">
                                        <button class="btn btn-primary btn-sm ">اضافة عمل</button>
                                    </a>
                                </div>
                            @endif
                            <portfolio-section :account_number="{{ $data->Account_number }}"></portfolio-section>
                        </div>
                        <div class="tab-pane fade" id="rating" role="tabpanel" aria-labelledby="contact-tab">
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

                                @switch($data->type)
                                    @case(1)
                                        حساب مقاول ذاتي
                                    @break
                                    @case(2)
                                        حساب عميل

                                    @break
                                    @default
                                        غير محدد
                                @endswitch
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
                                {{ $data->DealsDone }}
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
