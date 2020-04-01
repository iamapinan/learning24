<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Digital World</title>
        <link rel="shortcut icon" type="image/png" href="/images/icon.png"/>
        <link rel="shortcut icon" type="image/png" href="/images/icon.png"/>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background: url('storage/welcome.jpg') no-repeat;
                background-size: cover;
                color: #ffffff;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #ffffff;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .subtitle {
                display: block;
                margin: 10px auto;
                margin-bottom: 25px;
                color: #dedede;
                font-size: 18px;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            .store-icon{
                width: 180px;
                height: auto;
            }
            .bottom-info{
                position: fixed;
                bottom: 20px;
                left: 0px;
                text-align: center;
                width: 100%;
            }
            .bottom-info p {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <!-- <a href="{{ url('/register') }}">Register</a> -->
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Digital World
                </div>
                <div class="subtitle">
                    แอพพลิเคชั่นหนังสือ ที่คุณเองก็สามารถสร้างหนังสือของตัวเองได้ <span class="label label-danger">ทดลองใช้ก่อนเลยฟรี</span>
                </div>
                <p class="text-center">
                    <a href="{{ url('/login') }}" class="btn btn-primary btn-lg">Let's Login</a>
                    <a href="{{ url('/#') }}" class="btn btn-danger btn-lg">Try a free evaluate</a>
                </p>
                <div class="bottom-info">
                    <p class="subtitle">
                        ดาวน์โหลดไฟล์แล้วที่ 
                        <a href="https://play.google.com/store/apps/details?id=com.digitalworld.iotech">
                            <img src="{{ asset('images/googleplay.png') }}" alt="Logo" class="store-icon">
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
