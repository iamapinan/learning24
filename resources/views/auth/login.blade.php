@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h1 class="text-center">Login</h1>
            <div class="row">
                <form class="form-horizontal col-md-12 mt-3 mb-3 p-5 rounded shadow" method="POST" action="{{ route('login') }}">
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
                        <label for="email" class="col-md-4 control-label text-right d-inline-block">E-Mail Address</label>
                        <div class="col-md-6 d-inline-block">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label text-right d-inline-block">Password</label>
                        <div class="col-md-6 d-inline-block">
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- <div class="col-md-8 offset-md-4 mb-3">
                            <a class="btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div> -->
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-warning">
                                Login
                            </button>
                            <a href="{{ route('register') }}" type="submit" class="btn btn-outline-dark">
                                Register
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
