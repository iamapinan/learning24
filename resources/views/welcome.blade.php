<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Learning 24') }}</title>
        <link rel="shortcut icon" type="image/png" href="/images/learning24.png"/>
        <link rel="shortcut icon" type="image/png" href="/images/learning24.png"/>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Sarabun:400,700" rel="stylesheet" type="text/css">
        <link href="/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
        <link href="/css/font-awesome/css/all.css" rel="stylesheet">
        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">

    </head>
    <body>
        <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light mb-5 shadow-sm">
            <a class="navbar-brand text-dark" href="{{ route('welcome') }}">
                <img src="{{ asset('images/learning24-sm.png') }}" class="logo-admin">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link btn btn-link-dark btn-sm text-dark rounded mr-2" href="{{ route('register') }}"><span class="fa fa-user-plus"></span> Register</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-link-warning btn-sm text-warning rounded" href="{{ route('login') }}"><span class="fa fa-sign-in"></span> Login</a></li>
                    @else
                    <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">แดชบอร์ด</a></li>
                    <li class="nav-item"><a class="nav-link text-info" href="{{ route('upload') }}"><i class="fa fa-cloud-upload" aria-hidden="true"></i> อัพโหลด</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="userNavmenu" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userNavmenu">
                            <a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-gear"></i> ตั้งค่าโปรไฟล์</a>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                    <form class="form-inline my-2 my-lg-0" method="GET" action="{{route('search')}}">
                        <input class="form-control mr-sm-2" type="search" name="q" placeholder="Search" aria-label="Search">
                    </form>
                    @endif
                </ul>
            </div>
        </nav>
        <div class="flex-center">
            <div class="container">
                <!-- align center -->
                <div class="d-flex flex-row justify-content-center mb-5">
                <!-- <div class="d-flex flex-row px-3"> -->
                    <div class="text-right d-sm-none d-none d-md-block d-lg-block">
                        <img src="images/256-transparent.png" alt="Learning 24 - Your learning platform">
                    </div>
                    <div class="flex-column">
                        <div class="title my-5">
                            Learning 24
                        </div>
                        <div class="subtitle my-3">
                            สื่อบทเรียน อิเล็คทรอนิกส์ ครอบคลุม 8 กลุ่มสาระการเรียนรู้ ระดับมัธยมศึกษา
                        </div>
                        <div class="text-left my-5">
                            <a href="{{ url('/register') }}" class="btn btn-outline-dark btn-lg">สมัครสมาชิกใหม่</a>
                            <a href="{{ url('/login') }}" class="btn btn-warning btn-lg">เข้าสู่ระบบ</a>
                        </div>
                    </div>
                </div>
                <h3>เนื้อหาครอบคลุ่ม 8 กลุ่มสาระ และอื่นๆ ตั้งแต่ ม.1-ม.6</h3>
                <div class="d-flex flex-column justify-content-center my-5">
                    <div class="row d-flex flex-row  justify-content-center w-100 mb-3 text-center">
                        <div class="col-sm rounded bg-light mx-3 p-3">
                        คณิตศาสตร์
                        </div>
                        <div class="col-sm rounded bg-light mx-3 p-3">
                        วิทยาศาสตร์และเทคโนโลยี
                        </div>
                        <div class="col-sm rounded bg-light mx-3 p-3">
                        ภาษาไทย
                        </div>
                        <div class="col-sm rounded bg-light mx-3 p-3">
                        ภาษาต่างประเทศ
                        </div>
                    </div>
                    <div class="row d-flex flex-row justify-content-center w-100  text-center">
                        <div class="col-sm rounded bg-light mx-3 p-3">
                        ศิลปะ
                        </div>
                        <div class="col-sm rounded bg-light mx-3 p-3">
                        สังคมศึกษาฯ
                        </div>
                        <div class="col-sm rounded bg-light mx-3 p-3">
                        สุขศึกษาและพลศึกษา
                        </div>
                        <div class="col-sm rounded bg-light mx-3 p-3">
                        การงานอาชีพ
                        </div>
                        <div class="col-sm rounded bg-light mx-3 p-3">
                        อื่นๆ
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-center my-5">
                    <!-- copyright session -->
                    <div class="text-center text-sm text-secondary">
                        Copyright © 2019 Learning 24. All rights reserved.
                    </div>
                </div> 
            </div>
        </div>
    </body>
</html>
