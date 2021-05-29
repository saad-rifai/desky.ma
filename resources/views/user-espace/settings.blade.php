@extends('layouts.layout')
@section('title', 'حسابي')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
@section('ogimage', asset('image/moqawala.ma.jpg'))
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
                    مرحبا Saad Rifai !</h4>
                <hr>


                <ul dir="rtl" class="uk-list uk-list-divider uk-text-right user-menu">
                    <li><a href="./"><span uk-icon="user"></span> حسابي </a></li>
                    <li class=""><a href="./services"><span uk-icon="list"></span> خدماتي</a></li>
                    <li ><a  href="./products"><span uk-icon="grid"></span> منتجاتي</a></li>
                    <li ><a href="./history"><span uk-icon="history"></span> سجل المدفوعات</a></li>
                    <li class="active"><a href="./setting"><span uk-icon="cog"></span> الاعدادات </a></li>
 
                </ul>
                <br>

            </div>
        </div>
        <div class="uk-width-expand@m">
            <div class="uk-card uk-card-default uk-card-body">
                <h4 class="uk-card-title uk-text-right">
                    <span uk-icon="cog"></span> اعدادات الحساب  </h4>

                
                <hr>

        <user-general-setting :user="{{ Auth::user() }}"></user-general-setting>
            </div>
        </div>
    </div>
</div>
</div>
@endsection