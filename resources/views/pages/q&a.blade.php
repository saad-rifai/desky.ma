@extends('layout.master')
@section('title', 'الاسئلة الشائعة')

@section('content')
    <div class="head-cbrand position-relative">
        <h1 class="title-page-cbrand text-center  position-absolute top-50 start-50 translate-middle">الاسئلة الشائعة</h1>
    </div>


    <div class="container">
        <div class="row justify-content-md-center " dir="rtl">

            <div class="col-sm">
                <div class=" p-5 mx-auto mt-5 mb-5 page-text">
                    <h6>ديسكي الوسيط الأمثل بين المقاولين الذاتيين و العملاء.</h6>
                    <br>
                    <p class="font-Naskh"> تعمل ديسكي على توفير مساحة وصل بين المقاول الذاتي و أصحاب الاعمال و الشركات,
                        من خلال المنصة يمكن للشركات والافراد إيداع طلباتهم التي تعبر عن الخدمات التي يحتجونها و التي تتماشى
                        مع متطلباتهم قصد الحصول على عروض من المقاولين الذاتيين وتنفيذ طلبهم, كذلك تتيح منصة ديسكي للمقاولين
                        الذاتيين ايجاد عملاء جدد والتعريف بخدماتهم واعمالهم.
                    </p>
                    <br><br>
                    @include('layout.q&a')


                </div>
            </div>
        </div>

    </div>
@stop
