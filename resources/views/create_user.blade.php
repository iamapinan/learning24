@extends('layouts.app')

@section('content')
<div class="container px-0">
    <div class="row mt-5 justify-content-between">
        <h3 class="font-weight-bold"><a href="/users" class="text-dark px-3 py-1 rounded-circle bg-light"><i class="fa fa-chevron-left text-dark"></i></a> สร้างผู้ใช้ใหม่</h3>
    </div>

    <div class="row">
        <div class="col-6 col-lg-6 col-sm-10 mx-auto mt-5">
            <form action="/user/store" method="post" id="create_user_form">
                @csrf
                <div class="form-group">
                    <label for="organization">หน่วยงาน/โรงเรียน</label>
                    <select name="organization" id="organization" class="form-control rounded-pill" required>
                        <option value="0">ส่วนกลาง</option>
                        @foreach($org as $o)
                        <option value="{{$o->id}}">{{$o->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="prefix">คำขึ้นต้นของชื่อผู้ใช้งาน</label>
                    <input type="text" name="prefix" id="prefix" placeholder="Prefix" class="form-control rounded-pill" required>
                    <div class="my-2 text-secondary" style="font-size: 13px;">ชื่อผู้ใช้จะเป็น <span id="prefix_output" class="text-info">prefix</span><span class="text-dark">_ตัวเลขหกหลัก@learning24.xyz</span></div>
                </div>
                <div class="form-group">
                    <label for="role">ประเภทผู้ใช้</label>
                    <select name="role" id="role" class="form-control rounded-pill" required>
                        <option value="2">ผู้ใช้ทั่วไป</option>
                        <option value="1">ผู้ดูแลระบบ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="number">จำนวนผู้ใช้ที่ต้องการ</label>
                    <input type="number" name="number" min="1" max="100" placeholder="1-100" id="number" class="form-control rounded-pill" required>
                </div>
                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-dark rounded-pill mt-3 btn-block"><i class="fas fa-plus-circle"></i> สร้างผู้ใช้</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(() => {
        $("#prefix").keyup(() => {
            $("#prefix_output").text($("#prefix").val());
        });

        $("#create_user_form").submit((event) => {
            event.preventDefault();
            $.ajax({
                url: "/create-users",
                method: "POST",
                data: $("#create_user_form").serialize(),
                success: (response) => {
                    console.log(response);
                    if (response.status == 'success') {
                        window.location.href = "/users";
                    }
                },
                error: (response) => {
                    console.log(response)
                    // alert(response.status);
                }
            });
        });
    });
</script>
@endsection
