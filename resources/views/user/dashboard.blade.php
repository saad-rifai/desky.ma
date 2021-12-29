@extends('layout.master')
@section('title', 'لوحة التحكم')
@section('content')


    <div class="container" id="app">

        <div class="head-dashboard mt-5 mb-3">
            <div class="row" dir="rtl">
                <div class="col">
                    <div class="row">
                        <div class="col-auto">
                            <div class="avatar-large-box-article">
                                <a href="{{ asset('/@' . Auth::user()->username) }}"> <img
                                        src="{{ asset(request()->Avatar) }}"
                                        alt="{{ Auth::user()->frist_name . ' ' . Auth::user()->last_name }} - avatar"></a>
                            </div>
                        </div>
                        <div class="col-auto mt-2">
                            <div class="user-name-box-article">
                                <span>مرحبا بك ! </span>
                                <br>
                                <a href="{{ asset('/@' . Auth::user()->username) }}">
                                    <h4>
                                        {{ ucfirst(Auth::user()->frist_name) . ' ' . ucfirst(Auth::user()->last_name) }}
                                    </h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto mt-4">
                    <p class="text-muted fs-6" data-toggle="tooltip" data-placement="bottom" title="رقم تعريف حسابك ">
                        N° <strong>{{ Auth::user()->Account_number }}</strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="body-dashboard">
            <div class="row mobile-flex-reverse" dir="rtl">

                <div class="col-sm col-lg-4 mb-3">
                    @if (Auth::user()->type == 1 && Auth::user()->verified_account == null && Auth::user()->AeAccount == null)

                        <div class="card p-3 mb-3 position-relative bg-brand">
                            <div class="row row-cols-1 mx-auto">
                                <div class="col position-relative text-center text-white mt-5 mb-5">

                                    <p class="card-title fs-6 mb-3 font-Naskh">حساب المقاول الذاتي الخاص بك غير مفعل بعد قدم
                                        طلب لتفعيله الأن</p>
                                    <a href="{{ asset('account/settings?ref=dashboard_card#ae_account') }}"><button
                                            class="btn btn-outline-primary btn-sm">تفعيل حساب المقاول الذاتي</button></a>


                                </div>
                            </div>

                        </div>
                    @endif

                    @if (Auth::user()->avatar == null || Auth::user()->description == null || (Auth::user()->type == 1 && Auth::user()->Portfolio->count() < 1))

                        <div class="card p-3 mb-3">
                            <div class="row row-cols-1">
                                <div class="col position-relative">
                                    <h1 class="card-title mb-1 mt-2 mx-auto" style="font-size: 16px"> تلميحات <i
                                            data-toggle="tooltip" data-placement="left"
                                            title="تلميحات لمساعدتك على اكمال حسابك" class="fas fa-info-circle"></i></h1>

                                </div>
                                <div class="col">

                                    <ul class="list-group list-group-flush">
                                        @if (Auth::user()->description == null)
                                            <li class="list-group-item"> <a href="{{ asset('/account/settings') }}"><i
                                                        class="far fa-circle"></i> قم باضافة النبذة التعريفية</a></li>

                                        @else
                                            <li class="list-group-item"> <del> <a href="#"><i
                                                            class="fas fa-check-circle "></i> قم باضافة النبذة
                                                        التعريفية</a></del></li>

                                        @endif
                                        @if (Auth::user()->avatar == null)
                                            <li class="list-group-item"> <a
                                                    href="{{ asset('/account/settings#account_settings') }}"><i
                                                        class="far fa-circle"></i>قم باضافة الصورة الشخصية</a></li>

                                        @else
                                            <li class="list-group-item"> <del> <a href="#"><i
                                                            class="fas fa-check-circle "></i> قم باضافة الصورة
                                                        الشخصية</a></del></li>

                                        @endif
                                        @if (Auth::user()->type == 1)


                                            @if (Auth::user()->Portfolio->count() < 1)
                                                <li class="list-group-item"> <a
                                                        href="{{ asset('/@' . Auth::user()->username . '#portfolio') }}"><i
                                                            class="far fa-circle"></i> قم باضافة أعمال الى معرض أعمالك</a>
                                                </li>

                                            @else
                                                <li class="list-group-item"> <del> <a href="#"><i
                                                                class="fas fa-check-circle "></i> قم باضافة أعمال الى معرض
                                                            أعمالك</a></del></li>

                                            @endif
                                        @endif
                                    </ul>
                                </div>
                            </div>

                        </div>
                    @endif
                    <div class="card p-3 mb-3">
                        <div class="row row-cols-1">
                            <div class="col position-relative">
                                <a href="{{ asset('/messages?ref=dashboard') }}">
                                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> الرسائل</h1>
                                </a>
                                <a href="{{ asset('/messages?ref=dashboard') }}"
                                    class="card-link position-absolute top-0 end-0 mt-1 me-3">
                                    المزيد
                                </a>
                            </div>
                            <div class="col">
                                <last-messages-box :max="5" account_number="{{ Auth::user()->Account_number }}">
                                </last-messages-box>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-sm">
                    <div class="card p-3 mb-4">
                        <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> نظرة عامة</h1>
                        <a href="/MyOrders">
                            <div class="card pt-5 pb-5 ps-2 pe-4 mb-4">
                                <div class="row align-middle">
                                    <div class="col-sm col-lg-3 text-center">
                                        <div class="pg-info-head mt-4 mb-4">
                                            <h3 class="pg-info-title">
                                                طلباتي
                                            </h3>
                                            <h3 class="pg-info-number">
                                                {{ $OrdersNumber }}
                                            </h3>
                                            <a href="/new/order?ref=dashboard"><button
                                                    class="btn btn-primary btn-sm btn-sm mb-3">اضافة طلب</button></a>
                                        </div>
                                    </div>
                                    <div class="col-sm mt-3">
                                        <div class="pg-box mb-3">
                                            <label class="form-label">{{ $OrdersPending }} قيد المراجعة</label>
                                            <span class="pg-percentage">{{ $OrdersPendingPer }}%</span>

                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-secondary" role="progressbar"
                                                    style="width: {{ $OrdersPendingPer }}%;"
                                                    aria-valuenow="{{ $OrdersPendingPer }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="pg-box mb-3">
                                            <label class="form-label">{{ $OrdersOpen }} المفتوحة</label>
                                            <span class="pg-percentage">{{ $OrdersOpenPer }}%</span>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $OrdersOpenPer }}%;"
                                                    aria-valuenow="{{ $OrdersOpenPer }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="pg-box mb-3">
                                            <label class="form-label">{{ $OrdersRejected }} المرفوضة</label>
                                            <span class="pg-percentage">{{ $OrdersRejectedPer }}%</span>

                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: {{ $OrdersRejectedPer }}%;"
                                                    aria-valuenow="{{ $OrdersRejectedPer }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm mt-3">
                                        <div class="pg-box mb-3">
                                            <label class="form-label">{{ $OrdersClosed }} المغلقة</label>
                                            <span class="pg-percentage">{{ $OrdersClosedPer }}%</span>

                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-secondary" role="progressbar"
                                                    style="width: {{ $OrdersClosedPer }}%;"
                                                    aria-valuenow="{{ $OrdersClosedPer }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="pg-box mb-3">
                                            <label class="form-label">{{ $OrdersDone }} المكتملة</label>
                                            <span class="pg-percentage">{{ $OrdersDonePer }}%</span>

                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $OrdersDonePer }}%;"
                                                    aria-valuenow="{{ $OrdersDonePer }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="pg-box mb-3">
                                            <label class="form-label">{{ $OrdersImplementationPhase }} قيد
                                                التنفيذ</label>
                                            <span class="pg-percentage">{{ $OrdersImplementationPhasePer }}%</span>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: {{ $OrdersImplementationPhasePer }}%;"
                                                    aria-valuenow="{{ $OrdersImplementationPhasePer }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="/MyOffers">

                            <div class="card pt-5 pb-5 ps-2 pe-4 mb-4">
                                <div class="row align-middle">
                                    <div class="col-sm col-lg-3 text-center">
                                        <div class="pg-info-head mt-4 mb-4">
                                            <h3 class="pg-info-title">
                                                عروضي
                                            </h3>
                                            <h3 class="pg-info-number">
                                                {{ $OffersNumber }}
                                            </h3>
                                            <a href="/MyOffers?ref=dashboard"><button
                                                    class="btn btn-primary btn-sm btn-sm mb-3"> مشاهدة عروضي</button></a>

                                        </div>
                                    </div>
                                    <div class="col-sm mt-3">
                                        <div class="pg-box mb-3">
                                            <label class="form-label">{{ $OffersPending }} بانتظار الموافقة</label>
                                            <span class="pg-percentage">{{ $OffersPendingPer }}%</span>

                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-secondary" role="progressbar"
                                                    style="width: {{ $OffersPendingPer }}%;"
                                                    aria-valuenow="{{ $OffersPendingPer }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                        <div class="pg-box mb-3">
                                            <label class="form-label">{{ $OffersOpen }} قيد التنفيذ</label>
                                            <span class="pg-percentage">{{ $OffersOpenPer }}%</span>

                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: {{ $OffersOpenPer }}%;"
                                                    aria-valuenow="{{ $OffersOpenPer }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm mt-3">
                                        <div class="pg-box mb-3">
                                            <label class="form-label">{{ $OffersDone }} المكتملة</label>
                                            <span class="pg-percentage">{{ $OffersDonePer }}%</span>

                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $OffersDonePer }}%;"
                                                    aria-valuenow="{{ $OffersDonePer }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="pg-box mb-3">
                                            <label class="form-label">{{ $OrdersCancelled }} الملغاة</label>
                                            <span class="pg-percentage">{{ $OffersCancelledPer }}%</span>

                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: {{ $OffersCancelledPer }}%;"
                                                    aria-valuenow="{{ $OffersCancelledPer }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>



                    <div class="box-left mb-5 card p-4">
                        <div class="row row-cols-1">
                            <div class="col position-relative">
                                <a href="{{ asset('orders?ref=dashboard') }}">
                                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> أحدث طلبات العروض</h1>
                                </a>
                                <a href="{{ asset('orders?ref=dashboard') }}"
                                    class="card-link position-absolute top-0 end-0 mt-1 me-3">
                                    المزيد
                                </a>
                            </div>
                            <div class="col position-relative">
                                <last-orders-box></last-orders-box>
                            </div>
                        </div>



                    </div>


                </div>
            </div>
        </div>

    </div>

@stop
