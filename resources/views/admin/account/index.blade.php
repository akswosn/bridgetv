@extends('layout.admin')


@section('content')
<div>
       관리자 아이디 설정<br/>

       <table>
              <thead>
                     <tr>
                            <th>구분</th>
                            <th>아이디</th>
                            <th>이름</th>
                            <th>등록일</th>
                            <th>삭제</th>
                     </td>
              </thead>
              <tbody>
              @forelse($account as $item)
                     <tr>
                            <td>{{$item->type}}</td>
                            <td><a href="/_admin/account/detail/{{$item->id}}">{{$item->userid}}</a></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->createdate}}</td>
                            <td><a href="/_admin/account/delete/{{$item->id}}">삭제</a></td>
                     </tr>
              @empty
                     <tr> <td colspan="5" style="text-align: center">데이터가 존재하지 않습니다.</td></tr>
              @endforelse                     
              </tbody>
       </table>
<a class="btn btn-primary" href="/_admin/account/reg">추가</a>
</div>
@stop