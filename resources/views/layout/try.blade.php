@include('layout.head')




<div class="container mt-5 ">
    <div class=" w-100 mb-5">
        <div class="form-head text-center  " dir="rtl">
            <h1 class="form-head-title ">تأكيد البريد الالكتروني</h1>
        </div>
        <div class=" p-3  mx-auto" style="max-width: 500px" dir="rtl">
            <div class="content-form p-3 pt-1">

                @if ($success)

                    <div class="row row-cols-1 mx-auto text-center mb-5 align-items-center ">
                        <div class="col w-100">
                            <div class="icon-large-top">
                                <img style="max-width: 100px"
                                    src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/icons/check.png"
                                    alt="تم تأكيد بريدك الالكتروني بنجاح" />
                            </div>
                        </div>
                        <div class="col w-100 mt-3">
                            <p class="text-icon">
                                تم تأكيد بريدك الالكتروني بنجاح !
                                <span class="d-block font-Naskh text-secondary">
                                    تم تأكيد بريدك الالكتروني بنجاح, يمكنك الأن الدخول الى حسابك

                                </span>
                            </p>


                        </div>
                    </div>

                    <a href="{{ route('login') }}"><button type="button" class="btn btn-primary w-100">
                            حسابي</button></a>


                @else
                    <div class="row row-cols-1 mx-auto text-center mb-5 align-items-center">
                        <div class="col w-100">
                            <div class="icon-large-top">
                                <img style="max-width: 100px"
                                    src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/icons/alert.png"
                                    alt="فشل التحقق" />
                            </div>
                        </div>
                        <div class="col w-100 ">
                            <p class="text-icon">
                                فشل التحقق من بريدك الالكتروني
                                <span class="d-block font-Naskh text-secondary">
                                    لم نستطع تأكيد بريدك الالكتروني قد يكون الرابط غير صحيح أو قد انهت صلاحيته

                                </span>
                            </p>


                        </div>
                    </div>

                @endif

            </div>


        </div>

    </div>
</div>

@include('layout.footer')
