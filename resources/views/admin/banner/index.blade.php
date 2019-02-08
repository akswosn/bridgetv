@extends('layout.admin')


@section('content')
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
                     <button type="button" class="btn btn-search float-right" onclick="fileUpload('banner','pairFrm')">수정하기</button>
              </label>
              <span class="notice">※ 권장 사이즈 : 가로 1200px  높이 400px</span>
              
              </div>                      
       </div>
       </div>
       <h3>현재 등록 이미지</h3>
       <div class="table-wrap">
       <table width="100%" class="table-row" cellpadding="0" cellspacing="0">
              <colgroup>
                     <col width="25px">
                     <col width="520px">
                     <col width="55px">
              </colgroup>                               
              @forelse($banner as $index => $item)
              <tr>
                     <th>{{$index+1}}</th>
                     <td>
                            <div class="table-textarea">
                                   <img src="/images/banner.jpg" border="0">
                            </div>
                     </td>
                     <td class="center">
                            <button type="button" class="btn btn-delete float-right">삭제</button>
                     </td>
              </tr>
              @empty
                     <tr> <th colspan="3" style="text-align: center">베너가 존재하지 않습니다.</th></tr>
              @endforelse 
              
<!--
              <th>2</th>
              <td>
                     <div class="table-textarea">
                            <img src="/images/banner.jpg" border="0">
                     </div>
              </td>
              <td class="center"><button type="button" class="btn btn-delete float-right">삭제</button></td>
              </tr>
-->
       </table>
       </div>
       <div class="btn-wrap">
              <button type="button" class="btn btn-write float-right">메인배너 적용하기</button>
       </div>
      
       </form>
</div>
@stop
