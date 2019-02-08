@extends('layout.admin')


@section('content')
<div class="content">
       <h2>편성표 등록</h2>
       <div class="table-search-wrap">
       <div class="left"> 
       <form action="/_admin/pairing/update" method="post" id="pairFrm" name="pairFrm">
              {!! csrf_field() !!}
              @if(!empty($pairing))
                     <input type="hidden" id="id" name="id" value="{{$pairing->id}}"/>
              @else 
                     <input type="hidden" id="id" name="id" value="0"/>
              @endif
              <input type="hidden" id="file_id" name="file_id" />
              <div class="dataTables_filter">
              이미지 등록 :
              <label>
                     <input type="file" name="upload" id="upload" class="form-control" /> 
                            <button type="button" class="btn btn-search float-right" onclick="fileUpload('pairing','pairFrm')">수정하기</button>
                     </label>
                     <span class="notice">※ 권장 사이즈 : 가로 800px</span>
                     
              </div>                      
       </form>
       </div>
       </div>
       <h3>현재 등록 이미지</h3>
       <div class="table-wrap">
       <table width="100%" class="table-row" cellpadding="0" cellspacing="0">
              <colgroup>
              <col width="600px">
              </colgroup>                               
              
              <tr>
              <td>
                     <div class="table-textarea">
                     @if(!empty($pairing))
                            <img src="{{$file->file_path}}/{{$file->file_name}}" border="0"/>
                     @else 
                            등록된 편성표가 없습니다.
                     @endif
                     </div>
              </td>
              </tr>
       </table>
       </div>
       <!--
              <div class="btn-wrap">
                     <button type="button" class="btn btn-write float-right">메인배너 적용하기</button>
              </div>
       -->

</div>
@stop
