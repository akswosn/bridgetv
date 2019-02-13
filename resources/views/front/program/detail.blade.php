
@extends('layout.front')


@section('content')
<script>

function onPlayLayer(title, movie){

    var html = '<div class="title">'
    html    +='<h3 id="layer_title">'+title+'</h3>'
    html    +='<a class="btn-close" href="" aria-label="Close">'
    html    +='    <i class="fa fa-close"></i>'
    html    +='</a>'
    html    +='</div>'
    html    +='<div class="youtubeWrap">'
    html    +='<iframe id="layer_movie" width="560" height="315" src="'+movie+'" frameborder="0" allowfullscreen></iframe>'
    html    +='</div>';

    $('#program_layer').html('');
    $('#program_layer').html(html);


    $('#program_deemed').show();
    $('#program_layer').show();
}

function offPlayLayer(){
    $('#program_deemed').hide();
    $('#program_layer').hide();
}

</script>

<div class="sorting">
    <ul>
        <li class="left">
            <a href="/program/current/1"><span></span>뒤로</a>
        </li>
    </ul>
</div>
<div class="program-detail">
    <div class="program-detail-wrap">
        <div class="program-info">
            <div class="info-wrap">
                <p>
                    <img src="{{$file->file_path}}/{{$file->file_name}}" alt="">
                </p>
                <h3>{{$program->name}}</h3>
                <ul>
                    <li>
                        <strong>기획의도</strong>
                        <p>{{$program->planning}}</p>
                    </li>
                    <li>
                        <strong>장르</strong>
                        <p>{{$program->genre}}</p>
                    </li>
                    <li>
                        <strong>길이</strong>
                        <p>{{$program->playtime}}</p>
                    </li>
                    <li>
                        <strong>출연진</strong>
                        <p>{{$program->cast}}</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="program-playlist">
            <h4>영상 리스트</h4>
            <ul>
            @forelse($programSection as $section)
                <li>
                    <a href="javascript:onPlayLayer('{{ $section->title}}','{{ $section->movie_link}}')">
                        <div class="playlist">
                            <ul>
                                <li>
                                    <img src="{{$file->file_path}}/{{$file->file_name}}">
                                </li>
                                <li>
                                    <span>{{ $section->section}}회.</span>
                                    {{ $section->title}}
                                </li>
                            </ul>                                            
                        </div>
                    </a>
                </li>
            @empty
                <li>영상이 등록되지 않았습니다.</li>
            @endforelse
                <!--
                <li>
                    <a href="">
                        <div class="playlist">
                            <ul>
                                <li>
                                    <img src="{{$file->file_path}}/{{$file->file_name}}">
                                </li>
                                <li>
                                    <span>2회.</span>
                                    정유익의 유익한 장비전
                                </li>
                            </ul>                                            
                        </div>
                    </a>
                </li>
                -->
            </ul>
        </div>
    </div>                
</div>


<div id="program_layer" class="pop-layer" style="display:none;">            
    
</div>
<div id="program_deemed" class="deemed" style="display: none;"></div>
@stop

        

