
@extends('layout.front')


@section('content')
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
                    <img src="/images/program.jpg" alt="">
                </p>
                <h3>화요 콘서트 시즌2</h3>
                <ul>
                    <li>
                        <strong>기획의도</strong>
                        <p>학생들이 작사 작곡 연주 노래까지 모든 부분에 참여하여 만들어내는 올라운드 뮤직 프로그램</p>
                    </li>
                    <li>
                        <strong>장르</strong>
                        <p>음악</p>
                    </li>
                    <li>
                        <strong>길이</strong>
                        <p>30분</p>
                    </li>
                    <li>
                        <strong>출연진</strong>
                        <p>동아방송예술대학교 실용음악과 학생들</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="program-playlist">
            <h4>영상 리스트</h4>
            <ul>
                <li>
                    <a href="">
                        <div class="playlist">
                            <ul>
                                <li>
                                    <img src="/images/program.jpg">
                                </li>
                                <li>
                                    <span>1회.</span>
                                    정유익의 유익한 장비전
                                </li>
                            </ul>                                            
                        </div>
                    </a>
                </li>
                <li>
                    <a href="">
                        <div class="playlist">
                            <ul>
                                <li>
                                    <img src="/images/program.jpg">
                                </li>
                                <li>
                                    <span>2회.</span>
                                    정유익의 유익한 장비전
                                </li>
                            </ul>                                            
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>                
</div>

<!--
<div class="pop-layer">            
    <div class="title">
        <h3>화요콘서트 시즌2 1화</h3>
        <a class="btn-close" href="" aria-label="Close">
            <i class="fa fa-close"></i>
        </a>
    </div>
    <div class="youtubeWrap">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/D4Z2nEdzkdc" frameborder="0" allowfullscreen></iframe>
    </div>
</div>
-->
@stop

        

