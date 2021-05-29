@extends('desky.panel.app')
@section('title', 'تعديل فاتورة')

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
            <li><a href="{{ asset('facture/list') }}">قائمة الفواتير</a></li>
            <li class="uk-disabled"><a>تعديل فاتورة</a></li>
        </ul>
<edit-facture :uid="{{ Auth::user()->id }}" :oid="'{{ $OID }}'"></edit-facture>

    </div>
@endsection
