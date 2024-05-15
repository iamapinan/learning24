@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h5 class="text-dark font-weight-bold">{{$content->title}}</h5>
        <p>{{$content->gradetitle}} / {{$content->subject}} > {{$content->topictitle}}</p>
        </div>
    </div>

    <ul class="tabs ml-5" role="tablist">
        <li class="tab-link current rounded-top py-2 px-3" data-tab="book">อีบุ๊ก/PDF</li>
        @if($content->link_pretest != '')
        <li class="tab-link rounded-top py-2 px-3" data-tab="quizebefore">ข้อสอบก่อนเรียน</li>
        @endif
        @if($content->link_test != '')
        <li class="tab-link rounded-top py-2 px-3" data-tab="quize">ข้อสอบหลังเรียน</li>
        @endif
        @if($content->video_url != '')
        <li class="tab-link rounded-top py-2 px-3" data-tab="video">วิดีโอ</li>
        @endif
        <li class="tab-link rounded-top py-2 px-3" data-tab="about">รายละเอียด</li>
        <li class="tab float-right mr-3 py-2 px-3 text-danger" id="screenToggle"><i class="fa fa-expand"></i> &nbsp;แสดงเต็มจอ</li>
    </ul>

    <div class="tab-contents shadow rounded-lg p-1 bg-dark">
        <div class="tab-pane current" id="book">
            @if($content->type_book == 0)
                <iframe src="{{asset('storage/book/'.$content->fileUrl)}}" frameborder="0" class="w-100"></iframe>
            @else
                <iframe src="/viewer/?file={{asset('storage/book/'.$content->fileUrl)}}" frameborder="0" class="w-100"></iframe>
            @endif
        </div>
        <div class="tab-pane" id="quize">
        @if($content->link_test != '')
            <iframe src="{{$content->link_test}}" frameborder="0" class="w-100"></iframe>
        @endif
        </div>
        <div class="tab-pane" id="quizebefore">
        @if($content->link_pretest != '')
            <iframe src="{{$content->link_pretest}}" frameborder="0" class="w-100"></iframe>
        @endif
        </div>
        <div class="tab-pane" id="video">
        @if($content->video_url != '')
            <iframe src="https://www.youtube.com/embed/{{explode('v=', $content->video_url)[1]}}" frameborder="0" class="w-100"></iframe>
        @endif
        </div>
        <div class="tab-pane p-5" id="about">
            <h3 class="text-white">{{$content->title}}</h3>
            <div class="text-white">{{$content->description}}</div>
            <p class="ml-3">
                @if(!empty($content->gradetitle))
                <div class="text-white ml-3"><i class="fa fa-graduation-cap"></i> {{$content->gradetitle}} </div>
                @endif
                @if(!empty($content->subject))
                <div class="text-white ml-3"><i class="fa fa-folder"></i> {{$content->subject}} > {{$content->topictitle}} </div>
                @endif
            </p>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
    var height = window.innerHeight;
    $('iframe').css('height', height-200)
	$('.tabs li.tab-link').on('click', function() {
		var tabId = $(this).attr('data-tab');

		$('.tabs li.tab-link').removeClass('current');
		$('.tab-pane').removeClass('current'); 

		$(this).addClass('current');
		$('#' + tabId).addClass('current');
    });
    $('#screenToggle').on('click', function() {
        var content = $('.tab-contents')
        var _this = $(this)
        
        if(content.hasClass('fullscreen')) {
            content.removeClass('fullscreen')
            _this.html('<i class="fa fa-expand"></i>&nbsp; แสดงเต็มจอ')
            _this.css( 'position', 'static' )
        }
        else {
            content.addClass('fullscreen')
            _this.html('<i class="fa fa-compress"></i>&nbsp; ย่อขนาด')
            _this.css( 'position', 'absolute' )
            _this.css( 'top', '90px' )
            _this.css( 'right', '20px' )
        }
        // content.find('iframe').css('height')
    })
});
</script>
@endsection
