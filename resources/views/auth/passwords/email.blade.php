@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto mt-5">
            <h1 class="text-center font-weight-bold">รีเซ็ตรหัสผ่าน</h1>
            <div class="row">
                

                <form class="form-horizontal col-md-12 mt-3 mb-3 p-5" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
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
                            <input id="email" type="email" class="form-control rounded-pill" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-warning rounded-pill mr-3">
                                ส่งอีเมลสำหรับตั้งรหัสผ่านใหม่
                            </button>
                            <a href="{{route('login')}}" class="btn btn-light rounded-pill">ยกเลิก</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
