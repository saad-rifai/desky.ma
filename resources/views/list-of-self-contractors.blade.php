@extends('layout.master')
@section('title', 'المقاولين الذاتيين')

@section('content')

    <!-- Mobile Filter Search -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="filter-search" aria-labelledby="filter-search-label">
        <div class="offcanvas-header" align="right" dir="rtl">
            <h5 class="offcanvas-title" id="filter-search-label">فلتر البحث</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" align="right" dir="rtl">
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
                    <select class="form-control form-tags" id="activety-tags-2" name="states[]" multiple="multiple">
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
                        <label for="customRange3" class="form-label">التقييم</label>
             <div class="position-relative rate-box">
                <div class="rate" dir="rtl">
                         




                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="text">5 stars</label>

                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="text">4 stars</label>

                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="text">1 star</label>
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
                        <li class="breadcrumb-item active" aria-current="page">المقاولين الذاتيين</li>
                    </ol>
                </nav>
                <h1 align="right" class="breadcrumb-title">قائمة المقاولين الذاتيين</h1>
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
                        <label for="customRange3" class="form-label">التقييم</label>
                        <div class="position-relative rate-box">
                            <div class="rate" dir="rtl">





                                <input type="radio" id="star5" name="rate" value="5" />
                                <label for="star5" title="text">5 stars</label>

                                <input type="radio" id="star4" name="rate" value="4" />
                                <label for="star4" title="text">4 stars</label>

                                <input type="radio" id="star3" name="rate" value="3" />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text">2 stars</label>

                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text">1 star</label>
                            </div>

                        </div>
                    </div>

                </form>

            </div>
            <div class="col-sm ">
                <div class="box-left  card p-4">
                    @for ($i = 1; $i < 8; $i++)
                    <div class="box-article pb-3 mb-3">
                        <div class="    head-box-article">
                        <div class="row text-center">
                            <div class="col">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar-large-box-article">
                                            <img src="{{ asset('img/users/'.$i.'.jpg') }}" alt="">
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

            <div class="show-more-section text-center mt-5">
                <button style="margin-right: 0 !important;" type="button" class="btn btn-primary text-center">مشاهدة
                    المزيد</button>

            </div>
        </div>
    </div>
    </div>


@stop
