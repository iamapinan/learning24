@extends('layouts.app')

@section('content')
<div class="container-fluid px-0" style="margin-top: -3rem!important">
    <div style="background-color: #eaeff5;" class="mb-5" >
        <div class="px-0 w-75 mx-auto  pt-5" style="background-image: url(/images/header-image-learning.jpg);background-repeat: no-repeat;background-size: contain;height: 300px;background-position: center center;">
            <h1>Welcome, {{ Auth::user()->name }}</h1>
        </div>
    </div>
    <div class="container">

    </div>
</div>
@endsection
