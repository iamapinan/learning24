@extends('layouts.app')

@section('content')
<div class="container px-0">
    <div class="row mt-5 justify-content-between">
        <h3 class="font-weight-bold"><a href="/subject/{{ $topic->subcat_id }}" class="text-dark px-3 py-1"><i class="fa fa-chevron-left text-dark"></i></a> แก้ไขหน่วยการเรียน</h3>
    </div>

    <div class="row">
        <div class="col-8 col-sm-10 mx-auto mt-5">
            <form action="/topic/update" method="patch" id="create_topic_form">
                @csrf
                <input type="hidden" name="subcat_id" value="{{ $topic->subcat_id }}">
                <input type="hidden" name="id" value="{{ $topic->id }}">
                <div class="form-group">
                    <label for="title">ชื่อหน่วยการเรียน</label>
                    <input type="text" name="title" id="title" value="{{$topic->title}}" class="form-control rounded-pill" placeholder="ชื่อหน่วยการเรียน" required>
                </div>
                <div class="form-group">
                    <label for="description">ระดับชั้น</label>
                    <select name="grade" id="grade" value="{{$topic->grade_id}}" class="form-control rounded-pill" required>
                        <option value="">เลือกระดับชั้น</option>
                        @foreach($levels as $level)
                        <option value="{{ $level->grade_id }}"
                        {{ $level->grade_id == $topic->grade_id ? 'selected' : '' }}
                        >{{ $level->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark rounded-pill mt-3"><i class="fa fa-save"></i> บันทึก</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    $(() => {
        $("#create_topic_form").submit((event) => {
            event.preventDefault();
            $.ajax({
                url: "/topic_update",
                method: "PATCH",
                data: $("#create_topic_form").serialize(),
                success: (response) => {
                    if (response.status == 'success') {
                        alert(response.status);
                        window.location.href = "/subject/{{ $topic->subcat_id }}";
                    }
                },
                error: (response) => {
                    alert(response.status);
                }
            });
        });
    });
</script>
@endsection
