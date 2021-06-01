@extends('desky.panel.app')
@section('title', 'تعديل عميل')

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
            <li class="uk-disabled"><a>تعديل عميل #{{$CID}}</a></li>
        </ul>
        <edit-clients :uid="{{ Auth::user()->id }}" :cid="'{{ $CID }}'"></edit-clients>

    </div>
@endsection
