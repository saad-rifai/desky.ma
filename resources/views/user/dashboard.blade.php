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
                            <img src="{{ asset(request()->Avatar) }}" alt="{{Auth::user()->frist_name .' '. Auth::user()->last_name}} - avatar">
                        </div>
                    </div>
                    <div class="col-auto mt-2">
                        <div class="user-name-box-article">
                            <span>مرحبا بك ! </span>
                            <br>
                            <h4>
                               {{ucfirst(Auth::user()->frist_name) .' '. ucfirst(Auth::user()->last_name)}}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto mt-4">
                <p class="text-muted fs-6">
              N°  <strong>{{Auth::user()->Account_number}}</strong>
                  </p>
            </div>
        </div>
    </div>

    <div class="body-dashboard">
        <div class="row" dir="rtl">
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
                                    {{$OrdersNumber}}
                                </h3>
                                <a href="/new/order?ref=dashboard"><button class="btn btn-primary btn-sm btn-sm mb-3">اضافة طلب</button></a>
                              </div>
                            </div>
                            <div class="col-sm mt-3">
                                <div class="pg-box mb-3">
                                    <label class="form-label">{{$OrdersPending}} قيد المراجعة</label>
                                    <span class="pg-percentage">{{$OrdersPendingPer}}%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: {{$OrdersPendingPer}}%;" aria-valuenow="{{$OrdersPendingPer}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="pg-box mb-3">
                                    <label class="form-label">{{$OrdersOpen}} المفتوحة</label>
                                    <span class="pg-percentage">{{$OrdersOpenPer}}%</span>
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar" role="progressbar" style="width: {{$OrdersOpenPer}}%;" aria-valuenow="{{$OrdersOpenPer}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="pg-box mb-3">
                                    <label class="form-label">{{$OrdersRejected}} المرفوضة</label>
                                    <span class="pg-percentage">{{$OrdersRejectedPer}}%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{$OrdersRejectedPer}}%;" aria-valuenow="{{$OrdersRejectedPer}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm mt-3">
                                <div class="pg-box mb-3">
                                    <label class="form-label">{{$OrdersClosed}} المغلقة</label>
                                    <span class="pg-percentage">{{$OrdersClosedPer}}%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: {{$OrdersClosedPer}}%;" aria-valuenow="{{$OrdersClosedPer}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="pg-box mb-3">
                                    <label class="form-label">{{$OrdersDone}} المكتملة</label>
                                    <span class="pg-percentage">{{$OrdersDonePer}}%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$OrdersDonePer}}%;" aria-valuenow="{{$OrdersDonePer}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="pg-box mb-3">
                                    <label class="form-label">{{$OrdersImplementationPhase}} قيد التنفيذ</label>
                                    <span class="pg-percentage">{{$OrdersImplementationPhasePer}}%</span>
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{$OrdersImplementationPhasePer}}%;" aria-valuenow="{{$OrdersImplementationPhasePer}}" aria-valuemin="0" aria-valuemax="100"></div>
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
                                    {{$OffersNumber}}
                                </h3>
                                <a href="/MyOffers?ref=dashboard"><button class="btn btn-primary btn-sm btn-sm mb-3"> مشاهدة عروضي</button></a>

                              </div>
                            </div>
                            <div class="col-sm mt-3">
                                <div class="pg-box mb-3">
                                    <label class="form-label">{{$OffersPending}} بانتظار الموافقة</label>
                                    <span class="pg-percentage">{{$OffersPendingPer}}%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: {{$OffersPendingPer}}%;" aria-valuenow="{{$OffersPendingPer}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
     
                                <div class="pg-box mb-3">
                                    <label class="form-label">{{$OffersOpen}} قيد التنفيذ</label>
                                    <span class="pg-percentage">{{$OffersOpenPer}}%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{$OffersOpenPer}}%;" aria-valuenow="{{$OffersOpenPer}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm mt-3">
                                <div class="pg-box mb-3">
                                    <label class="form-label">{{$OffersDone}} المكتملة</label>
                                    <span class="pg-percentage">{{$OffersDonePer}}%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$OffersDonePer}}%;" aria-valuenow="{{$OffersDonePer}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="pg-box mb-3">
                                    <label class="form-label">{{$OrdersCancelled}} الملغاة</label>
                                    <span class="pg-percentage">{{$OffersCancelledPer}}%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{$OffersCancelledPer}}%;" aria-valuenow="{{$OffersCancelledPer}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
 
                           
                            </div>
                        </div>
                    </div>
                </a>

                </div>



                    <div class="box-left mb-5 card p-4">
                       <a href="{{asset('orders?ref=dashboard')}}"> <h1 class="card-title mb-4 mt-2" style="font-size: 16px">  أحدث طلبات العروض</h1></a>
            <last-orders-box></last-orders-box>
    
                </div>

          
            </div>
            <div class="col-sm col-lg-4 mb-3">
                <div class="card p-3">

                <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> الرسائل</h1>
                <last-messages-box :max="5" account_number="{{Auth::user()->Account_number}}"></last-messages-box>
      
                </div>
            </div>
        </div>
    </div>

</div>

@stop