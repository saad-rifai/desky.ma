@extends('layout.master')
@section('title', 'المقاولين الذاتيين')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row text-center" dir="rtl">
      <div class="col">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              المقاولين الذاتيين
            </li>
          </ol>
        </nav>
        <h1 align="right" class="breadcrumb-title">
          قائمة المقاولين الذاتيين
        </h1>
      </div>
    </div>
  </div>

<div id="app">
  @php
      if(Auth::check()){
        $myAccountNumber = Auth::user()->Account_number;
      }else{
        $myAccountNumber = null;
      }
  @endphp
    <ae-list from_url="{{url()->current()}}" myaccountnumber="{{$myAccountNumber}}"></ae-list>
</div>

@stop
