<html>

<head>
    <title>رسالة تأكيد الحساب - Desky.ma</title>
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
        <img class="logo-message-9" style="width: 100%; max-width: 220px;" src="https://desky.ma/logo-desky.png?ref=sendmail&palat=desky"
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
                    مرحبا {{ Auth::user()->fname }} !
                </span>
                <br>
          
                شكراََ لك للانظمام لنا رجاءا قم بتأكيد بريدك الالكتروني من خلال الضغط على الزر أسفله.
            </p>
            <a href="{{ asset('verfymail/'.Auth::user()->id.'/'.$content["token"].'') }}" target="_blank" style="   padding: 10px 25px;
            background-color: #f98019;
            color: white;
            border: solid 1px #fffbf8;
            border-radius: 3px;
            font-size: 15px;
            font-weight: 500; 
cursor: pointer;
text-decoration: none;
">تفعيل الحساب</a>



        </div>
        <footer style="padding:10px;    font-size: 14px;
            direction: rtl;
            color: #9c9c9c;">
            <p style="    font-size: 12px;
            direction: rtl;
            text-align: center;
        ">تم ارسال هذه الرسالة لك لأنك سجلت بمنصة desky.ma اذا لم تكن أنت يرجى تجاهل هذه الرسالة <br>
                اذا لم يشتغل معك الزر يرجى الظغط على الرابط التالي {{ asset('verfymail/'.Auth::user()->id.'/'.$content["token"].'') }}
            </p>
        </footer>
    </div>
</body>

</html>
