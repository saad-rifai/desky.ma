@extends('layout.master')
@section('title', 'تعديل طلب')

@section('content')



    <div class="container mt-5 mb-5">
        <div class="row text-center" dir="rtl">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{asset('/')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{asset('/MyOrders')}}">طلباتي</a></li>
                    </ol>
                </nav>
                <h1 align="right" class="breadcrumb-title">تعديل طلب #{{$data->OID}}</h1>
            </div>

        </div>
    </div>
<div id="app">
    <div class="container">
        <div class="card p-4 mb-4 position-relative" dir="rtl">
            <h1 class="card-title mb-4 mt-2" style="font-size: 16px">
               تعديل الطلب
            </h1>
            <edit-order oid="{{$data->OID}}"></edit-order>

          </div>
    </div>

</div>


@stop
