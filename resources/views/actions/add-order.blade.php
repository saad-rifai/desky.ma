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
    <div class="container mb-5 mt-2">

        <div class="row justify-content-md-center" dir="rtl">
            <div class="col-sm ">
                <div class="card p-4 mb-4">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> اضافة طلب عروض</h1>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                        <div class="col w-100">
                            <div class="mb-3 ">
                                <label class="form-label">عنوان الطلب</label>
                                <input type="text" class="form-control" name="" placeholder="" id="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 ">
                                <label class="form-label">القطاع</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>تحديد</option>
                                    <option value="1">الخدمات</option>
                                    <option value="2">التجارة</option>
                                    <option value="3">الصناعة</option>
                                    <option value="3">الصناعة التقليدية</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 ">
                                <label class="form-label">النشاط</label>
                                <select class="form-control form-tags" id="activety-tags" name="states[]"
                                    multiple="multiple">
                                    @include('layout.list-Industriel-commercial-et-artisanal')
                                </select>
                            </div>
                        </div>
                        <div class="col w-100">
                            <div class="mb-3 ">
                                <label for="description" class="form-label">وصف الطلب</label>
                                <textarea class="form-control" id="description" rows="5"></textarea>
                                <div class="form-text">صف طلبك بشكل مفصل ووضح مالذي توده بالظبط للحصول على أفضل العروض
                                </div>
                            </div>
                        </div>
                        <div class="col w-100">
                            <div class="mb-3 ">
                                <label class="form-label">المكان</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>تحديد</option>
                                    <optgroup label="المدن" title="المدن">
                                        <option value="1">طنجة</option>
                                        <option value="2">الداربيضاء</option>
                                        <option value="3">الرباط</option>
                                        <option value="3">فاس</option>
                                    </optgroup>
                                    <optgroup label="خيارات أخرى">
                                        <option value="0">عن بعد</option>
                                    </optgroup>

                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="price" class="form-label">الميزانية</label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        MAD
                                    </div>
                                    <input type="number" class="form-control" id="price">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="time" class="form-label"> المدة المتوقعة للتنفيذ </label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fas fa-stopwatch"></i>
                                    </div>
                                    <input type="number" class="form-control" id="time">
                                </div>
                            </div>
                        </div>
                        <div class="col w-100">
                            <div class="mb-3">
                                <label for="time" class="form-label"> ملفات توضيحية</label>
                                <div class="alert alert-danger" id="form_upload_error" hidden role="alert">

                                </div>
                                <div id="upload-files-form" class="upload-files-form" data-target="files-include"
                                    data-types="['png','jpg']">
                                    <input type="file" id="files-include" name="files[]" multiple hidden>
                                    <div class="upload-files-form-content">
                                        <span class="icon-upload-file"><img src="{{ asset('img/icons/upload.png') }}"
                                                alt=""></span>
                                        <span class="title-upload-file">اسحب الملفات الى هنا</span>
                                        <br>

                                        <span class="text-upload-file">أو انقر للاختيار يدويا</span>
                                    </div>
                                </div>
                                <div class="show-files-border mt-5 mb-5">
                                    <div class="show_files_content mb-5">
                                        <div class="row position-relative">
                                            <span class="badge bg-secondary position-absolute bottom-0 end-0"
                                                style="margin-left: 15px;width: initial !important;">جاري التحميل</span>

                                            <div class="col-auto">
                                                <div class="img_file_type"><img
                                                        src="{{ asset('img/icons/file-type/jpg.svg') }}" alt=""></div>
                                            </div>
                                            <div class="col-auto position-relative">
                                                <div class="title_file">
                                                    <h3 class="file_title">Doc_5478.pdf</h3><br><span
                                                        class="file_size">12KB</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-bar-file mt-3">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn-close"
                                                        aria-label="Close"></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="show_files_content mb-5">
                                        <div class="row position-relative">
                                            <span class="badge bg-success position-absolute bottom-0 end-0"
                                                style="margin-left: 15px;width: initial !important;">تم التحميل</span>

                                            <div class="col-auto">
                                                <div class="img_file_type"><img
                                                        src="{{ asset('img/icons/file-type/psd.svg') }}" alt=""></div>
                                            </div>
                                            <div class="col-auto position-relative">
                                                <div class="title_file">
                                                    <h3 class="file_title">design pages app.psd</h3><br><span
                                                        class="file_size">1MB</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-bar-file mt-3">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 100%;"
                                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn-close"
                                                        aria-label="Close"></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col w-100">
                            <div class="mt-3 ">
                                <button style="margin-right: 0 !important;" type="button"
                                    class="btn btn-primary">اضافة الطلب</button>
        
                            </div>

                        </div>
                    </div>

                </div>

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
