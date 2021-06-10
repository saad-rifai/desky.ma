@extends('desky.layouts.app')

@section('title', 'من نحن')
@section('content')
<header style="height: 400px">
    <div class="uk-child-width-1-1@s uk-light" uk-grid>
        <div>
            <div  class="uk-background-cover uk-height-large uk-panel uk-flex uk-flex-center uk-flex-middle"
                style="background-image: linear-gradient(rgb(255 175 33), rgb(255 111 44)); height: 400px !important">
                <div  class="wd-90 uk-text-center">
                    <div class="content-header uk-text-center">
                        <h1 class="uk-title header">من نحن</h1>
                        </p>


                    </div>
                </div>
            </div>
        </div>
</header>
<div style="">
    <br>
    <br>

    <div id="facture" class="wd-90 uk-margin-top ">

        <div uk-scrollspy="cls: uk-animation-slide-right; target: .uk-card-body; delay: 300; repeat: true"
            class="uk-card  uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
            <div uk-scrollspy="cls: uk-animation-slide-top; delay: 300; repeat: true"
                class="uk-inline uk-card-media-right  uk-cover-container" >
                <canvas height="500px"></canvas>

                <img height="300px" src="{{ URL::asset('image/service/3182762.jpg') }}" alt="Desky من نحن" uk-cover>

            </div>
            <div class="align-flex">
                <div class="uk-card-body uk-text-right " dir="rtl">
                    <h3 class="uk-card-title">من نحن ؟</h3>
                    <p>منصة desky.ma تابعة لشركة NerYou LLC التي تهتم بتطوير ورقمنة السوق المغربية من خلال ابتكار وتطوير حلول عملية وطرحها في السوق, تأسست شركة NerYou LLC سنة 2021 بمدينة طنجة شمال المغرب لتنطلق في رحلتها ومهمتها التي اسست من أجلها وهي تطوير ورقمنة السوق المغربية. </p>                     <a href='/register' target="_blank" uk-toggle> <button type="button"
                            class="uk-button uk-button-primary btn-call">
                            سجل الأن</button></a>
                            <a href="/Contactez-nous" uk-scroll><button class="uk-button uk-button-text">تواصل معنا</button> </a>
                </div>
            </div>

        </div>
    </div>
</div>



<br>
<br>

@endsection
