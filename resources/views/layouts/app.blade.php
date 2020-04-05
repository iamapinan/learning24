<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="shortcut icon" type="image/png" href="/images/icon.png"/>
    <link rel="shortcut icon" type="image/png" href="/images/icon.png"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Learning 21') }}</title>
    <!-- Script -->
    <script src="/js/jquery-3.4.1.slim.min.js"></script>
    <script src="/css/bootstrap/js/bootstrap.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <link href="/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark mb-5">
    <a class="navbar-brand text-bold" href="{{ route('welcome') }}">
        <img src="{{ asset('images/icon32.png') }}" alt="Play Store" class="logo-admin">
        {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        @if(!Auth::guest() && Auth::user()->admin == 0)
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i> หน้าแรก</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('book') }}"><i class="fa fa-book" aria-hidden="true"></i> หนังสือของฉัน</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('list') }}"><img src="/images/books-icon.png" aria-hidden="true"> ชั้นหนังสือ</a></li>
        @endif
        <!-- for Admin -->
        @if(!Auth::guest() && Auth::user()->admin == 1)
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i> หน้าแรก</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('report') }}"><i class="fa fa-users" aria-hidden="true"></i> สถิติ</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('books') }}"><i class="fa fa-book" aria-hidden="true"></i> หนังสือทั้งหมด</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('banner') }}"><i class="fa fa-image" aria-hidden="true"></i> แบนเนอร์</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('users') }}"><i class="fa fa-user" aria-hidden="true"></i> สมาชิก</a></li>
        @endif
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
            <li class="nav-item"><a class="nav-link text-warning btn btn-link px-3" href="https://fliphtml5.com/login.php" class="nav-link"><i class="fa fa-book"></i> สร้างหนังสือใหม่</a></li>
            <li class="nav-item"><a class="nav-link text-primary" href="{{ route('register') }}"><span class="fa fa-user-plus"></span> Register</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><span class="fa fa-sign-in"></span> Login</a></li>
            @else
            @if(Auth::user()->email_verified == 0)
                <li class="nav-item"><a class="nav-link text-danger"><i class="fa fa-warning" aria-hidden="true"></i> กรุณายืนยันอีเมล์</a></li>
            @endif
            <li class="nav-item"><a class="nav-link text-warning" href="https://fliphtml5.com/login.php" class="nav-link"><i class="fa fa-book"></i> สร้างหนังสือใหม่</a></li>
            <li class="nav-item"><a class="nav-link text-info" href="{{ route('upload') }}"><i class="fa fa-cloud-upload" aria-hidden="true"></i> อัพโหลด</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="userNavmenu" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="userNavmenu">
                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-gear"></i> ตั้งค่าโปรไฟล์</a>
                    @if(Auth::user()->email_verified == 0)
                        <a class="dropdown-item" href="{{ route('verification.resend') }}"><i class="fa fa-warning text-primary"></i> ส่งอีเมล์ยืนยันอีกครั้ง</a>
                    @endif
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
    @yield('content')
    <p class="text-center px-5 mt-5">
        Powered by <a href="http://digitalworld2u.com/">Digital World Association</a> Thailand. 
        Make with <span class="text-danger text-bold"><i class="fa fa-heart"></i></span> // <span class="text-danger">Fighting with Covid-19</span>
    </p>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
