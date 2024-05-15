@extends('layouts.app')

@section('content')
<div class="container px-0">
    <div class="col my-5">
        <div class="row mt-5 mb-3">
            <h3 class="font-weight-bold"><span class="fa fa-folder"></span> กลุ่มสาระวิชา</h3>
        </div>
        <ul class="row d-flex flex-row list-unstyled justify-content-center">
            @foreach($subjects as $subject)
                <a class="col-3 px-3 mr-3 py-3 btn btn-light rounded-xl mt-3" href="/subject/{{ $subject->id }}"><li>{{ $subject->title }}</li></a>
            @endforeach
        </ul>
    </div>
</div>
@endsection
