@extends('layout.master')
@section('title', 'طلبات العروض')

@section('content')

    <!-- Mobile Filter Search -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="filter-search" aria-labelledby="filter-search-label">
        <div class="offcanvas-header" align="right" dir="rtl">
            <h5 class="offcanvas-title" id="filter-search-label">فلتر البحث</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" align="right" dir="rtl">
            <form align="right" dir="rtl">
                <div class="mb-3">

                    <input placeholder="البحث..." type="text" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>القطاع</option>
                        <option value="1">الخدمات</option>
                        <option value="2">التجارة</option>
                        <option value="3">الصناعة</option>
                        <option value="3">الصناعة التقليدية</option>
                    </select>
                </div>
                <div class="mb-3">

                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="النشاط">
                    <datalist id="datalistOptions">
                        <option value="San Francisco">
                        <option value="New York">
                        <option value="Seattle">
                        <option value="Los Angeles">
                        <option value="Chicago">
                    </datalist>
                </div>
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>المدينة</option>
                        <option value="1">الخدمات</option>
                        <option value="2">التجارة</option>
                        <option value="3">الصناعة</option>
                        <option value="3">الصناعة التقليدية</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="customRange3" class="form-label">الميزانية</label>


                    <div class="row g-2 text-center">
                        <div class=" col-auto" align="right">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">من</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" class="form-control" value="0" id="min-inp">

                                </div>
                            </div>
                        </div>
                        <div class="col-auto" align="left">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">الى</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" class="form-control" value="500000" id="min-inp">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- Mobile Filter Search -->

    <div class="container mt-5 mb-5">
        <div class="row text-center" dir="rtl">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{asset('/')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلبات العروض</li>
                    </ol>
                </nav>
                <h1 align="right" class="breadcrumb-title">طلبات العروض المفتوحة</h1>
            </div>

        </div>
    </div>
    <div class="container mb-5 mt-2">
        <div class="filter-mobile-toggle">
            <button type="button" data-bs-toggle="offcanvas" data-bs-target="#filter-search" aria-controls="filter-search"
                class="filter-mobile-toggle-btn"><i class="fas fa-sliders-h"></i></button>
        </div>
        <div class="row justify-content-md-center" dir="rtl">
            <div class="col-sm col-lg-3 filter-search-web">
                <form align="right">
                    <div class="mb-3">

                        <input placeholder="البحث..." type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>القطاع</option>
                            <option value="1">الخدمات</option>
                            <option value="2">التجارة</option>
                            <option value="3">الصناعة</option>
                            <option value="3">الصناعة التقليدية</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="form-control form-tags" id="activety-tags" name="states[]" multiple="multiple">
                            @include('layout.list-Industriel-commercial-et-artisanal')
                        </select>

                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>المدينة</option>
                            <option value="1">الخدمات</option>
                            <option value="2">التجارة</option>
                            <option value="3">الصناعة</option>
                            <option value="3">الصناعة التقليدية</option>
                        </select>
                    </div>
                    <div class="mb-3 mt-5">
                        <label for="customRange3" class="form-label">الميزانية</label>


                        <div class="row g-2 text-center mt-2">
                            <div class=" col-auto" align="right">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">من</label>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" value="0" id="min-inp"
                                            placeholder="Password">

                                    </div>
                                </div>
                            </div>
                            <div class="col-auto" align="left">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">الى</label>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" value="500000" id="min-inp"
                                            placeholder="Password">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-sm ">
                <div class="box-left  card p-4">
                    @for ($i = 1; $i < 8; $i++)
                    <a href="{{asset('order/'.$i)}}">
                        <div class="box-article pb-3 mb-3"">
                            <div class="    head-box-article">
                            <div class="row text-center">
                                <div class="col">
                                    <h1 align="right" class="title-box-article">تنظيف وتجهيز مكاتب عمارة حديثة البناء</h1>
                                </div>
                                <div class="col-3">
                                    <div align="left" class="box-article-cta">
                                        <button align="left" type="button"
                                            class="btn btn-primary btn-sm bid-mobile-icon">قدم عرضك</button>

                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-auto">
                                    <div class="user-info-box-article">
                                        <div class="row" onclick="redirectUserPage(event,11)">
                                            <div class="col-auto">
                                                <div class="user-info-box-article-avatar">
                                                    <img src="img/users/{{ $i }}.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="user-info-box-article-name">
                                                    <h5 class="user-info-box-article-name-h5" > Saad Rifai</h5>
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
                                <div class="col-auto">
                                    <div class="user-info-box-article">
                                        <i class="fas fa-ticket-alt"></i> 3 عروض
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body-box-article">
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
            </a>
                @endfor

            </div>

            <div class="show-more-section text-center mt-5">
                <button style="margin-right: 0 !important;" type="button" class="btn btn-primary text-center">مشاهدة
                    المزيد</button>

            </div>
        </div>
    </div>
    </div>


@stop
