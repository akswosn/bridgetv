@extends('layout.admin')


@section('content')
<script>
function onDelete(id){
       if(confirm('삭제하시겠습니까?') == true){
              window.location.href='/_admin/banner/delete/'+id;
       }
}

function onAddMain(id, cnt){
       window.location.href='/_admin/banner/addMain/'+id;
}

function onRemoveMain(id){
       if(confirm('이미지 라이브러리로 이동하시겠습니까?') == true){
              window.location.href='/_admin/banner/deleteMain/'+id;
       }
}
</script>

<div class="content">
<form action="/_admin/banner/update" method="post" id="pairFrm" name="pairFrm">
       {!! csrf_field() !!}
       <input type="hidden" id="file_id" name="file_id" />
       <input type="hidden" id="id" name="id" value="0"/>
       <h2>메인배너 등록</h2>
       <div class="table-search-wrap">
       <div class="left"> 
              <div class="dataTables_filter">
              이미지 등록 :
              <label>
                     <input type="file" name="upload" id="upload" class="form-control" placeholder="제목, 내용">
                     <button type="button" class="btn btn-search float-right" onclick="fileUpload('banner','pairFrm')">등록하기</button>
              </label>
              <span class="notice">※ 권장 사이즈 : 가로 1200px  높이 400px</span>
              
              </div>                      
       </div>
       </div>
       <!--
       <h3>현재 등록 이미지</h3>
       <div class="table-wrap">
       <table width="100%" class="table-row" cellpadding="0" cellspacing="0">
              <colgroup>
                     <col width="25px">
                     <col width="520px">
                     <col width="55px">
              </colgroup>                               
              @forelse($lib_banner as $index => $item)
              <tr>
                     <th>{{$index+1}}</th>
                     <td>
                            <div class="table-textarea">
                                   <img src="{{$files[$item->id]->file_path}}/{{$files[$item->id]->file_name}}" border="0">
                            </div>
                     </td>
                     <td class="center">
                            <button type="button" class="btn btn-delete float-right" onclick="onDelete({{$item->id}});">삭제</button>
                     </td>
              </tr>
              @empty
                     <tr> <th colspan="3" style="text-align: center">베너가 존재하지 않습니다.</th></tr>
              @endforelse 
              

       </table>
       </div>-->
              <h3>이미지 라이브러리</h3>
              <div class="table-wrap">
                     <div class="program-wrap form-background-gray">
                     <ul style="padding: 20px 10px;">
                     @forelse($lib_banner as $index => $item)
                            <li>
                                   <a href="#"><img src="{{$files[$item->id]->file_path}}/{{$files[$item->id]->file_name}}"></a>
                                   <div style="text-align:center">
                                          <button type="button" class="btn btn-default" onclick="onAddMain({{$item->id}});">메인에등록</button>
                                          <button type="button" class="btn btn-danger" onclick="onDelete({{$item->id}});">삭제</button>
                                   </div>
                            </li>
                     @empty
                            <li style="width:100%;text-align:center">베너가 존재하지 않습니다.<li>
                     @endforelse 
                            
                     </ul>
              </div>
              @include('admin.common.page')

              <h3>현재 등록 이미지</h3>
              <div class="program-wrap form-background-gray">
                     <ul style="padding: 20px 10px;">
                            @forelse($main_banner as $index => $item)
                                   <li>
                                          <a href="#"><img src="{{$files[$item->id]->file_path}}/{{$files[$item->id]->file_name}}"></a>
                                          <div style="text-align:center">
                                                 <button type="button" class="btn btn-danger"  onclick="onRemoveMain({{$item->id}});">삭제</button>
                                          </div>
                                   </li>
                            @empty
                                   <li style="width:100%;text-align:center">베너가 존재하지 않습니다.<li>
                            @endforelse 
                     </ul>
              </div>
              </div>
       </form>


</div>
@stop
