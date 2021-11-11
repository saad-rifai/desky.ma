@extends('layout.master')
@section('title', 'تنظيف وتجهيز مكاتب عمارة حديثة البناء')

@section('content')



    <div class="container mt-5 mb-5">
        <div class="row text-center" dir="rtl">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلبات العروض</li>
                    </ol>
                </nav>
                <h1 align="right" class="breadcrumb-title">تنظيف وتجهيز مكاتب عمارة حديثة البناء</h1>
            </div>

        </div>
    </div>
    <div class="container mb-5 mt-2">

        <div class="row justify-content-md-center" dir="rtl">
            <div class="col-sm ">
                <div class="box-left  card p-4 mb-4 mbl-show">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> بطاقة الطلب</h1>

                    <div class="row mx-auto w-100 row-cols-2 " dir="rtl">
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-info-circle"></i> حالة الطلب:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                <span class="badge rounded-pill bg-success order-status">مفتوح</span>
                            </span>
                        </div>

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="far fa-clock"></i> تاريخ النشر:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                15/10/2021
                            </span>
                        </div>

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-briefcase"></i> القطاع, النشاط:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                الخدمات, اشغال التنظيف
                            </span>
                        </div>

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-dollar-sign"></i> الميزانية:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                600 MAD
                            </span>
                        </div>


                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-stopwatch"></i> مدة التنفيذ:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                يومان
                            </span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-ticket-alt"></i> عدد العروض:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                عرضان
                            </span>
                        </div>

                        <div class="col mb-3" align="right">
                            <span class="card-info-title"><i class="fas fa-map-marker-alt"></i> المدينة:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                طنجة
                            </span>
                        </div>
                    </div>


                </div>

                <div class="box-left mbl-show  mb-4 card p-4 mt-4">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> صاحب الطلب</h1>
                    <div class="box-article pb-3 mb-3"">
                                        <div class="        head-box-article">
                        <div class="row text-center">
                            <div class="col">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar-large-box-article">
                                            <img src="{{ asset('img/users/1.jpg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="user-name-box-article">
                                            <h4>
                                                Saad Rifai
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mr-65 mmt-35">
                            <div class="col-auto">
                                <div class="user-info-box-article">
                                    <div class="row">

                                        <div class="col-auto">
                                            <div class="user-info-box-article">
                                                <i class="fas fa-briefcase"></i> صناعة الخبز والحلويات
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="user-info-box-article">
                                    <i class="fas fa-map-marker-alt"></i> طنجة, المغرب
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-5 pb-3 mb-4">
                <div class="position-relative m-4">
                    <div class="progress" style="height: 1px;">
                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="position-relative">
                        <span class="step-title position-absolute top-0 start-0 translate-middle">استلام العروض</span>
                        <button type="button"
                            class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill steps"
                            style="width: 2rem; height:2rem;">1</button>
                    </div>
                    <div class="position-relative">
                        <span class="step-title position-absolute top-0 start-50 translate-middle">مرحلة التنفيذ</span>
                        <button type="button"
                            class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill steps"
                            style="width: 2rem; height:2rem;">2</button>
                    </div>
                    <div class="position-relative">
                        <span class="step-title position-absolute top-0 start-100 translate-middle">تم الانجاز</span>
                        <button type="button"
                            class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill steps"
                            style="width: 2rem; height:2rem;">3</button>
                    </div>
                </div>
            </div>
            <div class="card p-4 mb-4">
                <div class="head-card position-relative">
                    <span
                        class="badge rounded-pill bg-success position-absolute top-50 end-0 translate-middle-y order-status">مفتوح</span>

                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> وصف الطلب</h1>
                </div>
                <div class="body-card-text">
                    <p>
                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى،
                        حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
                        التطبيق.
                        إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص
                        لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث
                        يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
                        ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص
                        العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم
                        فيظهر بشكل لا يليق.
                    </p>
                </div>

            </div>
            <div class="card p-4 mb-4">
                <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> أضف عرضك</h1>

                <div class="mb-3">
                    <label for="description" class="form-label">وصف العرض</label>
                    <textarea class="form-control" id="description" rows="5"></textarea>
                    <div class="form-text">صف عرضك بشكل مفصل ووضح مالذي ستقدمه بالظبط</div>

                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="price" class="form-label">التكلفة</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    MAD
                                </div>
                                <input type="number" class="form-control" id="price">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="time" class="form-label">مدة التنفيذ</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fas fa-stopwatch"></i>
                                </div>
                                <input type="number" class="form-control" id="time">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <ul class="small-list-info">
                        <li>لا تضع روابط خارجية، قم بالاهتمام بمعرض أعمالك بدلا منها</li>
                        <li>لا تستخدم وسائل تواصل خارجية</li>
                        <li><a href="#">اقرا هنا كيف تضيف عرضا مميزا على أي طلب</a></li>
                    </ul>
                </div>
                <div class="mt-3 ">
                    <button style="margin-right: 0 !important;" type="button" class="btn btn-primary"> اضافة
                        العرض</button>

                </div>
            </div>
            <div class="card p-4 mb-4">
                <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> العروض</h1>
                @for ($i = 1; $i < 4; $i++)
                    <div class="box-article pb-3 mb-3"">
                                                <div class="          head-box-article">
                        <div class="row text-center">
                            <div class="col">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar-large-box-article">
                                            <img src="{{ asset('img/users/' . $i . '.jpg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="user-name-box-article">
                                            <h4>
                                                Saad Rifai
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mr-65 mmt-35">
                            <div class="col-auto">
                                <div class="user-info-box-article">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="user-info-box-article">
                                                <span class="user-rating-stars" dir="rtl">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="user-info-box-article">
                                                <i class="fas fa-briefcase"></i> صناعة الخبز والحلويات
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="user-info-box-article">
                                    <i class="fas fa-map-marker-alt"></i> طنجة, المغرب
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="body-box-article mr-65">
                        <p class="box-article-description ">
                            هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                            العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف
                            التى يولدها التطبيق.
                            إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد،
                            النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه
                            الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
                        </p>
                    </div>
            </div>

            @endfor

        </div>
        <div class="show-more-section text-center mt-5 mb-4">
            <button style="margin-right: 0 !important;" type="button" class="btn btn-primary text-center">مشاهدة
                المزيد</button>

        </div>
    </div>
    <div class="col-sm col-lg-4 ">
        <div class="box-left  card p-4 mbl-hide">
            <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> بطاقة الطلب</h1>

            <div class="row mx-auto w-100 row-cols-2 " dir="rtl">
                <div class="col mb-3" align="right">
                    <span class="card-info-title"><i class="fas fa-info-circle"></i> حالة الطلب:</span>
                </div>
                <div class="col mb-3" align="right">
                    <span class="card-info-text">
                        <span class="badge rounded-pill bg-success order-status">مفتوح</span>
                    </span>
                </div>

                <div class="col mb-3" align="right">
                    <span class="card-info-title"><i class="far fa-clock"></i> تاريخ النشر:</span>
                </div>
                <div class="col mb-3" align="right">
                    <span class="card-info-text">
                        15/10/2021
                    </span>
                </div>

                <div class="col mb-3" align="right">
                    <span class="card-info-title"><i class="fas fa-briefcase"></i> القطاع, النشاط:</span>
                </div>
                <div class="col mb-3" align="right">
                    <span class="card-info-text">
                        الخدمات, اشغال التنظيف
                    </span>
                </div>

                <div class="col mb-3" align="right">
                    <span class="card-info-title"><i class="fas fa-dollar-sign"></i> الميزانية:</span>
                </div>
                <div class="col mb-3" align="right">
                    <span class="card-info-text">
                        600 MAD
                    </span>
                </div>


                <div class="col mb-3" align="right">
                    <span class="card-info-title"><i class="fas fa-stopwatch"></i> مدة التنفيذ:</span>
                </div>
                <div class="col mb-3" align="right">
                    <span class="card-info-text">
                        يومان
                    </span>
                </div>
                <div class="col mb-3" align="right">
                    <span class="card-info-title"><i class="fas fa-ticket-alt"></i> عدد العروض:</span>
                </div>
                <div class="col mb-3" align="right">
                    <span class="card-info-text">
                        عرضان
                    </span>
                </div>

                <div class="col mb-3" align="right">
                    <span class="card-info-title"><i class="fas fa-map-marker-alt"></i> المدينة:</span>
                </div>
                <div class="col mb-3" align="right">
                    <span class="card-info-text">
                        طنجة
                    </span>
                </div>
            </div>


        </div>





        <div class="box-left mbl-hide  card p-4 mt-4">
            <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> صاحب الطلب</h1>
            <div class="box-article pb-3 mb-3"">
                                    <div class="        head-box-article">
                <div class="row text-center">
                    <div class="col">
                        <div class="row">
                            <div class="col-auto">
                                <div class="avatar-large-box-article">
                                    <img src="{{ asset('img/users/1.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="user-name-box-article">
                                    <h4>
                                        Saad Rifai
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mr-65 mmt-35">
                    <div class="col-auto">
                        <div class="user-info-box-article">
                            <div class="row">

                                <div class="col-auto">
                                    <div class="user-info-box-article">
                                        <i class="fas fa-briefcase"></i> صناعة الخبز والحلويات
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="user-info-box-article">
                            <i class="fas fa-map-marker-alt"></i> طنجة, المغرب
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <div class="box-left  card p-4 mt-4">
        <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> شارك الطلب</h1>
        <div class="mt-2">
            <input type="text" onclick="this.setSelectionRange(0, this.value.length)" style="cursor: pointer;"
                readonly="readonly" class="form-control text-center" name="" value="https://desky.ma/order/854726" id="">
            <div class="footer-social-media mx-auto">
                <ul class="list-social-media">
                    <li>
                        <a target="_blank" href="https://www.facebook.com/Youcandotshop">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://twitter.com/Youcandotshop">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.linkedin.com/company/youcandotshop/">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.youtube.com/c/Youcandotshop">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>


@stop
