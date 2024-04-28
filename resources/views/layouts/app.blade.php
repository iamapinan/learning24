<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    @if(isset($og))
    {!! $og->renderTags() !!}
    @endif
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }}</title>
    <!-- Script -->
    <script src="/js/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="/css/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" integrity="sha256-T/f7Sju1ZfNNfBh7skWn0idlCBcI3RwdLSS4/I7NQKQ=" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css').'?v='.filemtime('css/app.css') }}" rel="stylesheet">
    <link href="/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <link href="/css/font-awesome/css/all.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light mb-3">
    <a class="navbar-brand text-dark font-weight-bold" href="{{ route('welcome') }}">
        <img src="{{ asset('images/learning24-sm.png') }}" class="logo-admin">
        {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
  
        <!-- for Admin -->
        @if(!Auth::guest() && Auth::user()->role_id == 1)
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i> หน้าแรก</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('subjects') }}"><span class="fa fa-folder"></span> กลุ่มสาระวิชา</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('contents') }}"><i class="fa fa-book" aria-hidden="true"></i> จัดการเนื้อหา</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('users') }}"><i class="fas fa-users" aria-hidden="true"></i> สมาชิก</a></li>
        @endif
        </ul>
        
        
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
            <li class="nav-item"><a class="nav-link btn btn-link-warning btn-sm text-warning rounded" href="{{ route('login') }}"><span class="fa fa-sign-in-alt"></span> เข้าสู่ระบบ</a></li>
            @else
            <li class="nav-item"><a class="nav-link btn text-dark" href="{{ route('explore') }}"><svg width="16" height="16" fill="orange" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M190.4 74.1c5.6-16.8-3.5-34.9-20.2-40.5s-34.9 3.5-40.5 20.2l-128 384c-5.6 16.8 3.5 34.9 20.2 40.5s34.9-3.5 40.5-20.2l128-384zm70.9-41.7c-17.4-2.9-33.9 8.9-36.8 26.3l-64 384c-2.9 17.4 8.9 33.9 26.3 36.8s33.9-8.9 36.8-26.3l64-384c2.9-17.4-8.9-33.9-26.3-36.8zM352 32c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32s32-14.3 32-32V64c0-17.7-14.3-32-32-32z"/></svg> คลังความรู้</a></li>

            
            @if(!Auth::guest() && Auth::user()->role_id == 1)
            <li class="nav-item"><a class="nav-link btn btn-warning btn-sm text-dark rounded-pill px-3" href="{{ route('upload') }}"><i class="fa fa-upload" aria-hidden="true"></i> อัพโหลด</a></li>
            <li class="nav-item">
                <a href="#" class="nav-link text-warning" id="userNavmenu" role="button">
                    <i class="fa fa-star"></i> {{ Auth::user()->name }}
                </a>
            </li>
            @else
            <li class="nav-item">
                <a href="#" class="nav-link text-secondary" id="userNavmenu" role="button">
                    <i class="fa fa-user-circle"></i> {{ Auth::user()->name }}
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link text-dark" role="button" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
            
            @endif
        </ul>
    </div>
    </nav>
    @yield('content')
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
