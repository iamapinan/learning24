@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                <div class="mb-5 rounded" style="background-image: url(/images/shelf.jpg);background-position: right center;background-repeat: no-repeat;background-size: cover;height: 300px;">
                    <h3 class="pl-5 text-lg-left pt-4 text-white"><img src="/images/books-icon.png" aria-hidden="true"> {{$user->name}}</h3>
                </div>

                 <!-- Default panel contents -->
                 <h3>แนะนำ</h3>
                 <div class="mt-3 row mb-5">
                    @for($x=0;$x<count($list);$x++)
                        <div class="col-md-3">
                            <div class="card shadow rounded">
                                <a href="{{url('/view/'.$list[$x]->id)}}">
                                    <img src="{{url('storage/book/'.str_replace('thumb','large', $list[$x]->cover_file) ) }}" alt="{{$list[$x]->title}}" style="height: 190px;object-fit: contain;" class="card-img-top overflow-hidden">
                                </a>
                                <div class="card-body">
                                    <p class="card-title mb-1 text-bold"><a href="{{url('/view/'.$list[$x]->id)}}">{{$list[$x]->title}}</a></p>
                                    <div class="card-text">
                                        <p class="text-secondary">{{$list[$x]->description}}</p>
                                        <a class="badge badge-primary text-white"><i class="fa fa-graduation-cap"></i> {{$list[$x]->gradetitle}} </a>
                                        <a class="badge badge-info text-white"><i class="fa fa-folder"></i> {{$list[$x]->subject}} </a>
                                        <a class="badge badge-light"><i class="fa fa-eye"></i> {{$list[$x]->view}} </a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                    @if(count($list) == 0)
                        <div class="alert alert-light text-center mt-5" role="alert">คุณยังไม่มีหนังสือ</div>
                    @endif
                </div>
                <h3>ทั้งหมด</h3>
                <div class="mt-3 row">
                    @foreach($list as $b)
                        <div class="col-md-3">
                            <div class="card shadow rounded">
                            <a href="{{url('/view/'.$b->id)}}">
                                <img src="{{url('storage/book/'.str_replace('thumb','large', $b->cover_file) ) }}" alt="{{$b->title}}" style="height: 190px;object-fit: contain;" class="card-img-top overflow-hidden">
                            </a>
                                <div class="card-body">
                                    <p class="card-title mb-1 text-bold"><a href="{{url('/view/'.$b->id)}}">{{$b->title}}</a></p>
                                    <div class="card-text">
                                        <p class="text-secondary">{{$b->description}}</p>
                                        <a class="badge badge-secondary  text-white"><i class="fa fa-graduation-cap"></i> {{$b->gradetitle}} </a>
                                        <a class="badge badge-info  text-white"><i class="fa fa-folder"></i> {{$b->subject}} </a>
                                        <a class="badge badge-light"><i class="fa fa-eye"></i> {{$b->view}} </a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if(count($list) == 0)
                        <div class="alert alert-light text-center mt-5" role="alert">คุณยังไม่มีหนังสือ</div>
                    @endif
                    
                  </div>
                  {{ $list->links() }}
                </div>
            
            
        </div>
    </div>
</div>
@endsection
