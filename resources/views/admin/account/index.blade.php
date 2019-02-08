@extends('layout.admin')


@section('content')
<script>
function onDelete(id){

       if(confirm('삭제하시겠습니까?') == true){

              window.location.href='/_admin/account/delete/'+id;
       }
}

</script>
<div class="content">
<h2>관리자 아이디 설정</h2>
<div class="table-wrap">
<table width="100%" class="table" cellpadding="0" cellspacing="0">
       <colgroup>
       <col width="55px">
       <col width="270px">
       <col width="100px"/>
       <col width="100px">
       <col width="75px">
       </colgroup>                                
       <thead>
       <tr>
              <th>구분</th>
              <th>아이디</th>
              <th>이름</th>
              <th>등록일</th>
              <th>삭제</th>
       </tr>
       </thead>
       <tbody>
       @forelse($account as $item)
              <tr>
                     <td>{{$item->type === 1 ? '마스터':'일반'}}</td>
                     <td><a href="/_admin/account/detail/{{$item->id}}">{{$item->userid}}</a></td>
                     <td>{{$item->name}}</td>
                     <td>{{$item->createdate}}</td>
                     <td><button onclick="onDelete('{{$item->id}}');" class="btn btn-delete float-right">삭제</button></td>
              </tr>
       @empty
              <tr> <td colspan="5" style="text-align: center">데이터가 존재하지 않습니다.</td></tr>
       @endforelse  
       </tbody>
</table>
</div>
<div class="btn-wrap">
       <button type="button" class="btn btn-write float-right" onclick="window.location.href='/_admin/account/reg';">관리자 아이디 추가</button>
</div>

@include('admin.common.page')
<!--
<nav class="page-wrap">
<ul class="pagination">
       <li class="page-item">
       <a class="page-link" href="" aria-label="Previous">
              <i class="fa fa-angle-left"></i>
       </a>
       </li>
       <li class="page-item">
       <a class="page-link" href="">1</a>
       </li>
       <li class="page-item">
       <a class="page-link" href="">2</a>
       </li>
       <li class="page-item">
       <a class="page-link" href="">3</a>
       </li>
       <li class="page-item">
       <a class="page-link" href="" aria-label="Next">
              <i class="fa fa-angle-right"></i>
       </a>
       </li>
</ul>
</nav>
-->
</div>

@stop