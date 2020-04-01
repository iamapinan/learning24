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

    <title>{{ config('app.name', 'Digital World') }}</title>
    <!-- Script -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
        @if(!Auth::guest() && Auth::user()->admin == 1)
        <nav class="navbar navbar-inverse  navbar-fixed-top">
        @endif

        @if(Auth::guest() || Auth::user()->admin == 0)
        <nav class="navbar navbar-default navbar-fixed-top">
        @endif

            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo32.png') }}" alt="Play Store" class="logo-admin">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                    <!-- for Normal user -->
                    @if(!Auth::guest() && Auth::user()->admin == 0)
                        <li><a href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i> หน้าแรก</a></li>
                        <!-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Upload <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('home') }}"><i class="fa fa-cloud-upload" aria-hidden="true"></i> อัพโหลดแฟ้มผลงาน</a></li>
                                <li><a href="{{ route('book') }}"><i class="fa fa-book" aria-hidden="true"></i> อัพโหลดหนังสือ</a></li>
                            </ul>
                        </li> -->
                    @endif
                    <!-- for Admin -->
                    @if(!Auth::guest() && Auth::user()->admin == 1)
                        <li><a href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a></li>
                        <li><a href="{{ route('book') }}"><i class="fa fa-book" aria-hidden="true"></i> Book</a></li>
                        <li><a href="{{ route('banner') }}"><i class="fa fa-image" aria-hidden="true"></i> Banner</a></li>
                        <li><a href="{{ route('user') }}"><i class="fa fa-user" aria-hidden="true"></i> User</a></li>
                        <li><a href="{{ route('upload') }}"><i class="fa fa-users" aria-hidden="true"></i> Group</a></li>
                    @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <!-- <li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('home') }}"><i class="fa fa-gear" aria-hidden="true"></i> ตั้งค่าโปรไฟล์</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    <p align="center">Powered by iOTech</p>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
