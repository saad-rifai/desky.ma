@extends('layout.master')
@section('title', 'طلباتي')

@section('content')



    <div class="container mt-5 mb-5">
        <div class="row text-center" dir="rtl">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{asset('/')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلباتي</li>
                    </ol>
                </nav>
                <h1 align="right" class="breadcrumb-title">طلبات العروض الخاصة بي</h1>
            </div>

        </div>
    </div>
<div id="app">
    <myorders></myorders>

</div>


@stop
