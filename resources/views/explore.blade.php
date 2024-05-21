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
                                    <input type="hidden" name="subject" value="{{@$_GET['subject']}}">
                                    <input type="hidden" name="level" value="{{@$_GET['level']}}">
                                    <input type="hidden" name="sort" value="{{@$_GET['sort']}}">
                                    
                                    <input type="search" class="form-control rounded-left" placeholder="ค้นหาเนื้อหา" aria-describedby="button-search" name="search" value="{{@$_GET['search']}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-light" type="submit" id="button-search">ค้นหา</button>
                                    </div>
                                </div>
                            </form>
			</div>
			<div id="subjects" class="d-flex flex-row justify-content-start w-75 mx-auto">
                            <div class="dropdown mr-3">
                                <a href="/explore?subject=0&level={{@$_GET['level']}}&sort={{@$_GET['sort']}}&search={{@$_GET['search']}}" class="btn btn-secondary btn-sm rounded-pill dropdown-toggle" value="{{@$_GET['subject']}}" type="button" data-toggle="dropdown" aria-expanded="false">
                                    ทุกกลุ่มสาระ
                                </a>
                                <div class="dropdown-menu">
                                @foreach($subjects as $subject)
                                    <a class="dropdown-item {{isset($_GET['subject']) && $_GET['subject'] == $subject->id ? 'active' : ''}}" href="/explore?subject={{$subject->id}}&level={{@$_GET['level']}}&sort={{@$_GET['sort']}}&search={{@$_GET['search']}}">{{$subject->title}}</a>
                                @endforeach
                                </div>
                            </div>
                            <div class="dropdown mr-3">
                                <button class="btn btn-secondary btn-sm rounded-pill dropdown-toggle" value="{{@$_GET['level']}}" type="button" data-toggle="dropdown" aria-expanded="false">
                                    ระดับชั้น
                                </button>
                                <div class="dropdown-menu">
                                @foreach($levels as $level)
                                    <a class="dropdown-item {{isset($_GET['level']) && $_GET['level'] == $level->grade_id ? 'active' : ''}}" href="/explore?level={{$level->grade_id}}&subject={{@$_GET['subject']}}&sort={{@$_GET['sort']}}&search={{@$_GET['search']}}">{{$level->title}}</a>
                                @endforeach
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm rounded-pill dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    จัดเรียง
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item {{isset($_GET['sort']) && $_GET['sort'] == 'alphabet' ? 'active' : ''}}" href="/explore?sort=alphabet&subject={{@$_GET['subject']}}&level={{@$_GET['level']}}&search={{@$_GET['search']}}">ตามตัวอักษร</a>
                                    <a class="dropdown-item {{isset($_GET['sort']) && $_GET['sort'] == 'numberic' ? 'active' : ''}}" href="/explore?sort=numberic&subject={{@$_GET['subject']}}&level={{@$_GET['level']}}&search={{@$_GET['search']}}">ตามลำดับเริ่มต้น</a>
                                </div>
                            </div>
			            </div>

                        <div class="d-flex flex-row justify-content-end h-25 pb-3">
                            <div class="h5 col pl-5 text-lg-left text-white text-shadow align-self-end"><i class="fa fa-folder text-yellow"></i> {{$title}}</div>
                        </div>
                        
                    </div>
                </div>
                <!-- Default panel contents -->
                <h3 class="mt-5 font-weight-bold"><svg width="26" height="26" fill="orange" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M190.4 74.1c5.6-16.8-3.5-34.9-20.2-40.5s-34.9 3.5-40.5 20.2l-128 384c-5.6 16.8 3.5 34.9 20.2 40.5s34.9-3.5 40.5-20.2l128-384zm70.9-41.7c-17.4-2.9-33.9 8.9-36.8 26.3l-64 384c-2.9 17.4 8.9 33.9 26.3 36.8s33.9-8.9 36.8-26.3l64-384c2.9-17.4-8.9-33.9-26.3-36.8zM352 32c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32s32-14.3 32-32V64c0-17.7-14.3-32-32-32z"></path></svg> เนื้อหา</h3>
                <div class="mt-3 row mb-5">
                    @if(count($contents) > 0)
                        <ul class="list-unstyled row justify-content-center">
                        @foreach($contents as $x => $content)
                            <li class="col-md-3  col-6 p-2" href="{{url('/view/'.$content->id)}}">
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
    </div>
</div>
@endsection
