
@extends('layout.admin')

<script>
function onAction(){
    $('#regFrm').submit();
}


window.onload = function(){
    $('[name="type"]').on('change',function(){
        if($(this).val() == 'custom'){
            $('.pop-layer').show();
            $('.deemed').show();
        }
        else {
            $('.pop-layer').hide();
            $('.deemed').hide();
            $('#option').val('');
        }
    });
}

function onSearch(){
    var keyword = $('#searchKeyword').val();
    $.ajax({
        url: '/_admin/program/search/'+keyword,
        processData: false, 
        contentType: false, 
        type: 'get',
        success: function(result){
			console.log(result);
            $('#layer-list').html('');//초기화
            var html ='';

            for(var i in result){
                html += '<li><a href="javascript:addProgram('+result[i].id+', \''+result[i].name+'\');">'+result[i].name+'</a> </li>';
            }

            if(html === ''){
                html += '<li><p>검색 결과가 없습니다.</p> </li>';
            }
            $('#layer-list').html(html);//초기화
		}
	
	});
}

function addProgram(id, name){
    if($('.selectProgram').length < 5){ // max
        if($('#'+id).length == 0){

            var html = ' <span style="cursor: pointer;" id="'+id+'" class="badge badge-pill badge-success selectProgram" onclick="removeProgram('+id+');">'+name+'</span>';

            $('#addProgram').append(html);
        }
    }
}

function removeProgram(id){
    $('#addProgram #'+id).remove();

}

function onCustom(){
    var value = '';

    $.each($('.badge-success'), function(){
        if(value === ''){
            value += $(this).attr('id');
        }
        else {
            value += ', '+$(this).attr('id');
        }
    })

    $('#option').val(value);
    layerClose();
}

function layerClose(){
    $('.pop-layer').hide();
    $('.deemed').hide();
}


</script>

@section('content')
<div class="content">
    <h2>프로그램 노출</h2>
    <div class="table-wrap">
    <form id="regFrm" name="regFrm" method="post" action="/_admin/program/config">
        {!! csrf_field() !!}
        <input type="hidden" id="id" name="id" value="{{$config->id}}"/>
        <input type="hidden" id="option" name="option" value="{{$config->option}}"/>
        <table width="100%" class="table-row" cellpadding="0" cellspacing="0">
            <colgroup>
                <col width="120px">
                <col width="480px">
            </colgroup>    
            <tr>
                <th rowspan="3">노출순서</th>
                <td>
                    <label>
                        <input type="radio" name="type" value="orderby" class="form-radio" {{empty($type) || $type =='orderby' ? 'checked':''}}> 최신 등록 순
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        <input type="radio" name="type" value="hit" class="form-radio" {{ $type =='hit' ? 'checked':''}}> 조회수 순
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        <input type="radio" name="type" value="custom" class="form-radio" {{ $type =='custom' ? 'checked':''}}> 직접 지정
                    </label>
                    <div class="program-wrap">
                        <ul>
                        @forelse($program as $item)
                            <li>
                                <a href="#"><img src="{{$file[$item->id]->file_path.'/'.$file[$item->id]->file_name}}"></a>
                                <p>{{$item->name}}</p>
                            </li>
                        @empty
                            <li style="width:100%;">
                                <p title="등록된 프로그램이 존재하지 않습니다.">등록된 프로그램이 존재하지 않습니다.</p>
                            </li>
                         @endforelse
                        
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
        </form>
    </div>
    <div class="btn-wrap">
        <button type="button" class="btn btn-write float-right" onclick="onAction()">적용하기</button>
    </div>                   
</div>


<div class="pop-layer" style="display:none;">            
    <div class="title">
        <h3>메인에 노출할 영상을 직접 선택하세요.</h3>
        <a class="btn-close" href="javascript:layerClose();" aria-label="Close">
            <i class="fa fa-close"></i>
        </a>
    </div>
    <div class="search-wrap">
        <label>
            <input type="search" class="form-control" placeholder="제목, 내용" name="searchKeyword" id="searchKeyword">
            <button type="button" class="btn btn-search" onclick="onSearch();">검색하기</button>
        </label>
    </div>
    <div class="program-list">
        <ul id="layer-list">
            <!--
            <li>
                <p>검색 결과가 없습니다.</p>
            </li>
            <li>
                <a href="">전공탐구생활</a>
            </li>
            <li>
                <a href="">전공탐구생활</a>
            </li>
            -->
        </ul>
        <ul>
            <li>
                <p id="addProgram">
                    <strong>
                        선택 프로그램
                        
                    </strong><br/>
                    <div id="addProgram"></div>
                </p>
            </li>
        </ul>
    </div>
    <div class="btn-wrap">
        <button type="button" class="btn btn-write float-right" onclick="onCustom()">적용하기</button>
    </div>  
</div>
<div class="deemed" style="display: none;"></div>
@stop

        

