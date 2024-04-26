@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto mt-5">
            <h1 class="text-center font-weight-bold">เข้าสู่ระบบ</h1>
            <div class="row">
                <form class="form-horizontal col-md-12 mt-3 mb-3 p-5" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    @if (session('confirmation'))
                        <div class="alert alert-info" role="alert">
                            {!! session('confirmation') !!}
                        </div>
                    @endif
                    @if ($errors->has('confirmation') > 0 )
                        <div class="alert alert-danger" role="alert">
                            {!! $errors->first('confirmation') !!}
                        </div>
                    @endif
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label text-right d-inline-block">อีเมล</label>
                        <div class="col-md-6 d-inline-block">
                            @if (isset($_GET['redirectTo']))
                                <input type="hidden" name="redirectTo" value="{{ $_GET['redirectTo'] }}">
                            @endif
                            <input id="email" type="email" class="form-control rounded-pill" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label text-right d-inline-block">รหัสผ่าน</label>
                        <div class="col-md-6 d-inline-block">
                            <input id="password" type="password" class="form-control rounded-pill" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 offset-md-4 mb-3">
                            <a class="btn-link" href="{{ route('password.request') }}">
                                ลืมรหัสผ่าน?
                            </a>
                        </div>
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-warning mr-3 rounded-pill">
                                เข้าสู่ระบบ
                            </button>
                            <a href="{{ route('register') }}" type="submit" class="btn btn-light rounded-pill">
                                ลงทะเบียนสมาชิก
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
