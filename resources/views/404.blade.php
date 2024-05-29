@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 rounded-xl mt-3">
            <div class="card">
                <div class="card-header">404 Not Found</div>

                <div class="card-body">
                    <p>ไม่พบเนื้อหาที่คุณต้องการ.</p>
                    <p>โปรดตรวจสอบ URL แล้วลองใหม่อีกครั้ง</p>
                    <a href="{{ url('/explore') }}" class="btn btn-dark rounded-pill">Go to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
