@extends('layout.admin')


@section('content')
<div class="content">
       <h2>프로그램 리스트</h2>
       <div class="table-wrap">
       <table width="100%" class="table" cellpadding="0" cellspacing="0">
              <colgroup>
              <col width="55px">
              <col width="70px">
              <col width="300px"/>
              <col width="75px">
              <col width="100px">
              </colgroup>                                
              <thead>
              <tr>
                     <th>번호</th>
                     <th>구분</th>
                     <th>프로그램명</th>
                     <th>회차수</th>
                     <th>최근 수정일</th>
              </tr>
              </thead>
              <tbody>
             
              @forelse($program as $index => $item)
                     <tr>
                            <td>{{$count - (($listCount * ($page-1)) + $index)}}</td>
                            <td>{{$item->type == 0 ? '종방' : '방영중'}}</td>
                            <td><a href="/_admin/program/detail/{{$item->id}}">{{$item->name}}</a></td>
                            <td>{{$sectionCount[$item->id]}}</td>
                            <td>{{empty($item->updatedate) ? $item->createdate : $item->updatedate}}</td>
                     </tr>
              @empty
                     <tr> <td colspan="5" style="text-align: center">데이터가 존재하지 않습니다.</td></tr>
              @endforelse  
              </tbody>
       </table>
       </div>
       <div class="btn-wrap">
       <button type="button" class="btn btn-write float-right" onclick="window.location.href='/_admin/program/regist'">프로그램 등록</button>
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
