<html>

<head>
    <title>رسالة اعادة تعيين كلمة السر - Desky.ma</title>
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
            <p class="message-content" style="color: #262626; 
            text-align: right !important;
            direction: rtl !important;
        ">
                <span class="bold-text" style="
                    font-weight: 600;
                ">
                    مرحبا !
                </span>
                <br>
                <br>

                لقد طلبت إستعادة كلمة المرور الخاصة بك في desky.
                <br>
                <br>
                إذا كنت ترغب بتغيير كلمة المرور الخاصة بك يرجى الضغط على الزر التالي:
                <br>
                <br>
            </p>
            <a href="{{ asset('ResetPassword/reset/' . $content['token'] . '') }}" target="_blank" style="
    padding: 10px 25px;
    background-color: #F9600A;
    color: white;
    border: solid 1px #fffbf8;
    font-size: 15px;
    border-radius: 30px;
    font-weight: 500;
    text-decoration: none;
">اعادة تعيين كلمة المرور</a>

            <br>
            <br>
            <p dir="rtl" style="  color: #262626; 
text-align: right !important;
direction: rtl !important;
">
                إن لم تكن تتوقع وصول هذه الرسالة وتظن أنها وصلتك بالخطأ يمكنك تجاهلها.
                <br>
                <br><br>

                أطيب التحيات,
                فريق desky
            </p>


        </div>
        <footer style="padding:10px;    font-size: 14px;
            direction: rtl;
            color: #9c9c9c;">
            <p style="    font-size: 12px;
            direction: rtl;
            text-align: center;
        ">تم ارسال هذه الرسالة لك لأنك طلبت اعادة تعيين كلمة المرور اذا لم تكن أنت يرجى تجاهل هذه الرسالة <br>
                اذا لم يشتغل معك الزر يرجى الظغط على <a
                    href="{{ asset('reset_password/reset/' . $content['token'] . '') }}">الرابط التالي</a>
            </p>
        </footer>
    </div>
</body>

</html>
