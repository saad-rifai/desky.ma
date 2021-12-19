@extends('layout.master')
@section('title', 'عروضي')

@section('content')



    <div class="container mt-5 mb-5">
        <div class="row text-center" dir="rtl">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{asset('/')}}">الرئيسية</a></li>
                    </ol>
                </nav>
                <h1 align="right" class="breadcrumb-title">عروضي</h1>
            </div>

        </div>
    </div>
<div id="app">
<my-offers></my-offers>
</div>


@stop
