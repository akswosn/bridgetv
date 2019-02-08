@extends('layout.admin')


@section('content')
<script>
function onAction(){
    if($('#file_id').val() === ''){
        fileUpload('program','regFrm');
    }
    else {
        $('#regFrm').submit();
    }
}

</script>
<div class="content">
    <form id="regFrm" name="regFrm" action="/_admin/program/regist" method="post">
    {!! csrf_field() !!}
    <h2>프로그램 등록</h2>
    <h3>기본 정보 입력</h3>
    <div class="table-wrap">
        <table width="100%" class="table-row" cellpadding="0" cellspacing="0">
            <colgroup>
                <col width="120px">
                <col width="480px">
            </colgroup>    
            <tr>
                <th>구분</th>
                <td>
                    <label>
                        <input type="radio" name="type" id="type1" value="1" class="form-radio" {{empty(old('type')) || old('type')=='1' ? 'checked' : '' }} > 방영
                    </label>
                    <label>
                        <input type="radio" name="type" id="type0" value="0" class="form-radio" {{ old('type') == '0' ? 'checked' : ''}}>  종영 
                    </label>
                </td>
            </tr>
            <tr>
                <th>프로그램명</th>
                <td>
                    <label>
                        <input style="width:480px" type="text" id="name" name="name" class="form-text" placeholder="프로그램명 입력해주세요."value="{{old('name')}}">
                    </label>
                    {!! $errors->first('name', '<br/><span class="form-error">:message</span>') !!}
                </td>
            </tr>
            <tr>
                <th>기획의도</th>
                <td>
                    <label>
                        <input style="width:480px" type="text" id="planning" name="planning" class="form-text" placeholder="기획의도를 입력해주세요." value="{{old('planning')}}">
                    </label>
                </td>
            </tr>
            <tr>
                <th>장르</th>
                <td>
                    <label>
                        <input style="width:480px" type="text" id="genre" name="genre" class="form-text" placeholder="장르를 입력해주세요." value="{{old('genre')}}">
                    </label>
                </td>
            </tr>
            <tr>
                <th>길이</th>
                <td>
                    <label>
                        <input style="width:480px" type="text" id="playtime" name="playtime" class="form-text" placeholder="길이를 입력해주세요." value="{{old('playtime')}}">
                    </label>
                </td>
            </tr>
            <tr>
                <th>출연진</th>
                <td>
                    <label>
                        <input style="width:480px" type="text" id="cast" name="cast" class="form-text" placeholder="출연진을 입력해주세요." value="{{old('cast')}}">
                    </label>
                </td>
            </tr>
        </table>
    </div>


    <div class="table-search-wrap">
        <div class="left"> 
            <div class="dataTables_filter">
                대표 이미지 :
                <label>
                    <input type="file" class="form-file" name="upload" id="upload" style="height: 34px;" value=""/> {{!empty(old('upload')) ? '파일명 : '.old('upload'):''}}
                    <input type="hidden" id="file_id" name="file_id" value="{{old('file_id')}}"/>
<!--
                    <button type="button" class="btn btn-search float-right">수정하기</button>
-->
                </label>
            </div>                      
        </div>
    </div>
<!--
    <h3>회차 영상 등록</h3>
    <div class="table-wrap">
        <table width="100%" class="table" cellpadding="0" cellspacing="0">
            <colgroup>
                <col width="55px">
                <col width="200px">
                <col width="145px"/>
                <col width="100px">
                <col width="100px">
            </colgroup>                                
            <thead>
                <tr>
                    <th>회차</th>
                    <th>제목</th>
                    <th>유튜브 링크</th>
                    <th>최근 수정일시</th>
                    <th>회차 영상 관리</th>
                </tr>
            </thead>
            <tbody id="sectionList">
                <tr>
                    <td colspan="5" class="center"><button type="button" class="btn btn-add" onclick="addSection();">회차 영상 추가하기 +</button></td>
                </tr>
                <tr>
                    <td>1회
                        <input type="hidden" id="section_1" name="section" value="1"/>
                    </td>
                    <td>
                        <label>
                            <input style="width:200px" type="text" class="form-text" placeholder="제목을 입력해주세요.">
                        </label>
                    </td>
                    <td>
                        <label>
                                <input type="text" class="form-text" placeholder="유튜브 링크">
                        </label>
                    </td>
                    <td>2019-01-01 00:00:00</td>
                    <td>
                        <button type="button" class="btn btn-save">저장</button>
                        <button type="button" class="btn btn-delete">제거</button>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
-->
    <div class="btn-wrap">
        <button type="button" class="btn btn-write float-right" onclick="onAction()">등록하기</button>
        <button type="button" class="btn btn-cancel float-left" onclick="window.location.href='/_admin/program/list';">취소하기</button>
        <!--
            <button type="button" class="btn btn-delete float-left"  onclick="">삭제하기</button>
    -->
    </div>
    </form>
</div>
@stop
