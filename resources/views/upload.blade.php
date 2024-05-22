@extends('layouts.app')

@section('content')

<div class="mb-5 py-5 bg-light snap-top d-flex flex-column justify-content-center">
    <h1 class="text-center"><i class="fa fa-upload"></i> อัพโหลดเนื้อหา</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto mb-5 shadow p-5 rounded-xl">
            @if (session('status'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Status</strong> {{ session('status') }}
            </div>
            @else
                @if (Auth::user()->email_verified == 0)
                    <div class="alert alert-warning">
                        <strong>ขออภัย</strong> กรุณายืนยันดีเมล์ของคุณก่อน เราได้ส่งอีเมล์ยืนยันตัวตนไปแล้ว หากคุณยังไม่ได้รับ <br>กรุณา
                        <a href="{{route('verification.resend')}}" class="btn-link">ส่งอีเมล์ยืนยันตัวตนอีกครั้ง</a> หรือตรวจสอบใน Junk mail อีกครั้ง
                    </div>
                @elseif (Auth::user()->role_id != 1)
                    <div class="alert alert-warning">
                        <strong>ขออภัย</strong> คุณไม่สามารถเข้าถึงหน้านี้ได้
                    </div>
                @else
                    <form action="{{route('handleUpload')}}" method="POST" role="form" enctype="multipart/form-data">
                        <div class="p-3 bg-light rounded my-3">
                            
                            <div class="form-group my-4">
                                <label for="type_book">ประเภทไฟล์</label>
                                <select id="type_book" class="form-control rounded-pill" name="type_book" required>
                                    <option value="null">กรุณา เลือกประเภทไฟล์ ก่อน</option>
                                    @if(Auth::user()->user_org_id==null)
                                    <option value="0">HTML5 E-Book</option>
                                    @endif
                                    <option value="1">PDF</option>
                                </select>
                            </div>
                            <div class="form-group my-4 d-none" id="html5_file">
                                <label for="bookfile">ไฟล์หนังสือ *</label>
                                <input type="file" id="bookfile" name="bookfile" accept="application/zip">
                                <p class="text-danger">กรุณาเลือกไฟล์ zip เท่านั้นและจำกัดไม่เกิน 20mb ที่ดาวน์โหลดจาก fliphtml5</p>
                            </div>
                            <div class="form-group my-4 d-none" id="pdf_file">
                                <label for="bookfile">ไฟล์หนังสือ *</label>
                                <input type="file" id="pdf_bookfile" name="pdf_bookfile" accept="application/pdf">
                                <p class="text-danger">กรุณาเลือกไฟล์ pdf เท่านั้นและจำกัดไม่เกิน 20mb</p>
                            </div>
                            <div class="form-group">
                                <label for="before_attachment">ข้อสอบก่อนเรียน <span class="text-muted">ไม่บังคับ</span></label>
                                <input type="url" class="form-control rounded-pill" id="attachment" name="before_attachment" value="{{ old('before_attachment') }}" placeholder="url ข้อสอบ/แบบฝึกหัดจาก Google form ไม่ต้องย่อ">
                            </div>
                            <div class="form-group">
                                <label for="attachment">ข้อสอบหลังเรียน <span class="text-muted">ไม่บังคับ</span></label>
                                <input type="url" class="form-control rounded-pill" id="attachment" name="attachment" value="{{ old('attachment') }}" placeholder="url ข้อสอบ/แบบฝึกหัดจาก Google form ไม่ต้องย่อ">
                            </div>
                            <div class="form-group">
                                <label for="attachment">วิดีโอ <span class="text-muted">ไม่บังคับ</span></label>
                                <input type="url" class="form-control rounded-pill" id="video_url" name="video_url" value="{{ old('video_url') }}" placeholder="url ของวิีดีโอจาก YouTube ไม่ต้องย่อ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="filename">ชื่อหนังสือ *</label>
                            <input type="text" class="form-control rounded-pill" id="filename" value="{{ old('filename') }}" name="filename" placeholder="Book name" reqiured>
                        </div>
                    
                        <input type="hidden" name="author" value="{{Auth::user()->name}}">
                        <div class="form-group">
                            <label for="description">รายละเอียด *</label>
                            <textarea class="form-control rounded-xl" rows="3" id="description" name="description" required placeholder="รายละเอียดหนังสือ">{{ old('description') }}</textarea>
                        </div>
                        <div class="dropdown-divider mt-5 mb-4"></div>
                        <div class="form-group">
                            <label for="grade">ชั้นเรียน *</label>
                            <select class="form-control rounded-pill" id="level" name="grade" required>
                                <option value="null" selected>เลือกชั้นเรียน</option>
                            @foreach($grade as $gd)
                                <option value="{{$gd->id}}">{{ $gd->title }}</option>
                            @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="sub">กลุ่มสาระวิชา *</label>
                                <select class="form-control rounded-pill" id="sub" name="sub" required disabled="disabled">
                                    <option value="null" selected>เลือกกลุ่มสาระ</option>
                                @foreach($sub as $s)
                                    <option value="{{$s->id}}">{{ $s->title }}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group d-none" id="topic-group">
                            <label for="topics">หน่วยการเรียน *</label> <a class="btn-sm btn-link create-topic disabled" target="_blank" role="button" aria-disabled="true"><i class="fa fa-plus-circle"></i> เพิ่มหน่วยการเรียน</a>
                                <select class="form-control rounded-pill" id="topics" name="topic" required> 
                                    <option value="null" selected>เลือกหน่วยการเรียน</option>
                                </select>
                        </div>
                        
                            <input type="hidden" name="userid" value="{{Auth::user()->id}}">
                            <input type="hidden" id="isGlobal" name="isGlobal" value="1">
                            <input type="hidden" id="isAccept" name="isAccept" value="1" >
                            {{ csrf_field() }}
                            <div class="form-group mt-5">
                                <button type="submit" class="btn btn-dark rounded-pill" >
                                    ดำเนินการ
                                </button>
                                <a href="{{route('explore')}}" class="btn btn-default rounded-pill" role="button">ยกเลิก</a>
                            </div>
                    </form>
                @endif
            @endif

            <script>
                $(() => {
                    $('#type_book').on('change', function () {
                        if($(this).val() == 0) {
                            $("#html5_file").removeClass('d-none').addClass('d-block').find('input').attr('required', true)
                            $("#pdf_file").removeClass('d-block').addClass('d-none').find('input').attr('required', false)
                        }
                        if($(this).val() == 1) {
                            $("#pdf_file").removeClass('d-none').addClass('d-block').find('input').attr('required', true)
                            $("#html5_file").removeClass('d-block').addClass('d-none').find('input').attr('required', false)
                        }
                    });
                });

                document.getElementById("level").addEventListener("change", () =>{
                    let subject = document.getElementById("sub");
                    subject.removeAttribute('disabled')
                })

                document.getElementById("sub").addEventListener("change", () => {
                    let subject = document.getElementById("sub").value;
                    let level = document.getElementById("level").value;
                    let toppic_group = document.getElementById("topic-group");
                    let topic_link = document.getElementsByClassName("create-topic")[0];

                    $.ajax({
                        url: '/topics?level=' + level + '&subject=' + subject,
                        type: 'GET',
                        success: (data) => {
                            if(data.status === 'success') {
                                let options = '<option value="" selected>เลือกหน่วยการเรียน</option>';
                                data.data.forEach((topic) => {
                                    options += '<option value="' + topic.id + '">' + topic.title + '</option>';
                                });
                                document.getElementById("topics").innerHTML = options;
                            }
                        },
                        error: error => {
                            console.log(error)
                        }
                    });

                    toppic_group.classList.remove('d-none');
                    topic_link.classList.remove('disabled');
                    topic_link.setAttribute('href', '/create-topic/' + subject);
                });
            </script>
         
        </div>
    </div>
</div>
@endsection