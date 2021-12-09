@extends('layout.master')
@section('title', "$data->title")
@if ($data->description != '' && $data->description != null)
    @section('description', "$data->description")
@endif
@section('content')
    @php
    $filesArray = json_decode($data->files, true);

    @endphp
    <div id="app">
    <div class="container mt-5 mb-5">
        <div class="row text-center" dir="rtl">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ asset('/@'.$data->user->username) }}">{{ $data->user->username }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> معرض الأعمال</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-sm">
                        <h1 align="right" class="breadcrumb-title mb-3">{{ $data->title }}</h1>
                    </div>
                    <div class="col-auto">
                        @if (Auth::check() && $data->Account_number == Auth::user()->Account_number)
                      
                            <delete-portfolio :portfolio_id="{{$data->id}}" :username="'{{$data->user->username}}'"></delete-portfolio>
                            @else
                            <report-popup
                            about="3"
                            from_url="{{url()->current()}}"
            
                        ></report-popup>
                            <span class="dropdown ">
                                <button class="btn btn-outline-primary btn-sm" id="menu_user" data-toggle="dropdown"
                                    aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                <ul class="dropdown-menu" aria-labelledby="menu_user">
                                    <li><a class="dropdown-item" type="button" data-toggle="modal" data-target="#reportModal">التبليغ</a></li>
                                </ul>
                            </span>

                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Body -->
    <div class="container mb-5 mt-2">

        <div class="row justify-content-md-center" dir="rtl">
            <div class="col-sm ">
                <div class="box-left  card p-4 mb-4 mbl-show">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> بطاقة العمل</h1>

                    <div class="row mx-auto w-100 row-cols-2 " dir="rtl">

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="far fa-clock"></i> تاريخ النشر:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                {{ date('Y-m-d', strtotime($data->created_at)) }}
                            </span>
                        </div>

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-briefcase"></i> القطاع, النشاط:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                {{ $data->sector }}, {{ $data->activite }}
                            </span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="far fa-thumbs-up"></i> عدد الاعجابات :</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                             {{$data->likes_number}}
                            </span>
                        </div>
                     </div>
                </div>
                <div class="box-left mbl-show  mb-4 card p-4 mt-4">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> صاحب العمل</h1>
                  <a href="{{asset('/@'.$data->user->username)}}">
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
                                                <img src="{{ asset($avatar_url) }}" alt="{{ $data->user->username }}">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="user-name-box-article">
                                                <h4 class="user-name">
                                                    {{ ucfirst($data->user->frist_name) }}
                                                    {{ ucfirst($data->user->last_name) }}
                                                    @if ($data->user->verified_account == 2)
                                                        <span style="    margin: 0 !important;" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="حساب مقاول ذاتي تم التحقق منه"
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
                                @if ($data->job_title)
                                    <div class="col-auto">
                                        <div class="user-info-box-article">
                                            <div class="row">

                                                <div class="col-auto">
                                                    <div class="user-info-box-article">
                                                        <i class="fas fa-briefcase"></i> {{ $data->job_title }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif

                                <div class="col-auto">
                                    <div class="user-info-box-article">
                                        <i class="fas fa-map-marker-alt"></i> {{ $data->city }}, المغرب
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                  </a>
                </div>
                <div class="card p-4 mb-4">
                    <div class="head-card position-relative">
          
                        <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> تفاصيل العمل
                        </h1>
                   
                    </div>
                    <div class="body-card-text">
                        <div class="Image-gallery">
                            <div class="row">
                                <div class="col">
                                    <div id="custCarousel" class="carousel carousel-dark slide" data-ride="carousel"
                                        align="center">
                                        <!-- slides -->
                                        <div class="carousel-inner">
                                            @php
                                                $a = 'active';
                                            @endphp
                                            @foreach ($filesArray as $item)
                                                <div class="carousel-item {{ $a }}"> <img
                                                        src="{{ asset($item) }}" alt="{{ $data->title }}"> </div>
                                                @php
                                                    $a = '';
                                                @endphp
                                            @endforeach

                                        </div> <!-- Left right --> <a class="carousel-control-prev" href="#custCarousel"
                                            data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a
                                            class="carousel-control-next" href="#custCarousel" data-slide="next"> <span
                                                class="carousel-control-next-icon"></span> </a> <!-- Thumbnails -->
                                        <ol class="carousel-indicators list-inline">
                                            @php
                                                $i = 0;
                                                $a = 'active';
                                            @endphp
                                            @foreach ($filesArray as $item)

                                                <li class="list-inline-item {{ $a }}"> <a
                                                        id="carousel-selector-{{ $i }}" class="selected"
                                                        data-slide-to="{{ $i }}" data-target="#custCarousel">
                                                        <img src="{{ asset($item) }}" class="img-fluid"> </a> </li>
                                                @php
                                                    $i++;
                                                    $a = '';
                                                @endphp
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Images ENd -->
                  
                        <div class="position-relative" >
                            <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> الوصف
                            </h1>
                            <div class="position-absolute top-0 end-0">
                                <like-portfolio :portfolio_id="{{$data->id}}"></like-portfolio>
                            </div>
                        </div>
                        <p>
                       {{$data->description}}
                        </p>
                    </div>

                </div>
            </div>
            <div class="col-sm col-lg-4 ">
                <div class="box-left  card p-4 mbl-hide">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> بطاقة العمل</h1>

                    <div class="row mx-auto w-100 row-cols-2 " dir="rtl">

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="far fa-clock"></i> تاريخ النشر:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                {{ date('Y-m-d', strtotime($data->created_at)) }}
                            </span>
                        </div>

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-briefcase"></i> القطاع, النشاط:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                {{ $data->sector }}, {{ $data->activite }}
                            </span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="far fa-thumbs-up"></i> عدد الاعجابات :</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                             {{$data->likes_number}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="box-left mbl-hide  card p-4 mt-4">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> صاحب العمل</h1>
                    <a href="{{asset('/@'.$data->user->username)}}">
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
                                                    <img src="{{ asset($avatar_url) }}" alt="{{ $data->user->username }}">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="user-name-box-article">
                                                    <h4 class="user-name">
                                                        {{ ucfirst($data->user->frist_name) }}
                                                        {{ ucfirst($data->user->last_name) }}
                                                        @if ($data->user->verified_account == 2)
                                                            <span style="    margin: 0 !important;" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="حساب مقاول ذاتي تم التحقق منه"
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
                                    @if ($data->job_title)
                                        <div class="col-auto">
                                            <div class="user-info-box-article">
                                                <div class="row">
    
                                                    <div class="col-auto">
                                                        <div class="user-info-box-article">
                                                            <i class="fas fa-briefcase"></i> {{ $data->job_title }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                    @endif
    
                                    <div class="col-auto">
                                        <div class="user-info-box-article">
                                            <i class="fas fa-map-marker-alt"></i> {{ $data->city }}, المغرب
                                        </div>
                                    </div>
    
                                </div>
                            </div>
                        </div>
                      </a>

                </div>
                <div class="box-left  card p-4 mt-4">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> شارك العمل</h1>
                    <div class="mt-2">
                        <input type="text" onclick="this.setSelectionRange(0, this.value.length)" style="cursor: pointer;"
                            readonly="readonly" class="form-control text-center" name=""
                            value="{{ asset('portfolio/' . $data->id) }}" id="">
                        <div class="footer-social-media mx-auto">
                            <ul class="list-social-media">
                                <li>
                                    <a target="_blank"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ asset('portfolio/' . $data->id) }}">
                                        <i class="fab fa-facebook-square"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank"
                                        href="http://twitter.com/share?text={{ $data->title }}&url={{ asset('portfolio/' . $data->id) }}&hashtags=deskymaroc,auto_entrepreneur&via=desky_ma">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank"
                                        href="https://www.linkedin.com/sharing/share-offsite/?url={{ asset('portfolio/' . $data->id) }}">
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
</div>
@stop
