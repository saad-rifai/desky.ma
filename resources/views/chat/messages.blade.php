@extends('layout.master')
@section('title', 'الرسائل')
<link rel="stylesheet" href="{{asset('css/min/chat-style.css')}}">

@section('content')

<div class="container">
    <div class="card mt-5 mb-5">
        <div id="app">
            <messages-box account_number="{{Auth::user()->Account_number}}"></messages-box>

        </div>
    </div>
</div>
@stop