@extends('layouts.app')

@section('content')
<div class="container">
    <iframe src="{{asset('storage/book/'.$content[0]->fileUrl)}}" frameborder="0" class="w-100 min-vh-100"></iframe>
</div>
@endsection
