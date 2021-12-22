@extends('layout.master')
@section('title', 'مركز المساعدة')

@section('content')

<div class="container mt-5 mb-5">
    <div class="w-100 row row-cols-1 mx-auto text-center mb-5 align-items-center ">
        <div class="col w-100">
            <div class="icon-large-top">
                <img style="max-width: 350px"
                    src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/asset/Electrician-bro.png"
                    alt="قيد التطوير" />
            </div>
        </div>
        <div class="col w-100 mt-3">

            <p class="text-icon" dir="rtl">
             قريبا...
                <span class="d-block font-Naskh text-secondary">
                     لازال مركز المساعدة قيد التطوير عد لاحقاََ    
                </span>
            </p>

    
        </div>
        <div class="col mt-5 w-100" id="app">
            <new-ticket></new-ticket>
                <h5 class="card-title w-100 mb-5">هل تحتاج المساعدة ؟ لاتقلق لازال بامكاننا مساعدتك </h5>
                <div class="row mx-auto text-center justify-content-md-center">
                    <div class="col-sm mb-3 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/icons/683-female-customer-service-outline.png" width="40px" class="icon-card" alt="desky.ma">

                              <h5 class="card-title">تواصل مع الدعم</h5>
                              <p class="card-text font-Naskh">قم بفتح تذكرة موضحا فيها طلبك وسيتم الرد عليك في غضون 48 ساعة كحد أقصى </p>
                            @auth
                            <a href="#NewTicketModal" type="button" data-toggle="modal" data-target="#NewTicketModal"class="btn btn-primary">تواصل مع الدعم </a>
                            @else
                            <a href="/login?redirect={{url()->current()}}" type="button" class="btn btn-primary">يجب تسجيل الدخول</a>

                            @endauth
                            </div>
                          </div>
                    </div>
                    <div class="col-sm mb-3 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/icons/175-envelope-mail-notification-arrow-up-outline.png" width="40px" class="icon-card" alt="desky.ma">

                              <h5 class="card-title">تواصل معنا عبر البريد الالكتروني</h5>
                              <p class="card-text font-Naskh">أرسل رسالة موضحا فيها طلبك وسيتم الرد عليك في غضون 48 ساعة كحد أقصى</p>
                              <a href="mailto:support@desky.ma" class="btn btn-primary">support@desky.ma</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-sm mb-3 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/icons/112-book-morph-outline.png" width="40px" class="icon-card" alt="blog.desky.ma">

                              <h5 class="card-title">اطلع على المدونة</h5>
                              <p class="card-text font-Naskh">نقوم بنشر دروس ونصائح للمقاول الذاتي واصحاب الأعمال بشكل دوري</p>
                              <a href="https://blog.desky.ma/?ref=help_center_desky" target="_blank" class="btn btn-primary">زيارة المدونة</a>
                            </div>
                          </div>
                    </div>
                </div>

        </div>
    </div>
    

</div>
@stop

    