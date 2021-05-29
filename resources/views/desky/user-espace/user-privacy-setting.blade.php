@extends('desky.panel.app')
@section('title', 'اعدادات الخصوصية')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
<style>.l5 a {
    color: #f98a13 !important;
}</style>
@section('content')
@php
$datajson = file_get_contents('database/data.json');
$jsondatas = json_decode($datajson, true);
@endphp
<div>
<div class="wd-80 uk-margin-small-top uk-margin-small-bottom">

    <div dir="rtl" class="uk-text-center " uk-grid>

        <div class="uk-width-1-4@m">
            <div class="uk-card uk-card-default uk-card-body" uk-sticky="bottom: true">
                <h4 class="uk-card-title uk-text-right">
                    مرحبا {{ Auth::user()->fname  }} {{ Auth::user()->lname  }} !</h4>
                    <hr>



                @include('desky.layouts.right-bar-user')

                <br>

            </div>
        </div>
        <div class="uk-width-expand@m">
            <div class="uk-card uk-card-default uk-card-body">
                <h4 class="uk-card-title uk-text-right">
                    <span uk-icon="lock"></span> اعدادات الخصوصية  </h4>


                <hr>

        <user-privacy-setting :user="{{ Auth::user() }}"></user-privacy-setting>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
