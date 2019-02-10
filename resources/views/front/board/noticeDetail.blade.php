
@extends('layout.front')


@section('content')
<div class="tab">
    <ul class="nav">
        <li>
            <a class="nav-link active show" href="/board/notice">공지사항</a>
        </li>
        <li>
            <a class="nav-link" href="/board/pairing">편성표</a>
        </li>
        <li>
            <a class="nav-link" href="/board/feedback">시청자 의견</a>
        </li>
    </ul>
</div>
<!-- 공지사항 뷰 시작 -->
<div class="table-wrap">
    <table width="100%" class="table-row table-view" cellpadding="0" cellspacing="0">
        <colgroup class="pc-colgroup">
            <col width="80px">
            <col width="240px">
            <col width="80px">
            <col width="60px">
            <col width="80px">
            <col width="60px">
        </colgroup>    
        <colgroup class="mb-colgroup">
            <col width="20%">
            <col width="80%"/>   
        </colgroup>    
        <tr class="pc-tr">
            <th>제목</th>
            <td>{{$notice->title}}</td>
            <th>작성일</th>
            <td>{{$notice->createdate}}</td>
            <th>조회수</th>
            <td>{{empty($notice->hit) ? 0 : $notice->hit}}</td>
        </tr>
        <tr class="mb-tr">
            <th>제목</th>
            <td colspan="5">{{$notice->title}}</td>
        </tr>                      
        <tr>
            <td colspan="6">
                <div class="table-textarea">
                {!!$notice->content!!}
                </div>    
            </td>
        </tr>
        <tr>
            <th>다음글</th>
            <td colspan="5">
                @if(!empty($next))
                    <a href="/board/notice/detail/{{$next->id}}">{{$next->title}}</a>
                @else
                    <p class="page-none">다음글이 없습니다.</p>
                @endif
            </td>
        </tr>
        <tr>
            <th>이전글</th>
            <td colspan="5">
                @if(!empty($pre))
                    <a href="/board/notice/detail/{{$pre->id}}">{{$pre->title}}</a>
                @else 
                    <p class="page-none">이전글이 없습니다.</p>
                @endif
            </td>
        </tr>
    </table>
</div>            
<div class="btn-wrap">
    <ul>
        <li>
            <button type="button" class="btn btn-write float-right">목록</button>
        </li>
    </ul>
</div>
<!-- 공지사항 뷰 끝 -->

@stop

        

