@extends('layout.admin')


@section('content')
<script>
function onAction(){
    $('#regFrm').submit();
}

function addSection(){

    var max = Number($('#sectionCnt').val());

    //console.log(max);
    max = Number(max) + 1;
    var html  = '<tr id="section_view_'+max+'">'
                +'    <td>'+max+'회'
                +'        <input type="hidden" id="section_'+max+'" name="section_'+max+'" value="'+max+'"/>'
                +'        <input type="hidden" id="id_'+max+'" name="id_'+max+'" value=""/>'
                +'    </td>'
                +'    <td>'
                +'        <label>'
                +'            <input style="width:200px" type="text" class="form-text" id="title_'+max+'" name="title_'+max+'" value="" placeholder="제목을 입력해주세요.">'
                +'        </label>'
                +'    </td>'
                +'    <td>'
                +'        <label>'
                +'                <input type="text" class="form-text" placeholder="유튜브 링크" id="movie_link_'+max+'" name="movie_link_'+max+'" value="">'
                +'        </label>'
                +'    </td>'
                +'    <td></td>'
                +'    <td>'
                +'        <button type="button" class="btn btn-save" onclick="onSectionAction(\'delete\', '+max+')">삭제</button>      '
                +'    </td>'
                +'</tr>';
    
    $('#sectionList').append($(html));
    $('#sectionCnt').val(max);
    
}

function onSectionAction(type, section, id ){
    if(Number(section) != Number($('#sectionCnt').val())){
        alert('마지막 섹션만 삭제 가능합니다.');
        return;
    }
    else {
        if(type=='deleteSec'){
            
            $.ajax({
                url: '/_admin/programSection/delete/'+id,
               
                processData: false, 
                contentType: false, 
                type: 'GET',
                success: function(result){
                    

                    $('#section_view_'+section).remove();
                    $('#sectionCnt').val(Number($('#sectionCnt').val())-1);
                   
                    
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errJson = JSON.parse(xhr.responseText)
                    // console.log(xhr.responseText);
                    // console.log(ajaxOptions);
                    // alert(xhr.status);
                    // alert(thrownError);
                    //
                    $('#fileError').remove();
                    $('body').append('<div id="fileError" class="message_box error"><span>'+errJson.err+'</span></div>');
                    $('#fileError').click(function(){
                        $(this).fadeOut('slow');
                    });
                }
            
            });
        }
        else {

            $('#section_view_'+section).remove();
            $('#sectionCnt').val(Number($('#sectionCnt').val())-1);
        }

    }
}

function onDelete(){
    if(confirm('삭제하시겠습니까?')==true){
        window.location.href='/_admin/program/delete/{{$program->id}}';
    }
}

</script>
<div class="content">
    <form id="regFrm" name="regFrm" action="/_admin/program/update" method="post">
    {!! csrf_field() !!}
    <input type="hidden" id="id" name="id" value="{{$program->id}}"/>
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
                        <input type="radio" name="type" id="type1" value="1" class="form-radio" {{$program->type == 1 ? 'checked' : ''}}> 방영
                    </label>
                    <label>
                        <input type="radio" name="type" id="type0" value="0" class="form-radio" {{$program->type == 0 ? 'checked' : ''}}> 종영
                    </label>
                </td>
            </tr>
            <tr>
                <th>프로그램명</th>
                <td>
                    <label>
                        <input style="width:480px" type="text" id="name" name="name" class="form-text" placeholder="프로그램명 입력해주세요." value="{{$program->name}}">
                    </label>
                </td>
            </tr>
            <tr>
                <th>기획의도</th>
                <td>
                    <label>
                        <input style="width:480px" type="text" id="planning" name="planning" class="form-text" placeholder="기획의도를 입력해주세요." value="{{$program->planning}}">
                    </label>
                </td>
            </tr>
            <tr>
                <th>장르</th>
                <td>
                    <label>
                        <input style="width:480px" type="text" id="genre" name="genre" class="form-text" placeholder="장르를 입력해주세요." value="{{$program->genre}}">
                    </label>
                </td>
            </tr>
            <tr>
                <th>길이</th>
                <td>
                    <label>
                        <input style="width:480px" type="text" id="playtime" name="playtime" class="form-text" placeholder="길이를 입력해주세요." value="{{$program->playtime}}">
                    </label>
                </td>
            </tr>
            <tr>
                <th>출연진</th>
                <td>
                    <label>
                        <input style="width:480px" type="text" id="cast" name="cast" class="form-text" placeholder="출연진을 입력해주세요." value="{{$program->cast}}">
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
                    <!--
                        -->
                        <input type="file" class="form-file" name="upload" id="upload" style="height: 34px;" value=""/>
                        <input type="hidden" id="file_id" name="file_id" value="{{$program->file_id}}"/>
                        <button type="button" class="btn btn-search float-right" onclick="fileUpload('program',null);">수정하기</button>
                    </label>
                    <img src="{{$file->file_path.'/'.$file->file_name}}"/>
            </div>                      
        </div>
    </div>
    
    
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
                    <td colspan="5" class="center"><button type="button" class="btn btn-add" onclick="addSection();">회차 영상 추가하기 +</button>
                    <input type="hidden" id="sectionCnt" name="sectionCnt" value="{{count($programSection) == 0 ? 1 : count($programSection)}}"/>
                </td>
                </tr>
                @forelse($programSection as $index => $section)
                <tr id="section_view_{{$section->section}}">
                    <td>{{$section->section}}회
                        <input type="hidden" id="section_{{$section->section}}" name="section_{{$section->section}}" value="{{$section->section}}"/>
                        <input type="hidden" id="id_{{$section->section}}" name="id_{{$section->section}}" value="{{$section->id}}"/>
                    </td>
                    <td>
                        <label>
                            <input style="width:200px" type="text" class="form-text" id="title_{{$section->section}}" name="title_{{$section->section}}" value="{{$section->title}}" placeholder="제목을 입력해주세요.">
                        </label>
                    </td>
                    <td>
                        <label>
                                <input type="text" class="form-text" placeholder="유튜브 링크" id="movie_link_{{$section->section}}" name="movie_link_{{$section->section}}" value="{{$section->movie_link}}">
                        </label>
                    </td>
                    <td>{{empty($section->updatedate) ? $section->createdate : $section->updatedate}}</td>
                    <td>
                        <!--
                        <button type="button" class="btn btn-save" onclick="onSectionAction('regist', {{$section->section}})">저장</button>
                        -->
                        <button type="button" class="btn btn-delete" onclick="onSectionAction('deleteSec', {{$section->section}}, {{$section->id}})">제거</button>
                    </td>
                </tr>
                @empty
                <tr id="section_view_1">
                    <td>1회
                        <input type="hidden" id="section_1" name="section_1" value="1"/>
                        <input type="hidden" id="id_1" name="id_1" value=""/>
                    </td>
                    <td>
                        <label>
                            <input style="width:200px" type="text" class="form-text" id="title_1" name="title_1" value="" placeholder="제목을 입력해주세요.">
                        </label>
                    </td>
                    <td>
                        <label>
                                <input type="text" class="form-text" placeholder="유튜브 링크" id="movie_link_1" name="movie_link_1" value="">
                        </label>
                    </td>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-save" onclick="onSectionAction('delete', 1, 0)">삭제</button>
                        
                    </td>
                </tr>
                
                @endforelse  
            </tbody>
        </table>
    </div>

    <div class="btn-wrap">
        <button type="button" class="btn btn-write float-right" onclick="onAction()">수정하기</button>
        <button type="button" class="btn btn-cancel float-left" onclick="window.location.href='/_admin/program/list';">취소하기</button>
        <button type="button" class="btn btn-delete float-left" onclick="onDelete()" >삭제하기</button>
    </div>
    </form>
</div>
@stop
