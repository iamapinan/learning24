@extends('layouts.app')

@section('content')
<div class="container px-0">
    <div class="col my-5">
        <div class="row mt-5 mb-3">
            <h3 class="font-weight-bold"><a href="/subject/{{@ $topic->subcat_id }}" class="text-dark px-3 py-1"><i class="fa fa-chevron-left text-dark"></i></a> เนื้อหาใน <span class="text-primary">{{@$topic->title}}</a></h3>
        </div>
        <ul class="row d-flex flex-row list-unstyled justify-content-center">
            @foreach($contents as $content)
                <a class="col px-3 mr-3 py-3 rounded-xl mt-3" href="/view/{{ $content->id }}"><li>{{ $content->title }}</li></a>
            @endforeach
        </ul>
        {{$contents->links()}}
    </div>
</div>
@endsection
