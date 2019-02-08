@extends('layout.admin')


@section('content')
<div class="content">
       <h2>시청자 의견</h2>                
       <div class="table-wrap">
       <table width="100%" class="table-row table-view" cellpadding="0" cellspacing="0">
              <colgroup>
              <col width="80px">
              <col width="200px">
              <col width="80px">
              <col width="200px">
              <col width="80px">
              <col width="40px">

              </colgroup>    
              <tr>
              <th>이름</th>
              <td>{{$feedback->name}}</td>
              <th>작성일</th>
              <td>{{$feedback->createdate}}</td>
              <th rowspan="2">확인 여부</th>
              <td rowspan="2">
                     <label>
                            <input type="checkbox" name="" value="확인여부" class="form-checkbox"> 
                     </label>
              </td>
              </tr>
              <tr>
              <th>이메일</th>
              <td>{{$feedback->email}}</td>
              <th>휴대폰</th>
              <td>{{$feedback->phone}}</td>
              </tr>
              <tr>
              <td colspan="6">
                     <div class="table-textarea">
                     {{$feedback->content}}
                     </div>
              </td>
              </tr>
              <tr>
              <th>다음글</th>
              <td colspan="5">
                     @if(!empty($next))
                            <a href="/_admin/feedback/detail/{{$next->id}}">{{substr($next->content, 0, 20)}}</a>
                     @else 
                            다음이 없습니다.
                     @endif
              </td>
              </tr>
              <tr>
              <th>이전글</th>
              <td colspan="5">
                     @if(!empty($pre))
                            <a href="/_admin/feedback/detail/{{$pre->id}}">{{substr($pre->content, 0, 20)}}</a>
                     @else 
                            이전이 없습니다.
                     @endif
              </td>
              </tr>
       </table>
       </div>

       <div class="btn-wrap">
              <button type="button" onclick="window.location.href='/_admin/feedback';" class="btn btn-write float-right">목록</button>
       </div>
</div>
@stop
