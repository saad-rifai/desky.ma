@extends('layout.master')
@section('title', $data->title)
@section('description', $data->description)
<link href="{{ asset('css/chat/chat-style.css') }}" rel="stylesheet">

@section('content')
    <div id="app">
        <div class="container mt-5 mb-5">
            <div class="row text-center" dir="rtl">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ادارة طلباتي</li>
                        </ol>
                    </nav>
                    <h1 align="right" class="breadcrumb-title">{{ $data->title }}</h1>
                </div>
                <div class="col-sm-auto mt-3" align="right">

                    <manage-order-menu from_url="{{ url()->current() }}" :oid="{{ $data->OID }}"></manage-order-menu>
                </div>

            </div>
        </div>
        <div class="container mb-5 mt-2">
            <div class="row justify-content-md-center" dir="rtl">
                <div class="col-sm ">

                    <div class="card  mb-4">
                        <div class="head-card position-relative">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="details-tab" data-bs-toggle="tab"
                                        data-bs-target="#details" type="button" role="tab" aria-controls="details"
                                        aria-selected="true">التفاصيل</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="auto-entrepreneur-tab" data-bs-toggle="tab"
                                        data-bs-target="#auto-entrepreneur" type="button" role="tab"
                                        aria-controls="auto-entrepreneur" aria-selected="false">المقاولين</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="messages-tab" data-bs-toggle="tab"
                                        data-bs-target="#messages" type="button" role="tab" aria-controls="messages"
                                        aria-selected="false">الرسائل</button>
                                </li>
                            </ul>
                        </div>
                        <div class="body-card-text">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane p-4 fade show active" id="details" role="tabpanel"
                                    aria-labelledby="details-tab">
                                    <p class="font-Naskh text-wrap-line">
                                        {{ $data->description }}
                                    </p>
                                    @if ($data->files && count($data->files) > 0)
                                        <div class=" mt-5 mb-4">
                                            <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> ملفات مرفقة</h1>

                                            <div>
                                                <ul class="list-group list-group-flush">

                                                    @foreach ($data->files as $item)
                                                    @php
                                                        $infoPath = pathinfo(public_path($item['file_url']));
                                                        $extension = $infoPath['extension'];
                                                    @endphp
                
                                                    <li class="list-group-item d-flex justify-content-between align-items-center"> 
                                                        <a href="{{ asset($item['file_url']) }}" class="text-truncate text-primary" style="width: 100% !important;max-width: 200px!important;display: block;">{{ $item['filename'] }}</a>
                                                        <span class="badge bg-primary rounded-pill">{{ $extension }}</span>
                
                                                    </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade  p-3 position-relative" id="auto-entrepreneur" role="tabpanel"
                                    aria-labelledby="auto-entrepreneur">
                                    <hired-list :oid="{{ $data->OID }}"></hired-list>

                                </div>
                                <div class="tab-pane  fade position-relative" id="messages" role="tabpanel"
                                    aria-labelledby="messages-tab">
                                    <!-- Chat Box -->
                                    <form-order-chat :oid="{{ $data->OID }}"></form-order-chat>
                                    <!-- Chat Box -->


                                </div>
                            </div>

                        </div>
                    </div>
                    @if (isset($data->keywords) && $data->keywords != null)
                        <div class="card p-4 mb-4">
                            <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> الكلمات المفتاحية</h1>
                            <div class="keywords-wraper" dir="rtl" align="right">
                                @foreach ($data->keywords as $keyword)
                                    <vs-chip>{{ $keyword }}
                                        <vs-avatar icon="tag" />
                                    </vs-chip>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
                <div class="col-sm col-lg-4 ">
                    <div class="box-left  card p-4">
                        <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> بطاقة الطلب</h1>

                        <div class="row mx-auto w-100 row-cols-2 " dir="rtl">
                            <div class="col mb-3" align="right">
                                <span class="card-info-title"><i class="fas fa-info-circle"></i> حالة الطلب:</span>
                            </div>
                            <div class="col mb-3" align="right">
                                <span class="card-info-text" id="order_status" style="margin-top: 20px !important;
                                position: relative;
                                display: block;">
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
                                <span class="card-info-title"><i class="fas fa-globe-africa"></i> يمكن الانجاز عن
                                    بعد:</span>
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


                </div>
            </div>
        </div>
    </div>

@stop
<script src="{{ asset('js/library/p5.min.js') }}"></script>
<script src="{{ asset('js/library/audio-record.js') }}"></script>
