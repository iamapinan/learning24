@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                <div class="mb-5 rounded-xl d-flex flex-column justify-content-end shelf_cover  bg-opacity-50" style="background-image: url(/images/shelf.jpg);">
                    <div class="page-cover d-flex flex-column justify-content-between h-100">
                        <div class="d-flex flex-row align-items-end w-100 h-25">
                            <!-- search form -->
                            <form class="form-inline my-2 my-lg-0 w-100 h-50 justify-content-center" method="GET" action="/explore" >
                                <div class="input-group w-75">
                                    <input type="search" class="form-control" placeholder="ค้นหาเนื้อหา" aria-describedby="button-search" name="search" value="{{@$_GET['search']}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-light" type="submit" id="button-search">ค้นหา</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="subjects" class="w-75 mx-auto pt-5 h-25">
                            <a class="btn btn-sm m-1 px-3 rounded-pill {{!isset($_GET['subject']) || $_GET['subject'] == '0'  ? 'active text-warning btn-dark' : 'btn-secondary'}}" href="/explore?subject=0">ทั้งหมด</a>
                            @foreach($subjects as $subject)
                                <a class="btn btn-sm m-1 px-3 rounded-pill {{isset($_GET['subject']) && $_GET['subject'] == $subject->id ? 'active text-warning btn-dark' : 'btn-secondary'}}" href="/explore?subject={{$subject->id}}">{{$subject->title}}</a>
                            @endforeach
                        </div>
                        <div class="d-flex flex-row justify-content-end h-50 pb-5">
                            <div class="h3 col pl-5 text-lg-left text-white text-shadow align-self-end"><i class="fa fa-folder text-yellow"></i> {{$title}}</div>
                            <div class="col-4 justify-content-start align-self-end">
                                <div class="col d-flex flex-rows justify-content-end">
                                    <div class="dropdown mr-3">
                                        <button class="btn btn-secondary rounded-pill dropdown-toggle" value="{{@$_GET['level']}}" type="button" data-toggle="dropdown" aria-expanded="false">
                                            ระดับชั้น
                                        </button>
                                        <div class="dropdown-menu">
                                        @foreach($levels as $level)
                                            <a class="dropdown-item {{isset($_GET['level']) && $_GET['level'] == $level->grade_id ? 'active' : ''}}" href="/explore?level={{$level->grade_id}}">{{$level->title}}</a>
                                        @endforeach
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary rounded-pill dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                            จัดเรียง
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item {{isset($_GET['sort']) && $_GET['sort'] == 'alphabet' ? 'active' : ''}}" href="/explore?sort=alphabet">ตามตัวอักษร</a>
                                            <a class="dropdown-item {{isset($_GET['sort']) && $_GET['sort'] == 'numberic' ? 'active' : ''}}" href="/explore?sort=numberic">ตามลำดับเริ่มต้น</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Default panel contents -->
                <h3 class="mt-5">เนื้อหา</h3>
                <div class="mt-3 row mb-5">
                    @if(count($contents) > 0)
                        @for($x=0;$x<count($contents);$x++)
                            <a class="col-md-3 book" href= "{{url('/view/'.$contents[$x]->id)}}">
                                <div class="book-item shadow rounded d-flex flex-column justify-content-end" style="background-size: contain;height: 350px;background-image: url({{url('storage/book/'.str_replace('thumb','large', $recommend[$x]->cover_file))}});">
                                    <div class="book-body p-3 gradient">
                                        <div class="book-text">
                                            <ul class="list-inline">
                                                <a class="badge badge-light"><i class="fa fa-graduation-cap"></i> {{$contents[$x]->gradetitle}} </a>
                                                <a class="badge badge-light"><i class="fa fa-folder"></i> {{$contents[$x]->subject}} </a>
                                                <a class="badge badge-light"><i class="fa fa-eye"></i> {{$contents[$x]->view}} </a>
                                                <a class="badge badge-warning"><i class="fa fa-star"></i></a>
                                            </ul>
                                        </div>
                                        <p class="mt-2 text-bold"><a href="{{url('/view/'.$contents[$x]->id)}}" class="text-white">{{$contents[$x]->title}}</a></p>
                                    </div>
                                </div>
                            </a>
                        @endfor
                    @else
                        <div class="text-center mt-5 w-100 disabled" role="alert">ไม่พบเนื้อหา</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
