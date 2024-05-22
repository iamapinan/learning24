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
        @if(!Auth::guest() && Auth::user()->role_id == 1 && Auth::user()->user_org_id == null)
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i> หน้าแรก</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('subjects') }}"><span class="fa fa-folder"></span> กลุ่มสาระวิชา</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('contents') }}"><i class="fa fa-book" aria-hidden="true"></i> จัดการเนื้อหา</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('users') }}"><i class="fas fa-users" aria-hidden="true"></i> จัดการสมาชิก</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('org-manager') }}"><i class="fas fa-building" aria-hidden="true"></i> จัดการองค์กร</a></li>
        @endif
        </ul>
        
        
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
            <li class="nav-item"><a class="nav-link btn btn-link-warning btn-sm text-warning rounded" href="{{ route('login') }}"><span class="fa fa-sign-in-alt"></span> เข้าสู่ระบบ</a></li>
            @else
            <li class="nav-item">
                <a class="nav-link btn text-dark" href="{{ route('explore') }}">
                    <i class="fa fa-book-open"></i>
                    คลังความรู้ส่วนกลาง
                </a>
            </li>
            @if (Auth::user()->user_org_id != null)
            <li class="nav-item">
                <a class="nav-link btn text-dark" href="/org/{{Auth::user()->user_org_id}}">
                    <i class="fa fa-building"></i>
                    สำหรับองค์กร
                </a>
            </li>
            @endif

            
                @if(!Auth::guest() && Auth::user()->role_id == 1)
                <li class="nav-item"><a class="nav-link btn btn-warning btn-sm text-dark rounded-pill px-3" href="{{ route('upload') }}"><i class="fa fa-upload" aria-hidden="true"></i> อัพโหลด</a></li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark" id="userNavmenu" role="button">
                        <i class="fa fa-user-circle"></i> {{ Auth::user()->name }}
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
