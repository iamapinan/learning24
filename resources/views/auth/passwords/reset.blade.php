@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto mt-5">
            <h1 class="text-center font-weight-bold">รีเซ็ตรหัสผ่าน</h1>
            <div class="row">
                <form class="form-horizontal col-md-12 mt-3 mb-3 p-5" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label text-right d-inline-block">อีเมล</label>

                        <div class="col-md-6 d-inline-block">
                            <input id="email" type="email" class="form-control rounded-pill" name="email" value="{{ app('request')->input('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label text-right d-inline-block">รหัสผ่านใหม่</label>

                        <div class="col-md-6 d-inline-block">
                            <input id="password" type="password" class="form-control rounded-pill" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label text-right d-inline-block">รหัสผ่านอีกครั้ง</label>
                        <div class="col-md-6 d-inline-block">
                            <input id="password-confirm" type="password" class="form-control rounded-pill" name="password_confirmation" required>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-warning rounded-pill">
                                ตั้งรหัสผ่านใหม่
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
