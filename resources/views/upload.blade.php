@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Upload you ebook</div>
                @if (session('status'))
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Status</strong> {{ session('status') }}
                </div>
                @endif
                <div class="panel-body">
                    <form action="" method="POST" role="form"  enctype="multipart/form-data">
                      
                        <div class="form-group">
                            <label for="filename">ชื่อหนังสือ</label>
                            <input type="text" class="form-control" id="filename" value="{{ old('filename') }}" name="filename" placeholder="Book name" reqiured>
                        </div>
                        <div class="form-group">
                            <label for="author">ชื่อผู้เขียน</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" placeholder="Author name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">รายละเอียด</label>
                            <textarea class="form-control" rows="3" id="description" name="description">{{ old('description') }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="category">ประเภทหนังสือ</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="null" selected>เลือกประเภทหนังสือ</option>
                                @foreach($category as $cat)
                                    <option value="{{$cat->cat_id}}">{{ $cat->title }}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="sub">กลุ่มสาระวิชา</label>
                                <select class="form-control" id="sub" name="sub">
                                    <option value="null" selected>เลือกกลุ่มสาระ</option>
                                @foreach($sub as $s)
                                    <option value="{{$s->id}}">{{ $s->title }}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="grade">ชั้นเรียน</label>
                                <select class="form-control" id="sub" name="grade">
                                    <option value="null" selected>เลือกชั้นเรียน</option>
                                @foreach($grade as $gd)
                                    <option value="{{$gd->id}}">{{ $gd->title }}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="bookfile">ไฟล์หนังสือ</label>
                            <input type="file" id="bookfile" name="bookfile" accept="application/zip" required @change="filesChange($event.target.name, $event.target.files); fileCount = $event.target.files.length">
                            <p class="help-block">กรุณาเลือกไฟล์ zip เท่านั้นและจำกัดไม่เกิน 20mb</p>
                        </div>
                        
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="isPublic" name="isPublic" value="1" checked> กำหนดให้ทุกคนในองค์กรดูเนื้อหานี้ได้
                            </label>
                        </div>
                        <input type="hidden" name="userid" value="">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="isGlobal" name="isGlobal" value="1" checked> เปิดเผยสาธารณะให้กับคนทั่วไปที่ไม่ได้อยู่ในองค์กรด้วย
                            </label>
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary" >
                            Upload
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection