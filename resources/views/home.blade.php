@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1>Digital World</h1> 
        <h3>คุณอยากจะทำอะไรดี?</h3>
        <ul>
            <a href="{{ route('book') }}">
                <li>อัพโหลดหนังสือ flipbook</li>
            </a>
            <a href="#" class="text-gray">
                <li>อัพโหลดเอกสาร pdf (จะเปิดให้บริการเร็วๆนี้)</li>
            </a>
        </ul>
        <hr>
        <p>Application available on Android.</p>
        <p><a href="https://play.google.com/store/apps/details?id=com.digitalworld.iotech">
            <img src="/images/Google_play_store.png" width="160">
        </a></p> 
    </div>
</div>
@endsection
