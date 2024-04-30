@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <div style="background-color: #eaeff5;" class="mb-5" >
        <div class="px-0 w-75 mx-auto py-3";">
            <h3>Welcome, {{ Auth::user()->name }}</h3>
        </div>
    </div>
    <div class="container">
        <h3>ล่าสุด</h3>
        <div class="mt-3 row mb-5">
            @if(count($contents) > 0)
                <ul class="list-unstyled row mx-2 justify-content-center">
                @foreach($contents as $x => $content)
                    <li class="col-md-3 col-6 p-2" href="{{url('/view/'.$content->id)}}">
                        <a href="{{url('/view/'.$content->id)}}">
                            <img src="{{url('storage/book/'.str_replace('thumb','large', $content->cover_file))}}" width="100%" alt="{{$content->title}}" class="p-3 border rounded-xl">
                        </a>
                        <div class="mt-2">
                            <div class="badge badge-warning">{{$content->gradetitle}}</div>
                            <div class="badge badge-light">{{$content->subject}}</div>
                            <div class="mt-2"><a href="{{url('/view/'.$content->id)}}" class="font-weight-bold text-dark">{{$content->title}}</a></div>
                        </div>
                    </li>
                @endforeach
                </ul>
            @else
                <div class="text-center mt-5 w-100 disabled" role="alert">ไม่พบเนื้อหา</div>
            @endif
            {{ $contents->links() }}
        </div>
    </div>
</div>
@endsection
