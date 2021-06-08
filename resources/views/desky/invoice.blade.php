@extends('desky.panel.headform')
@section('title', 'طلب رقم #' . $OID)
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')

@section('content')
    @php
    $datajson = file_get_contents('database/data.json');
    $jsondata = json_decode($datajson, true);
    setlocale(LC_MONETARY, 'ar_MA');

    @endphp
    <br>
    <br>
    <div>
        <div
        id="Upload-Recu-Video"
        dir="rtl"
        class="uk-flex-top uk-text-right"
        uk-modal
      >
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <h2 class="uk-card-title">ماذا يجب أن أفعل الأن ؟</h2>
<hr>
          <p class=" uk-text-right ">
              يجب أن تقوم بتحويل تكلفة طلبك  {{ number_format($amount + $frais, 2) }} درهم الى الحساب البنكي التالي:
              <br>
              البنك: {{ $jsondata['NERYOU']['BANK_NAME'] }}
              <br>
              اسم الحساب: {{ $jsondata['NERYOU']['BANK_ACCOUNT'] }}
              <br>
              رقم الحساب: <span dir="ltr"> {{ $jsondata['NERYOU']['RIB'] }}</span>
              <br>
              <span dir="rtl"> رمز البنك: {{ $jsondata['NERYOU']['SWIFTCODE'] }}</span>
              <br>
              من خلال الاداع اليدوي لدى البنك أو اجراء تحويل بنكي من خلال تطبيق الهاتف.. بعدها يجب رفع وصل الأداء كما هو موضح في الفيديو التالي:
              <div class="videoWrapper">

              <iframe  width="560" height="315" src="https://www.youtube.com/embed/y0FhqJywlL8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
            </p>
        </div>
      </div>
        <div class="wd-80 uk-margin-small-top uk-margin-small-bottom">
            <div class="uk-card-default uk-padding uk-text-right" style="overflow: hidden;">
                <div class="recu-header" style="position: relative">
                    @if (isset($exDate) && $exDate != '' && $exDate != null && $status == 0 && date('Y-m-d H:i:s') > $exDate)
                        <div class="Expiry-date-badge">انتهت الصلاحية</div>
                    @endif
                    <span class="uk-label
                    @php if ($status == 0) {
                            echo 'uk-label-warning';
                        } elseif ($status == 1) {
                            echo 'uk-label-success';
                        } elseif ($status == 2) {
                            echo 'uk-label-pending';
                        } elseif ($status == 3) {
                            echo 'uk-label-warning';
                        } elseif ($status == 4) {
                            echo 'uk-label-danger';
                        } elseif ($status == 5) {
                            echo 'uk-label-pending';
                    }
                    @endphp ">{{ $jsondata['payments_status'][$status]['ar'] }}</span>

                </div>
                <hr class="uk-divider-icon">
                <br>
                <div class="recu-body" style="position: relative">
                    <div class="brand-logo-hidden">
                    </div>
                    <h1 class="uk-card-title uk-text-center code-pay-border" dir="rtl"> #{{ $OID }}</h1>

                    <table class="uk-table  " dir="rtl">
                        <tbody>
                            <tr>
                                <td><span class="uk-text-emphasis uk-text-bold">الطلب:</span></td>
                                <td><span class="uk-text-light uk-text-emphasis">اشتراك @if ($type == 'm') شهر @else سنة @endif في
                                        {{ $jsondata['_' . $PID]['packs'][$pack_id]['name'] }} لمنصة Desky.ma</span></td>
                            </tr>
                            <tr>
                                <td><span class="uk-text-emphasis uk-text-bold">وسيلة الدفع:</span></td>
                                @if ($method == 1)
                                    <td><span class="uk-text-light uk-text-emphasis">الدفع نقداََ عبر وكالة وفاكاش
                                            (Binga)</span></td>

                                @elseif ($method == 2)
                                    <td><span class="uk-text-light uk-text-emphasis">الدفع عبر تحويل بنكي</span></td>

                                @endif
                            </tr>
                            @if (isset($CODE))
                                <tr>
                                    <td><span class="uk-text-emphasis uk-text-bold">رقم الأداء (Binga):</span></td>
                                    <td><span class="uk-text-light uk-text-bold">{{ $CODE }}</span></td>
                                </tr>
                            @endif

                            <tr>
                                <td><span class="uk-text-emphasis uk-text-bold">رقم الطلبية:</span></td>
                                <td><span class="uk-text-light uk-text-emphasis">{{ $OID }}</span></td>
                            </tr>

                            <tr>
                                <td>تكلفة الخدمة:</td>
                                <td class="labelcart">

                                    <span>
                                        {{ number_format($amount, 2) }} MAD
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رسوم إجرائية:
                                    <span uk-icon="icon:info"
                                        uk-tooltip="title: يتم فرض هذه الرسوم من قبل بوابات الدفع مثل Binga, Visa, Mastercard, CMI; pos: left"></span>
                                </td>
                                <td class="labelcart">
                                    <span>
                                        {{ number_format($frais, 2) }} MAD
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h4>المجموع:</h4>
                                </td>
                                <td class="">
                                    <h4 class="labelcart_green">
                                        <span>
                                            {{ number_format($amount + $frais, 2) }} MAD
                                        </span>

                                        <br />
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="">
                                    <small>السعر شامل الضريبة (TVA)</small>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    @if ($method == '2' && $status == 0)
                        <sendrecu :oid="'{{ $OID }}'" :amount="{{ $amount + $frais }}"></sendrecu>
                    @endif

                    @if($status == 0)
                    @if ($method == 1)

                        <div class="uk-alert-primary" dir="rtl" uk-alert>
                            <p><span uk-icon="icon:  chevron-double-left"></span> يجب التوجه الى أقرب وكالة وفاكاش مرفقا
                                برقم الأداء: {{ $CODE }} وأداء المبلغ المستحق من أجل تفعيل باقتك <br>

                                <span uk-icon="icon:  chevron-double-left"></span> أخر أجال للأداء: {{ $exDate }}
                                <br>

                                <span uk-icon="icon:  chevron-double-left"></span> فور الدفع عبر وكالة وفاكاش سيتم تفعيل
                                باقتك تلقائياََ ان واجهتك مشكلة في الدفع يرجى التواصل مع قسم المبيعات sales@desky.ma
                                <br>

                                <span uk-icon="icon:  location"></span> <a target="_blank"
                                    href="https://www.wafacash.com/reseau?ref=desky.ma" class="uk-link-text">وكالات
                                    وفاكاش</a>
                            </p>
                        </div>
                    @elseif ($method == 2)
                    <div style="z-index: 1; position:relative">
                        <a href="#Upload-Recu-Video" uk-toggle class="uk-link-text"> ماذا يجب أن أفعل الأن ؟ <span uk-icon="icon:  info"></span></a>

                    </div>
                        <div class="uk-alert-primary" dir="rtl" uk-alert>
                            <p><span uk-icon="icon:  chevron-double-left"></span> يجب تحويل تكلفة
                                {{ number_format($amount + $frais, 2) }} الطلب الى الحساب التالي <br>
                                <br>
                                البنك: {{ $jsondata['NERYOU']['BANK_NAME'] }}
                                <br>
                                اسم الحساب: {{ $jsondata['NERYOU']['BANK_ACCOUNT'] }}
                                <br>
                                رقم الحساب: <span dir="ltr"> {{ $jsondata['NERYOU']['RIB'] }}</span>
                                <br>
                                <span dir="rtl"> رمز البنك: {{ $jsondata['NERYOU']['SWIFTCODE'] }}</span>
                                <br>
                                <br>

                                @if ($exDate != null)
                                    <br>
                                    <span uk-icon="icon:  chevron-double-left"></span> أخر أجال للأداء: {{ $exDate }}
                                    <br>
                                @endif
                                <span uk-icon="icon:  chevron-double-left"></span> فور تحويل المبلغ يجب رفع وصل الأداء في
                                الأعلى سيتم معالجة طلبك في غضون 48 ساعة كحد أقصى باستثناء ايام العطل الرسمية
                                <br>

                                <span uk-icon="icon:  warning"></span> تنبيه: يرجى رفع وصل أداء لهذه الطلبية من أجل تجنب
                                تأخير معالجة طلبك
                                <br>
                            </p>
                        </div>
                    @endif
                    @endif
                    <p class="uk-text-center" uk-margin dir="rtl">
                        <a target="_blank" href="/print/recu/{{ $OID }}"><button class="uk-button uk-button-primary">طباعة الفاتورة</button></a>

                        <a href="/u"> <button class="uk-button uk-button-default">حسابي</button></a>
                    </p>
                </div>


            </div>

        </div>
    </div>
    <br>
    <br>
@endsection
