@extends('layout.head-links')
@section('title', "صفحة الخطأ 404")
@section('content')
<div class="container">
    <div class="row row-cols-1 mx-auto text-center mb-5 align-items-center position-absolute top-50 start-50 translate-middle">
        <div class="col w-100">
            <div class="icon-large-top">
                <img style="max-width: 350px"
                    src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/asset/404+error+with+a+tired+person-bro.png"
                    alt="خطأ 404" />
            </div>
        </div>
        <div class="col w-100 mt-3">
            <p class="text-icon">
              خطأ 404
                <span class="d-block font-Naskh text-secondary">
                   لم يتم العثور على ماتبحث عنه يرجى التحقق من أن العنوان صالح.
    
                </span>
            </p>
    
    
        </div>
        <div class="col">
            <a href="{{ asset('/') }}"><button  type="button" class="btn text-center btn-primary">
                الصفحة الرئيسية</button></a>
        </div>
    </div>
    

</div>
@stop

