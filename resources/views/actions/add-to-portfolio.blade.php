@extends('layout.master')
@section('title', 'اضافة عمل')


@section('content')
    <div class="container mt-5 mb-5">
        <div class="row text-center" dir="rtl">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">اعمالي</a></li>
                    </ol>
                </nav>
                <h1 align="right" class="breadcrumb-title">اضافة عمل</h1>
            </div>


        </div>
        <div id="app" class=" mt-5 mb-5">
            <add-to-portfolio></add-to-portfolio>
            

        </div>
    </div>
@stop
