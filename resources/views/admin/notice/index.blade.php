@extends('layout.admin')


@section('content')
<div class="content">
       <h2>공지사항 등록</h2>
       <div class="table-wrap">
       <table width="100%" class="table" cellpadding="0" cellspacing="0">
              <colgroup>
              <col width="55px">
              <col width="370px"/>
              <col width="100px">
              <col width="75px">
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
                            <td><a href="/_admin/notice/detail/{{$item->id}}">{{$item->title}}</a></td>
                            <td>{{$item->createdate}}</td>
                            <td>{{$item->hit == null ? 0 : $item->hit}}</td>
                     </tr>
                     @empty
                            <tr> <td colspan="4" style="text-align: center">데이터가 존재하지 않습니다.</td></tr>
                     @endforelse  
              </tbody>
       </table>
       </div>
       <div class="btn-wrap">
              <button type="button" class="btn btn-write float-right" onclick="window.location.href='/_admin/notice/reg'">글쓰기</button>
       </div>
       @include('admin.common.page')
</div>
@stop
