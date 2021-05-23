@php
use App\Subscriptions;
  $infos = Subscriptions::all()->where("email", Auth::user()->email);

@endphp
<div class="uk-child-width-1-2@m uk-grid-small uk-grid-match" uk-grid>
    @foreach($infos as $info)

    <div>

        @php
  $orgdate = $info->created_at;
  $pack_id = $info->pack_id;
  $newDate = date("d-m-Y", strtotime($orgdate));
  $datajson = file_get_contents('database/data.json');
$jsondatas = json_decode($datajson, true);
$points = $jsondatas['packs'][$pack_id]['points'];
$price = $jsondatas['packs'][$pack_id]['price'];
$time_payments = $jsondatas['packs'][$pack_id]['time_payments'];
$c_points = $info->point;
$consumption = ($points-$c_points);
        @endphp
        <div class="uk-card uk-card-default uk-card-body uk-text-right uk-flex">
            <div class="icon-big uk-margin-left"><i class="fas fa-box"></i></div>
            <div><h1 class="uk-card-title">الباقة الابتدائية</h1>
                <p dir="rtl">@if($points == "unlimited") غير محدود @else {{$points}} @endif دوفي / عرض أسعار <br>({{$time_payments}}/{{$price}}Dhs)</p>
                <p>
                    <span uk-icon="icon:clock; ratio:0.7"></span> تاريخ البدء: {{$newDate}}
                    <br>

                    <span uk-icon="icon:clock; ratio:0.7"></span>  تاريخ الانتهاء: 14/05/2021
                </p>
                <a href="#"> <span uk-icon="icon:cog"></span> تعديل</a>
            </div>

        </div>

    </div>

    <div>
        <div class="uk-card uk-card-default uk-card-body uk-text-right uk-flex">
            <div class="icon-big uk-margin-left"><i class="fas fa-chart-pie"></i></div>
            <div><h1 class="uk-card-title">استهلاكي
            </h1>
     <p> تم استهلاك {{$consumption}} نقاط من {{$points}} نقطة </p>
            <p> الرصيد المتبقي {{$points-$consumption}}</p>

            </div>

        </div>
    </div>
    @endforeach
    @if(count($infos) < 1)
    <div class="uk-card uk-card-default uk-card-body uk-text-right uk-flex " style="    position: relative !important;
    height: 250px;">
        <div class="uk-text-center uk-position-center">

            <p>اكتشف العروض والباقات</p>
            <button class="uk-button uk-button-primary btn-call">الاشتراك بباقة</button>

        </div>



    </div>
    @endif
</div>
