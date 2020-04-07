@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="tabs" role="tablist">
        <li class="tab-link current" data-tab="book"><a href="#" class="btn-link">หนังสือ</a></li>
        @if($content[0]->link_test != '')
        <li class="tab-link" data-tab="quize"><a href="#"class="btn-link">ข้อสอบ/แบบฝึกหัด</a>
        @endif
        <li class="tab-link" data-tab="share"><a href="#"class="text-info"> <i class="fa fa-share"></i> &nbsp;แชร์</a>
        <li class="tab" id="screenToggle"><a href="#"class="text-danger"><i class="fa fa-expand"></i> &nbsp;แสดงเต็มจอ</a>
    </ul>


    <div class="tab-contents shadow">
        <div class="tab-pane current" id="book"><iframe src="{{asset('storage/book/'.$content[0]->fileUrl)}}" frameborder="0" class="w-100"></iframe></div>
        <div class="tab-pane" id="quize">
        @if($content[0]->link_test != '')
            <iframe src="{{$content[0]->link_test}}" frameborder="0" class="w-100"></iframe>
        @endif
        </div>

        <div class="tab-pane" id="share">
            <h3>Share</h3>
            <div class="shareContainer">
                <div class="d-flex justify-content-between"><a target="_blank" rel="noopener" href="https://www.facebook.com/share.php?u={{urlencode(url()->current())}}" class="btn btn-default"><i class="fab fa-facebook-square"></i> Facebook</a></div>
                <div class="d-flex justify-content-between"><a target="_blank" rel="noopener" href="https://www.instagram.com/?url={{urlencode(url()->current())}}" class="btn btn-default"><i class="fab fa-instagram"></i> Instagram</a></div>
                <div class="d-flex justify-content-between"><a target="_blank" rel="noopener" href="https://twitter.com/share?text={{urlencode($content[0]->title)}}&url={{urlencode(url()->current())}}" class="btn btn-default"><i class="fab fa-twitter"></i> Twitter</a></div>
                <div class="d-flex justify-content-between"><a target="_blank" rel="noopener" href="https://lineit.line.me/share/ui?url={{urlencode(url()->current())}}" class="btn btn-default"><i class="fab fa-line"></i> Line</a></div>
                <div class="d-flex justify-content-between"><a target="_blank" rel="noopener" href="mailto:?subject={{urlencode($content[0]->title)}}&body={{urlencode(url()->current())}}" class="btn btn-default"><i class="fa fa-envelope"></i> Email</a></div>
            </div>
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
        if(content.hasClass('fullscreen')) {
            $(this).find('a').html('<i class="fa fa-expand"></i>&nbsp; แสดงเต็มจอ')
            content.removeClass('fullscreen')
        }
        else {
            $(this).find('a').html('<i class="fa fa-compress"></i>&nbsp; ย่อขนาด')
            content.addClass('fullscreen')
        }
        // content.find('iframe').css('height')
    })
});
</script>
@endsection