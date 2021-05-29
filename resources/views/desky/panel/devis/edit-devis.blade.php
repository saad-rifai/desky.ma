@extends('desky.panel.app')
@section('title', 'تعديل عرض الأسعار')

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
            <li class="uk-disabled"><a>تعديل عرض الأسعار</a></li>
        </ul>
<edit-devis :uid="{{ Auth::user()->id }}" :oid="'{{ $OID }}'"></edit-devis>

    </div>
@endsection
