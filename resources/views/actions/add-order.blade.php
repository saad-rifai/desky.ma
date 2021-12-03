@extends('layout.master')
@section('title', 'اضافة طلب عروض')
@section('content')
<!-- Modal Info  -->
<div class="modal fade" id="staticBackdrop"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
      <div class="modal-content" dir="rtl">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">كيفية تضيف طلب عروض ؟</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body position-relative">
         

            <!-- Video -->
            <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
                <div class="wistia_responsive_wrapper"
                    style="height:100%;left:0;position:absolute;top:0;width:100%;"><iframe
                        src="https://fast.wistia.net/embed/iframe/n1ik6rxzxh?videoFoam=true"
                        title=" [Example Video] Wistia Video Essentials" allow="autoplay; fullscreen"
                        allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed"
                        name="wistia_embed" allowfullscreen msallowfullscreen width="100%"
                        height="100%"></iframe></div>
            </div>
            <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>

            <!-- Video -->


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">فهمت</button>
        </div>
      </div>
    </div>
  </div>
  

<!-- Modal Info  -->
    <div class="container mt-5 mb-5">
        <div class="row text-center" dir="rtl">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلباتي</li>
                    </ol>
                </nav>
                <h1 align="right" class="breadcrumb-title">اضافة طلب</h1>
            </div>
            <div class="col-auto">
                <div class="bis-content">
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-info-circle"></i> كيفية تضيف طلب عروض</button>
                </div>
            </div>

        </div>
    </div>
    <div id="app" class="container mb-5 mt-2">
        <div class="row justify-content-md-center" dir="rtl">
            <div class="col-sm ">
                <add-order></add-order>
            </div>
        </div>
    </div>


@stop
