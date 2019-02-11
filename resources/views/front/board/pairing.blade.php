
@extends('layout.front')


@section('content')
<div class="tab">
    <ul class="nav">
        <li>
            <a class="nav-link" href="/board/notice">공지사항</a>
        </li>
        <li>
            <a class="nav-link active show" href="/board/pairing">편성표</a>
        </li>
        <li>
            <a class="nav-link" href="/board/feedback">시청자 의견</a>
        </li>
    </ul>
</div>
<!-- 편성표 시작 -->
<div class="pairing-wrap">
    <p>
    @if(!empty($pairing))
        <img src="{{$file->file_path}}/{{$file->file_name}}" border="0"/>
    @else 
        등록된 편성표가 없습니다.
    @endif
    </p>
</div>
<!-- 편성표 끝 -->
@stop

        

