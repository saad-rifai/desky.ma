@extends('desky.panel.headform')
@section('title', 'انشاء حساب')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
@section('ogimage', asset('image/moqawala.ma.jpg'))
<script src='https://www.google.com/recaptcha/api.js'></script>

@section('content')
   
    @php
    $datajson = file_get_contents('database/data.json');
    $jsondatas = json_decode($datajson, true);
    @endphp
<more-infos :user="{{ Auth::user() }}" :recaptcha="'{{config('services.recaptcha.key')}}'"></more-infos>

@endsection