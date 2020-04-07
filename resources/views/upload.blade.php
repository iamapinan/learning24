@extends('layouts.app')

@section('content')

<div class="mb-5 py-5 bg-light snap-top d-flex flex-column justify-content-center" style="background-image: url(/images/upload_bg.png);background-repeat: no-repeat;background-position: 75% 20px;height: 300px">
    <h1 class="text-center">Upload</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto mb-5 border shadow p-5 rounded">
                @if (session('status'))
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Status</strong> {{ session('status') }}
                </div>
                @endif

                    <form action="{{route('handleUpload')}}" method="POST" role="form"  enctype="multipart/form-data">
                        <div class="p-3 bg-light rounded my-3">
                            <div class="form-group my-4">
                                <label for="bookfile">ไฟล์หนังสือ *</label>
                                <input type="file" id="bookfile" name="bookfile" accept="application/zip" required @change="filesChange($event.target.name, $event.target.files); fileCount = $event.target.files.length">
                                <p class="text-warning">กรุณาเลือกไฟล์ zip เท่านั้นและจำกัดไม่เกิน 20mb ที่ดาวน์โหลดจาก fliphtml5</p>
                            </div>
                            <div class="form-group">
                                <label for="attachment">ข้อสอบ/แบบฝึกหัด <span class="text-muted">ไม่บังคับ</span></label>
                                <input type="text" class="form-control" id="attachment" name="attachment" value="{{ old('attachment') }}" placeholder="url ข้อสอบ/แบบฝึกหัดจาก Google form" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="filename">ชื่อหนังสือ *</label>
                            <input type="text" class="form-control" id="filename" value="{{ old('filename') }}" name="filename" placeholder="Book name" reqiured>
                        </div>
                        
                        <div class="form-group">
                            <label for="author">ชื่อผู้เขียน *</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" placeholder="Author name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">รายละเอียด *</label>
                            <textarea class="form-control" rows="3" id="description" name="description" required placeholder="รายละเอียดหนังสือ">{{ old('description') }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="category">ประเภทหนังสือ *</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="null" selected>เลือกประเภทหนังสือ</option>
                                @foreach($category as $cat)
                                    <option value="{{$cat->cat_id}}">{{ $cat->title }}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="sub">กลุ่มสาระวิชา <span class="text-muted">ไม่บังคับ</span></label>
                                <select class="form-control" id="sub" name="sub">
                                    <option value="null" selected>เลือกกลุ่มสาระ</option>
                                @foreach($sub as $s)
                                    <option value="{{$s->id}}">{{ $s->title }}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="grade">ชั้นเรียน <span class="text-muted">ไม่บังคับ</span></label>
                                <select class="form-control" id="sub" name="grade">
                                    <option value="null" selected>เลือกชั้นเรียน</option>
                                @foreach($grade as $gd)
                                    <option value="{{$gd->id}}">{{ $gd->title }}</option>
                                @endforeach
                                </select>
                        </div>
                        
                        
                        <div class="checkbox mt-5">
                            <label class="text-muted">
                                <input type="checkbox" id="isPublic" disabled name="isPublic" value="1"> กำหนดให้ทุกคนในองค์กรดูเนื้อหานี้ได้ 
                                <span class="text-danger">ยังไม่พร้อมใช้งาน</span>
                            </label>
                        </div>
                        <input type="hidden" name="userid" value="{{Auth::user()->id}}">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="isGlobal" name="isGlobal" value="1" required> เปิดเผยสาธารณะให้กับคนทั่วไปที่ไม่ได้อยู่ในองค์กรด้วย
                            </label>
                        </div>
                        <div class="checkbox mb-3">
                            <label class="text-break" for="isAccept">
                                <input type="checkbox" id="isAccept" name="isAccept" value="1" required> ข้าพเจ้ายอมรับว่าหนังสือนี้เป็นกรรมสิทธิของข้าพเจ้า และเป็นความรับผิดชอบของข้าพเจ้าแต่เพียงผู้เดียว ทางผู้ให้บริการระบบไม่มีส่วนเกี่ยวข้องกับการกระทำใดๆ อันเป็นการละเมิดสิทธิผู้อื่นแต่อย่างใด
                            </label>
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary" >
                            ดำเนินการ
                        </button>
                        <a href="{{route('home')}}" class="btn btn-default" role="button">ยกเลิก</a>
                    </form>

         
        </div>
    </div>
</div>
@endsection