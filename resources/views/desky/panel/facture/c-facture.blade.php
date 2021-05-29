@extends('desky.panel.app')
@section('title', 'انشاء فاتورة')

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
            <li><a href="{{ asset('devis/list') }}">قائمة الفواتير</a></li>
            <li class="uk-disabled"><a>انشاء فاتورة</a></li>
        </ul>
<form-facture :uid="{{ Auth::user()->id }}"></form-facture>

    </div>
@endsection
