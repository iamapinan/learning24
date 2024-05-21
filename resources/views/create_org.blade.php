@extends('layouts.app')

@section('content')
<div class="container px-0">
    <div class="row mt-5 justify-content-between">
        <h3 class="font-weight-bold"><a href="/org-manage" class="text-dark px-3 py-1 rounded-circle bg-light"><i class="fa fa-chevron-left text-dark"></i></a> สร้างองค์กร</h3>
    </div>

    <div class="row">
        <div class="col-6 col-lg-6 col-sm-10 mx-auto mt-5">
            <form action="/org-store" method="post" id="create_org_form">
                @csrf
                <div class="form-group">
                    <label for="title">ชื่อองค์กร</label>
                    <input type="text" name="title" id="title" placeholder="ชื่อองค์กร" class="form-control rounded-pill" required>
                </div>
                <div class="form-group">
                    <label for="number">จำนวนผู้ใช้ที่ต้องการ</label>
                    <input type="number" name="number" min="1" max="1000" placeholder="1-1000" id="number" class="form-control rounded-pill" required>
                </div>
                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-dark rounded-pill mt-3 btn-block"><i class="fas fa-plus-circle"></i> สร้างองค์กร</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(() => {

        $("#create_org_form").submit((event) => {
            event.preventDefault();
            $.ajax({
                url: "/org-store",
                method: "POST",
                data: $("#create_org_form").serialize(),
                success: (response) => {
                    if (response.status == 'success') {
                        window.location.href = "/org-manage";
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
