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
            <a class="navbar-brand text-dark font-weight-bold" href="{{ route('welcome') }}">
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
                    <li class="nav-item"><a class="nav-link btn btn-link-warning btn-sm text-warning rounded" href="{{ route('login') }}"><span class="fa fa-sign-in-alt"></span> เข้าสู่ระบบ</a></li>
                    @else
                    
                    @if(!Auth::guest() && Auth::user()->is_admin)
                    <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">แดชบอร์ด</a></li>
                    <li class="nav-item"><a class="nav-link text-info" href="{{ route('upload') }}"><i class="fa fa-cloud-upload" aria-hidden="true"></i> อัพโหลด</a></li>
                    @endif
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-dark" id="userNavmenu" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userNavmenu">
                            <a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user-cog"></i> ตั้งค่าโปรไฟล์</a>
                            @if(Auth::user()->email_verified == 0)
                                <a class="dropdown-item text-danger" href="{{ route('verification.resend') }}"><i class="fas fa-exclamation-triangle"></i> ส่งอีเมล์ยืนยันอีกครั้ง</a>
                            @endif
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                    
                    @endif
                </ul>
            </div>
        </nav>
        <div class="flex-center">
            <div class="container">
                <!-- align center -->
                <div class="d-flex flex-row justify-content-center mb-5">
                    <div class="text-right d-sm-none d-none d-md-block d-lg-block">
                        <img src="images/home.png" width="480" alt="Learning 24 - Your learning platform">
                    </div>
                    <div class="flex-column mt-5 px-5">
                        <div class="title my-5 font-weight-bold">
                            LEARNING <span class="text-yellow">24</span>
                        </div>
                        <div class="subtitle my-3">
                            สื่อบทเรียน อิเล็คทรอนิกส์ ครอบคลุม 8 กลุ่มสาระการเรียนรู้ ระดับประถมศึกษาและระดับมัธยมศึกษา
                        </div>
                        <div class="text-left mt-5">
                            @if(Auth::guest())
                            <a href="{{ url('/login') }}" class="btn btn-warning btn-md rounded-pill px-5">
                                <i class="fa fa-sign-in-alt"></i> เข้าสู่ระบบ</a>
                            @else
                            <a href="{{ url('/explore') }}" class="btn btn-dark btn-md rounded-pill px-5 mr-3">
                                <i class="fa fa-search"></i> สำรวจเนื้อหา</a>
                            @endif
                        </div>
                    </div>
                </div>
                <h3 class="position-relative pl-3 pt-3 border-bottom font-weight-bold">เนื้อหาครอบคลุ่ม 8 กลุ่มสาระ และอื่นๆ ตั้งแต่ ม.1-ม.6</h3>
                <div class="d-flex flex-column justify-content-center my-5">
                    
                    <div class="row d-flex flex-row  justify-content-center w-100 mb-3 text-center">
                        @foreach($subcats as $subcat)
                        <a href="{{url('/explore?subject=' . $subcat->id)}}" class="btn rounded-xl bg-light mx-3 my-3 p-3">
                            {{$subcat->title}}
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-center my-5">
                    <div class="text-center text-sm text-secondary">
                        Copyright © 2019 Learning 24. All rights reserved.
                    </div>
                </div> 
            </div>
        </div>
        <!-- script -->
        <script src="/js/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="/css/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
