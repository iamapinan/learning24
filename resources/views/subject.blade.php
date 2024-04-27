@extends('layouts.app')

@section('content')
<div class="container px-0">
    <div class="row mt-5 justify-content-between">
        <h3 class="font-weight-bold"><a href="/subjects" class="text-dark px-3 py-1"><i class="fa fa-chevron-left text-dark"></i></a>หน่วยการเรียนใน <span class="text-primary">{{$subject->title}}</span></h3>
        @if(Auth::user()->role_id == 1)
        <a href="/create-topic/{{$subject->id}}" class="btn btn-dark rounded-pill mt-3 align-middle"><i class="fa fa-plus-circle"></i> เพิ่มหน่วยการเรียน</a>
        @endif
    </div>
    <div class="row mt-5">
        
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <form action="/topic_search" method="GET" id="search-topic">
                        <input type="hidden" name="subject_id" value="{{$subject->id}}">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="search" autofocus class="form-control border-0" name="q" placeholder="ค้นหาชื่อหน่วยการเรียน">
                            <div class="input-group-append">
                                <button class="btn btn-light border-0" type="submit"><i class="fa fa-search text-secondary"></i></button>
                            </div>
                        </div>
                    </form>
                </th>
                <th scope="col">ระดับชั้น</th>
                @if(Auth::user()->role_id == 1)
                <th scope="col">จัดการ</th>
                @endif
                </tr>
            </thead>
            <tbody>
                @foreach($topics as $topic)
                <tr data-id="{{$topic->id}}">
                    <th scope="row">{{ $topic->id }}</th>
                    <td><a href="/topic/{{ $topic->id }}">{{ $topic->title }}</a></td>
                    <td>{{ $topic->gradetitle }}</td>
                    @if(Auth::user()->role_id == 1)
                    <td>
                        <a href="/edit-topic/{{ $topic->id }}" class="btn btn-warning btn-sm rounded-pill"><i class="fa fa-edit"></i> แก้ไข</a>
                        <button type="button" data-id="{{ $topic->id }}" class="btn btn-danger btn-delete-topic btn-sm rounded-pill"><i class="fa fa-trash"></i> ลบ</button>
                    </td>
                    @endif
                </tr>
                @endforeach
                @if(count($topics) == 0)
                <tr>
                    <td colspan="4" class="text-center">ไม่พบข้อมูล</td>
                </tr>
                @endif
            </tbody>
        </table>
        {{ $topics->links() }}
    </div>
    </div>
</div>
<script>
    function do_delete(id) {
        if(confirm('ยืนยันการลบข้อมูล')) {
            $.ajax({
                url: '/delete-topic/'+id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(result) {
                    $('tr[data-id= '+id+']').fadeOut();
                }
            });
        }
    }
    $(() => {
        $('.btn-delete-topic').click(function(){
            let id = $(this).data('id');
            do_delete(id);
        });

        $("#search-topic").submit(function(e){
            e.preventDefault();
            let form = $(this);
            let url = form.attr('action');
            let data = form.serialize();
            $.ajax({
                url: url,
                type: 'GET',
                data: data,
                success: function(result) {
                    if(result.topics.data.length > 0) {
                        @if(Auth::user()->role_id == 1)
                            let output = result.topics.data.map(function(topic){
                            return `<tr data-id="${topic.id}"><th scope="row">${topic.id}</th><td><a href="/topic/${topic.id}">${topic.title}</a></td><td>${topic.gradetitle}</td><td>
                            <a href="/edit-topic/${topic.id}" class="btn btn-warning btn-sm rounded-pill"><i class="fa fa-edit"></i> แก้ไข</a>
                            <button type="button" onclick="do_delete(${topic.id})" data-id="${topic.id}" class="btn btn-danger btn-delete-topic btn-sm rounded-pill"><i class="fa fa-trash"></i> ลบ</button>
                            </td></tr>`;
                        });
                        @else
                            let output = result.topics.data.map(function(topic){
                                return `<tr data-id="${topic.id}"><th scope="row">${topic.id}</th><td><a href="/topic/${topic.id}">${topic.title}</a></td><td>${topic.gradetitle}</td></tr>`;
                            });
                        @endif
                        $('.table tbody').html(output);
                    } else {
                        $('.table tbody').html('<tr><td colspan="4" class="text-center">ไม่พบข้อมูล</td></tr>');
                    }
                    $('.pagination').html(result.pagination);
                },
                error: function(result) {
                    console.log(result)
                }
            });
        });
    });
</script>
@endsection
