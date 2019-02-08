@extends('layout.admin')


@section('content')
<div class="content">
       <h2>시청자 의견</h2>
       <div class="table-search-wrap">
              <div class="left">
                     <p>총 {{$count}}개</p>                        
              </div>

              <div class="right">
                     <div class="dataTables_filter">
                     <label>
                            <input type="search" class="form-control" placeholder="제목, 내용">
                            <button type="button" class="btn btn-search float-right">검색</button>
                     </label>
                     
                     </div>
              </div>
       </div>
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
                     <th>번호</th>
                     <th>제목</th>
                     <th>이름</th>
                     <th>등록일</th>
                     <th>확인여부</th>
              </tr>
              </thead>
              <tbody>
              @forelse($feedback as $index => $item)
              <tr>
                     <td>{{$count - (($listCount * ($page-1)) + $index)}}</td>
                     <td><a href="/_admin/feedback/detail/{{$item->id}}">{{substr($item->content, 0, 20)}}</a></td>
                     <td>{{$item->name}}</td>
                     <td>{{$item->createdate}}</td>
                     <td>{{strpos('|'.session('user')->id.'|', $item->hit_id) !== false ? '확인' : '미확인'}} </td>
              </tr>
              @empty
                     <tr> <td colspan="5" style="text-align: center">데이터가 존재하지 않습니다.</td></tr>
              @endforelse  
              </tbody>
       </table>
       </div>
       @include('admin.common.page')
      
</div>
@stop
