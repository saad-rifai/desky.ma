@extends('layout.master')
@section('title', 'اضافة طلب عروض')


@section('content')

<!-- Modal Info  -->

<div class="modal fade" id="staticBackdrop"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
      <div class="modal-content" dir="rtl">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">كيفية تضيف طلب عروض ؟</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body position-relative">
         

            <!-- Video -->
            <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
                <div class="wistia_responsive_wrapper"
                    style="height:100%;left:0;position:absolute;top:0;width:100%;"><iframe
                        src="https://fast.wistia.net/embed/iframe/n1ik6rxzxh?videoFoam=true"
                        title=" [Example Video] Wistia Video Essentials" allow="autoplay; fullscreen"
                        allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed"
                        name="wistia_embed" allowfullscreen msallowfullscreen width="100%"
                        height="100%"></iframe></div>
            </div>
            <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>

            <!-- Video -->


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">فهمت</button>
        </div>
      </div>
    </div>
  </div>
  

<!-- Modal Info  -->

    <div class="container mt-5 mb-5">
        <div class="row text-center" dir="rtl">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلباتي</li>
                    </ol>
                </nav>
                <h1 align="right" class="breadcrumb-title">اضافة طلب</h1>
            </div>
            <div class="col-auto">
                <div class="bis-content">
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-info-circle"></i> كيفية تضيف طلب عروض</button>
                </div>
            </div>

        </div>
    </div>
    <div id="app" class="container mb-5 mt-2">

        <div class="row justify-content-md-center" dir="rtl">
            <div class="col-sm ">
                <add-order></add-order>

            </div>

            <div class="col-sm col-lg-4">
                <div class="text-info-left  pr-5">
                    <h4 style="text-align: right;">أنشر طلبك لأفضل المقاوليين الذاتيين</h4>
                    <p class="heada__title" style="text-align: right;">في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.</p>
                   <br>
                    <h4 class="heada__title" style="text-align: right;"><br class="line-break" />إذا كنت تحتاج إلى عدد أكبر من الفقرات</h4>
                    <p class="heada__title" style="text-align: right;">يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.<br class="line-break" />ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن يوفر على</p>
                   <br>
                    <h4 class="heada__title" style="text-align: right;">البحث عن نص بديل</h4>
                    <ul>
                    <li class="heada__title" style="text-align: right;">لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق</li>
                    <li class="heada__title" style="text-align: right;">غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصاً بديلاً ومؤقتاً.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


@stop
