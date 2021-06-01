@extends('desky.panel.app')
@section('title', 'انشاء عميل')

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
            <li><a href="{{ asset('clients/list') }}">قائمة عملاء</a></li>
            <li class="uk-disabled"><a>انشاء عميل</a></li>
        </ul>
<creer-client :uid="{{ Auth::user()->id }}"></creer-client>

    </div>
@endsection
