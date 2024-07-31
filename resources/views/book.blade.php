@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-5">
                <h3 class="font-weight-bold text-lg-left pt-4">จัดการเนื้อหา</h3>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb rounded-pill">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                    <li class="breadcrumb-item active" aria-current="page">จัดการเนื้อหา</li>
                </ol>
            </nav>

            <!-- Default panel contents -->
            @if (session('status'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Status</strong> {{ session('status') }}
            </div>
            @endif
            <div class="row mt-5">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                        <th scope="col">รูป</th>
                        <th scope="col">ชื่อหนังสือ</th>
                        <th scope="col">รายละเอียด</th>
                        <th scope="col">ชั้น</th>
                        <th scope="col">วิชา</th>
                        <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($books as $book)
                        <tr data-id="{{$book->id}}">
                            <th scope="row" class="col-2">
                                <a href="view/{{$book->id}}" class="d-flex justify-content-center mx-auto">
                                    <img src="{{url('storage/book/'.str_replace('thumb','large', $book->cover_file) ) }}" style="height: 120px;object-fit: contain;">
                                </a>
                            </th>
                            <td class="col-3">{{ $book->title }}</td>
                            <td class="col-3">{{ $book->description }}</td>
                            <td class="col-1">{{ $book->gradetitle }}</td>
                            <td class="col-2">{{ $book->subject . ' / ' . $book->topictitle }}</td>
                            <td class="col-2"><a href="{{route('delete',$book->id)}}" class="card-link text-danger"><i class="fas fa-trash"></i> ลบ</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $books->links() }}
            @if(count($books) == 0)
                <div class="alert alert-warning text-center mt-1 w-75 mx-auto py-5" role="alert">
                    คุณยังไม่มีเนื้อหา
                    <a href="{{route('upload')}}" class="btn btn-warning rounded-pill">อัพโหลดเนื้อหา</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
       function rmb(id) {    
            if(confirm('ต้องการลบหนังสือ ใช่หรือไม่?')){
                axios.get('/api/remove/book?id=' + id)
                .then( res => {
                    console.log(res)
                    Alert('ลบเรียบร้อยแล้ว')
                })                      
            }
        }
    </script>
@endsection