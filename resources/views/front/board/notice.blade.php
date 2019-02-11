
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

<!-- 공지사항 리스트 시작 -->
<div class="table-wrap">
    <table width="100%" class="table" cellpadding="0" cellspacing="0">
        <colgroup class="pc-colgroup">
            <col width="55px">
            <col width="370px"/>                        
            <col width="100px">
            <col width="75px">
        </colgroup>   
        <colgroup class="mb-colgroup">
            <col width="15%">
            <col width="45%"/>                        
            <col width="25%">
            <col width="15%">
        </colgroup>                      
        <thead>
            <tr>
                <th>분류</th>
                <th>제목</th>
                <th>작성일</th>
                <th>조회수</th>
            </tr>
        </thead>
        <tbody>
        @forelse($notice as $item)
        <tr>
            <td>공지</td>
            <td><a href="/board/notice/detail/{{$item->id}}">{{$item->title}}</a></td>
            <td>{{$item->createdate}}</td>
            <td>{{$item->hit == null ? 0 : $item->hit}}</td>
        </tr>
        @empty
            <tr> <td colspan="4" style="text-align: center">데이터가 존재하지 않습니다.</td></tr>
        @endforelse  
        </tbody>
    </table>
</div>
@include('admin.common.page')
<!-- 공지사항 리스트 끝 -->
@stop

        

