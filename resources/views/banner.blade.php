@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-danger">
                <div class="panel-heading">Create your banner</div>

            <div class="panel-body">
                    <form action="" method="POST" role="form"  encrypted="multipart/form-dat">
                    
                        <div class="form-group">
                            <label for="filename">ชื่อ</label>
                            <input type="text" class="form-control" id="filename" placeholder="ชื่อของโฆษณาหรือชื่อผู้ลงโฆษณา" reqiured>
                        </div>

                        <div class="form-group">
                            <label for="link">ลิ้งค์ที่เชื่อมโยง</label>
                            <input type="text" class="form-control" id="link" placeholder="http://yourdomain.com" required>
                        </div>
          
                        <div class="form-group">
                            <label for="bannerfile">ไฟล์แบนเนอร์</label>
                            <input type="file" id="bannerfile" accept="image/png, image/jpeg" required>
                            <p class="help-block">กรุณาเลือกไฟล์ jpg, png เท่านั้นและจำกัดไม่เกิน 2mb และมีขนาด 1000x600 เท่านั้น</p>
                        </div>

                
                        <button type="button" class="btn btn-danger" (click)="onClick($event)">
                            Create banner
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection