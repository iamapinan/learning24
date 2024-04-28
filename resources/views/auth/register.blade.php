@extends('layouts.app')
@section('content')
<script>
    window.location.href='/login'
</script>
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto mt-5">
                <h1 class="text-center font-weight-bold">ลงทะเบียนสมาชิก</h1>
                <div class="row">
                    <form class="form-horizontal col-md-12 mt-3 mb-3 p-5 col-md-offset-4" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label text-right d-inline-block">ชื่อ-นามสกุล *</label>
                            <div class="col-md-6 d-inline-block">
                                <input id="name" type="text" class="form-control rounded-pill" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label text-right d-inline-block">อีเมล *</label>
                            <div class="col-md-6 d-inline-block">
                                <input id="email" type="email" class="form-control rounded-pill" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label text-right d-inline-block">รหัสผ่าน *</label>
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
                            <label for="password-confirm" class="col-md-4 control-label text-right d-inline-block">รหัสผ่านอีกครั้ง *</label>

                            <div class="col-md-6 d-inline-block">
                                <input id="password-confirm" type="password" class="form-control rounded-pill" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birthday" class="col-md-4 control-label text-right d-inline-block">ว/ด/ป เกิด *</label>

                            <div class="col-md-6 d-inline-block">
                                <input id="birthday" type="date" class="form-control rounded-pill" name="birthday" required>
                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="organization" class="col-md-4 control-label text-right d-inline-block">หน่วยงาน *</label>

                            <div class="col-md-6 d-inline-block">
                                <input id="organization" type="text" class="form-control rounded-pill" name="organization" required>
                                @if ($errors->has('organization'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <div class="col-md-4 d-inline-block">&nbsp;</div>
                            <div class="col-md-6 d-inline-block text-sm text-muted">
                                <input type="checkbox" required name="accept_term" value="yes">
                                ยินยอมรับเงื่อนไขการสมัครสมาชิก <a href="/privacy">นโยบายความเป็นส่วนตัว และข้อตกลงในการใช้งานเว็บไซต์นี้</a>?
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <div class="col-md-4 d-inline-block">&nbsp;</div>
                            <div class="col-md-6 d-inline-block">
                                <button type="submit" class="btn btn-warning rounded-pill mr-3">
                                    ลงทะเบียนสมาชิก
                                </button>
                                <a href="{{url('/login')}}" type="button" class="btn btn-light rounded-pill">
                                    ยกเลิก
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
