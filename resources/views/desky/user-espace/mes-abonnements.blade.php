
@extends('desky.panel.app')
@section('title', 'الاشتراكات والدفع')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
@section('ogimage', asset('image/moqawala.ma.jpg'))
<style>.l2 a {
    color: #f98a13 !important;
}
#form-loading{
    display: block;
}
</style>

@section('content')
    <div>
        @php
            $datajson = file_get_contents('database/data.json');
            $jsondatas = json_decode($datajson, true);
        @endphp

        <div class="wd-90 uk-margin-small-top uk-margin-small-bottom">

            <div dir="rtl" class="uk-text-center " uk-grid>

                <div class="uk-width-1-4@m">
                    <div class="uk-card uk-card-default uk-card-body" uk-sticky="bottom: true">
                        <h4 class="uk-card-title uk-text-right">
                            مرحبا Saad Rifai !</h4>
                        <hr>

                        @include('desky.layouts.right-bar-user')

                        <br>

                    </div>
                </div>
                <div class="uk-width-expand@m">
                    <div class="uk-card uk-card-default uk-card-body">
                        <h4 class="uk-card-title uk-text-right">
                            <span uk-icon="credit-card"></span> الاشتراكات والدفع
                        </h4>
                        <hr>
                        <h4 class="uk-card-title uk-text-right">
                            خطتي</h4>

                        @include('desky.layouts.plans-infos')
                        <hr>
                        <h4 class="uk-card-title uk-text-right">
                            معلومات الدفع</h4>
                        <hr>
                        <credit-card-settings></credit-card-settings>
                        <h4 class="uk-card-title uk-text-right">
                            اضافة باقة </h4>
                        <hr>
                        <div dir="rtl" class="uk-grid-small uk-text-center">
                            <a href="/tarifs">
                            <button class="uk-button uk-button-primary btn-call"><i class="fas fa-box"></i> مشاهدة الباقات
                            </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
