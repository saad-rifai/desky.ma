@extends('layout.master')
@section('title', 'الرسائل')
<link href="{{ asset('css/chat/chat-style.css') }}" rel="stylesheet">

@section('content')

<div class="container">
    <div class="card mt-5 mb-5">
        <div id="app">
            <messages-box></messages-box>

        </div>
    </div>
</div>
@stop