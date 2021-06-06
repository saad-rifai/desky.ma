<html>

<head>
    <title>طلب جديد - Desky.ma</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
</head>
<style>
    * {
        font-family: 'Tajawal', sans-serif;
    }

</style>
@php
$data = file_get_contents('database/data.json');
$json = json_decode($data, true);
@endphp

<body>
    <div class="content" style=" width: 100%;
    direction: rtl;
    margin-left: auto;
    margin-right: auto;
    display: block;
    background-color: #efefef;
text-align: center;
padding: 50px 0px;
    ">
        <img class="logo-message-9" style="    width: 100%;
        max-width: 220px;
        margin-left: auto;
        margin-right: auto;
        display: block;
        text-align: center;" src="https://desky.ma/logo%20web%20png.png"
            alt="Desky.ma">
        <div class="body_mesaage" style="    text-align: right;
            text-align: right;
    width: 100%;
    max-width: 600px;
    margin-left: auto;
    background-color: white;
    margin-right: auto;
    padding: 35px;
    font-size: 19px;
    margin-top: 20px;
    border-radius: 5px;
    position: relative;
    overflow:hidden;
">
            <div style="    position: absolute;
background-color: #f96009;
color: white;
width: 100%;
text-align: center;
padding: 5px;
transform: rotate(
316deg
);
left: -281px;
top: 54px;
opacity: 0.8;">في انتضار الدفع</div>
<br>

            <p class="message-content" style="    color: #585858;     color: #585858;
            text-align: right !important;
            direction: rtl !important;
        ">
                <span class="bold-text" style="
                    font-weight: 600;
                ">
                    مرحبا {{ Auth::user()->fname }} !
                </span>
                <br>

                طلب رقم #{{$content['OID']}} (اشتراك شهر في الباقة الابتدائية لمنصة desky.ma)
                <br>
                <br>
                @if ($content['method'] == 1)
                <span>يرجى التوجه الى أقرب وكالة وفاكاش مرفقا برمز الأداء التالي <strong
                        style="color: #f98019;">{{ $content['code'] }}</strong> قبل تاريخ <strong
                        style="color: #f98019;">{{ $content['exDate'] }}</strong> لأداء تكلفة اشتراكك من أجل تفعيل
                    باقتك</span>

            @else
                <span>ندعوك الى اجراء تحويل بنكي للحساب التالي:
                    <br>
                    <br>
                    <strong style="color: #f98019;">رقم الحساب: <span style="color: #494949;"
                            dir="ltr">{{ $json['NERYOU']['RIB'] }}</span></strong>
                    <br>
                    <strong style="color: #f98019;">اسم البنك: <span
                            style="color: #494949;">{{ $json['NERYOU']['BANK_NAME'] }}</span></strong>
                    <br>
                    <strong style="color: #f98019;">اسم الحساب: <span
                            style="color: #494949;">{{ $json['NERYOU']['BANK_ACCOUNT'] }}</span></strong>
                    <br>
                    <br>
                    قبل تاريخ <strong style="color: #f98019;">{{ $content['exDate'] }}</strong> لأداء تكلفة اشتراكك من
                    أجل
                    تفعيل باقتك</span>


            @endif
            <br>
            <br>
            <span style="    font-size: 17px;"> السعر: {{ $content['amount'] }} MAD</span>
            <br>
            <span style="    font-size: 17px;"> مصاريف اجرائية: {{ $content['frais'] }} MAD</span>
            <br>
            <span style="color: #f98019;
            font-weight: 600;
            font-size: 22px;">المجموع: {{ $content['total'] }} MAD</span>
            <br>
            <br>

            </p>
            <a href="{{ asset('/recu/'.$content['OID']) }}" target="_blank" style="
                padding: 10px 25px;
    background-color: #f98019;
    color: white;
    border: solid 1px #fffbf8;
    border-radius: 3px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: block;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
}
">الفاتورة</a>

            <br>
            <br>
            <small>
                طاب يومك,
                <br>
                فريق desky.ma
            </small>
        </div>
        <footer style="padding:10px;    font-size: 14px;
            direction: rtl;
            color: #9c9c9c;">
            <p style="    font-size: 12px;
            direction: rtl;
            text-align: center;
        ">منصة desky.ma تابعة لشركة NerYou LLC جميع الحقوق محفوظة {{ date('Y') }} &copy;
            </p>
        </footer>
    </div>
</body>

</html>
