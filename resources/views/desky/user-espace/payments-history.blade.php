@extends('desky.panel.app')
@section('title', 'سجل المدفوعات')
<style>.l6 a {
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

                <list-recu></list-recu>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
