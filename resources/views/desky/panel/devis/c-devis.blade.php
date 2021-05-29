@extends('desky.panel.app')
@section('title', 'انشاء عرض أسعار')

<style>
    #form-loading{
        display: block;
    }
</style>

@section('content')

    <div class="wd-90 uk-margin">

        <br>
        <ul class="uk-breadcrumb uk-text-right" dir="rtl">
            <li><a href="{{ asset("u") }}">لوحة التحكم</a></li>
            <li><a href="{{ asset('devis/list') }}">قائمة عروض الاسعار</a></li>
            <li class="uk-disabled"><a>انشاء عرض أسعار</a></li>
        </ul>
<form-devis :uid="{{ Auth::user()->id }}"></form-devis>

    </div>
@endsection
