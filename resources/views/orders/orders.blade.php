@extends('layout.master')
@section('title', 'طلبات العروض')

@section('content')



    <div class="container mt-5 mb-5">
        <div class="row text-center" dir="rtl">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{asset('/')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلبات العروض</li>
                    </ol>
                </nav>
                <h1 align="right" class="breadcrumb-title">طلبات العروض المفتوحة</h1>
            </div>

        </div>
    </div>
<div id="app">
    <open-orders-list></open-orders-list>

</div>


@stop
