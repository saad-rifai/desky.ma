<html>

<head>
    <title>تم تفعيل باقتك - Desky.ma</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
</head>
<style>
    * {
        font-family: 'Tajawal', sans-serif;
    }

</style>

<body>
    <div class="content" style="width: 100%;
        direction: rtl;
        margin-left: auto;
        margin-right: auto;
        display: block;
        background-color: #efefef;
    text-align: center;
    padding: 50px 0px;">
        <img class="logo-message-9" style="width: 100%; max-width: 220px;" src="https://desky.ma/logo%20web%20png.png"
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
">
            <p class="message-content" style="    color: #585858;     color: #585858;
            text-align: right !important;
            direction: rtl !important;
        ">
                <span class="bold-text" style="
                    font-weight: 600;
                ">
                    مرحبا !
                </span>
                <br>
                نعلمك بأنه قد تلقينا دفعتك وقد تم تفعيل باقتك طلب رقم {{$content['OID']}} يمكنك الأن استخدام باقتك,

                <br>
                <br>
                <span style="    font-size: 17px;">تفاصيل الطلب</span>
                <br>

                <span style="    font-size: 17px;"> السعر: {{ $content['amount'] }} MAD</span>
<br>

                <br>


            </p>

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
