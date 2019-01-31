@extends('layout.admin')


@section('content')
<div>
        시청자의견 리스트<br/>
        <table>
              <thead>
                     <tr>
                            <th>번호</th>
                            <th>내용</th>
                            <th>이름</th>
                            <th>등록일</th>
                            <th>확인</th>
                     </tr>
              </thead>
              @forelse($feedback as $item)
              @empty
                     <tr> <td colspan="5" style="text-align: center">데이터가 존재하지 않습니다.</td></tr>
              @endforelse  
        </table>

       count : {{$count->count}}
</div>
@stop
