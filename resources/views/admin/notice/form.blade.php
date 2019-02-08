@extends('layout.admin')


@section('content')

<script type="text/javascript">
var oEditors = [];

function onAction(){
    oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);
    
    if($('#upload').val() == ''){
        $('#regFrm').submit();
    }
    else {
        
        fileUpload('notice','regFrm');
    }
}


$(function(){
      nhn.husky.EZCreator.createInIFrame({
          oAppRef: oEditors,
          elPlaceHolder: "content", //textarea에서 지정한 id와 일치해야 합니다. 
          //SmartEditor2Skin.html 파일이 존재하는 경로
          sSkinURI: "/SE2/SmartEditor2Skin.html",  
          htParams : {
              // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
              bUseToolbar : true,             
              // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
              bUseVerticalResizer : true,     
              // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
              bUseModeChanger : true,         
              fOnBeforeUnload : function(){
                   
              }
          }, 
          fOnAppLoad : function(){
              //기존 저장된 내용의 text 내용을 에디터상에 뿌려주고자 할때 사용
              oEditors.getById["content"].exec("PASTE_HTML", ['{!!old("content")!!}']);
          },
          fCreator: "createSEditor2"
      });
});   
    
</script>


<div class="content">
    <form id="regFrm" name="regFrm" method="post" action="/_admin/notice/reg">
        {!! csrf_field() !!}
    <h2>공지사항 등록</h2>                
    <div class="table-wrap">
        <table width="100%" class="table-row table-view" cellpadding="0" cellspacing="0">
            <colgroup>
                <col width="80px">
                <col width="400px">
                <col width="80px">
                <col width="40px">
            </colgroup>    
            <tr>
                <th>제목</th>
                <td>
                    <label>
                        <input style="width:380px;" type="text" id="title" name="title" class="form-text" value="{{old('title')}}" placeholder="제목을 입력해주세요.">
                        {!! $errors->first('title', '<br/><span class="form-error">:message</span>') !!}
                    </label>
                </td>
                <th>상위 노출</th>
                <td class="center">
                    <label>
                        <input type="checkbox" name="ordering" id="ordering" class="form-checkbox" value="9" {{old('ordering') == 9 ? 'checked' : ''}} /> 
                        
                    </label>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="table-editor">
                        <textarea rows="10" cols="30" id="content" name="content" style="width:650px; height:350px; "></textarea>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="table-search-wrap">
        <div class="left"> 
            <div class="dataTables_filter">
            파일첨부 :
            <label>  <input type="hidden" id="file_id" name="file_id" />
                    <input type="file" class="form-file" id="upload" name="upload" />
            </label>
            
            </div>                      
        </div>
    </div>
    </form>
    <div class="btn-wrap">
        <button type="button" class="btn btn-write float-right"  onclick="onAction();">등록하기</button>
        <button type="button" class="btn btn-cancel float-left" onclick="window.location.href='/_admin/notice';">취소하기</button>
    </div>
</div>
@stop



