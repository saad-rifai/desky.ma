<html>

<head>
    <title>رمز التحقق - desky.ma</title>
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
    text-align: center;
    padding: 50px 0px;">
        <img class="logo-message-9" style="width: 100%; max-width: 170px;"
            src="https://desky.ma/cdn/logo-web-gradient.png" alt="Desky.ma">
        <div dir="rtl" class="body_mesaage" style="    text-align: right;
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
            <p class="message-content" style="color: #262626; 
            text-align: right !important;
            direction: rtl !important;
        ">
                <span class="bold-text" style="
                    font-weight: 600;
                ">
                    مرحبا {{$content["fullname"]}} !
                </span>
                <br>
                <br>

                رمز التحقق الخاص بك هو: {{$content['otptoken']}}
                <br>
                <br>
                معلومات الجهاز:
                <br>
                عنوان الجهاز: {{$content['ip_adress']}}
                <br>
                تاريخ الطلب: {{date("Y-m-d H:i:s")}}
                <br>
                <br>
            </p>

            {{asset('/')}}
            <br>
            <br>
            <p dir="rtl" style="  color: #262626; text-align: right !important;
direction: rtl !important;">

                أطيب التحيات,
                نظام التحقق desky OTP
            </p>


        </div>
        <footer style="padding:10px;    font-size: 14px;
            direction: rtl;
            color: #9c9c9c;">
            <p style="    font-size: 12px;
            direction: rtl;
            text-align: center;
        ">
        تم ارسال هذه الرسالة لك لأنك قد قمت بمحاولة تسجيل دخول جديدة أو قمت بعملية تتطلب التحقق اذا لم تكن انت يرجى اعلام القسم التقني أو اخبار المشرف المباشر عليك
              
            </p>
        </footer>
    </div>
</body>

</html>
