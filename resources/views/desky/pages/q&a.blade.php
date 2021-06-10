@extends('desky.layouts.app')

@section('title', 'الاسئلة الشائعة')
@section('content')
<header style="height: 400px">
    <div class="uk-child-width-1-1@s uk-light" uk-grid>
        <div>
            <div  class="uk-background-cover uk-height-large uk-panel uk-flex uk-flex-center uk-flex-middle"
                style="background-image: linear-gradient(rgb(255 175 33), rgb(255 111 44)); height: 400px !important">
                <div  class="wd-90 uk-text-center">
                    <div class="content-header uk-text-center">
                        <h1 class="uk-title header">الأسئلة الشائعة</h1>
                        </p>


                    </div>
                </div>
            </div>
        </div>
</header>
<div style="">
    <br>
    <br>
@include('desky.layouts.q-a')
</div>



<br>
<br>

@endsection
