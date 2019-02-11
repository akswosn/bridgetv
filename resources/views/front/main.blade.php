
@extends('layout.front')


@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA83MlliXCs_2B_zQOt_1aBDK4EiXEq4JQ&callback=initMap" async defer></script>
<script>

//AIzaSyA83MlliXCs_2B_zQOt_1aBDK4EiXEq4JQ
var map1;
var map2;
function initMap() {
    map1 = new google.maps.Map(document.getElementById('map1'), {
        center: {lat: 37.551930, lng: 126.917985},
        zoom: 18
    });
    map2 = new google.maps.Map(document.getElementById('map2'), {
        center: {lat: 37.059839, lng: 127.356765},
        zoom: 15
    });

    var marker = new google.maps.Marker({
        position: {lat: 37.551930, lng: 126.917985},
        map: map1,
       
    });

    var marker = new google.maps.Marker({
        position: {lat: 37.059839, lng: 127.356765},
        map: map2,
       
    });
}
</script>
<section class="main">
    <!-- Swiper -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <!--
            <div class="swiper-slide">WE ARE YOUNG!</div>
            <div class="swiper-slide">WE ARE YOUNG!</div>
            -->
            @forelse($banners as $index => $item)
                <div class="swiper-slide">
                    <img style="height:470px" src="{{$banners_files[$item->id]->file_path}}/{{$banners_files[$item->id]->file_name}}" />
                </div>
            @empty
                <div class="swiper-slide">등록된 배너가 존재하지 않습니다.</div>
            @endforelse  
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</section>
<span class="anchor" id="vision" ></span>
<section class="vision" >
    <h2>vision</h2>
    <p>
        연결에서 개척으로, Find New Contents! <strong>브릿지TV!</strong><br/>
        <span>브릿지TV가 새로운 모습으로 찾아갑니다!</span>
    </p>
</section>
<span class="anchor2" id="channel"></span>
<section  class="channel"  >
    <h2>Channel</h2>
    <div class="channel-list-01">
        <ul>
            <li>
                <p><img src="../images/channel_01.jpg" alt="ollehtv"></p>
                <p class="ch"><span>Ch.</span>270</p>
            </li>
            <li>
                <p><img src="../images/channel_02.jpg" alt="Btv"></p>
                <p class="ch"><span>Ch.</span>284</p>
            </li>
            <li>
                <p><img src="../images/channel_03.jpg" alt="DLIVE"></p>
                <p class="ch"><span>Ch.</span>158</p>
            </li>
            <li>
                <p><img src="../images/channel_04.jpg" alt="t-broad"></p>
                <p class="ch"><span>Ch.</span>204</p>
            </li>
            <li>
                <p><img src="../images/channel_05.jpg" alt="HYUNDAI HCN"></p>
                <p class="ch"><span>Ch.</span>356</p>
            </li>
        </ul>
    </div>
    <div class="channel-list-02">
        <ul>
            <li>
                <p><img src="../images/channel2_01.jpg" alt="YOUTUBE"></p>
            </li>
            <li>
                <p><img src="../images/channel2_02.jpg" alt="naver TV"></p>
            </li>
            <li>
                <p><img src="../images/channel2_03.jpg" alt="facebook"></p>
            </li>
            <li>
                <p><img src="../images/channel2_04.jpg" alt="Instagram"></p>
            </li>
        </ul>
    </div>
</section>
<span class="anchor" id="advertising" ></span>
<section class="partner">
    <div>
        BRIDGE TV는 <span>여러분의 광고, 제작지원, 제작협찬 제안을 기다립니다.</span><br/>
        <strong>청년문화를 이끌어나가는 브릿지TV의 든든한 파트너가 되어주세요.</strong>
        <p>
            <span>광고문의 :</span> hy2dahaha@hanmail.net 02-337-0061
        </p>                    
    </div>
</section>
<span class="anchor" id="program"></span>
<section  class="program">
    <h2>Program</h2>
    <div class="program-wrap">
        <ul>
        @forelse($programs as $index => $item)
            <li>
                <a href="/program/detail/{{$item->id}}">
                    <img src="{{$programs_files[$item->id]->file_path}}/{{$programs_files[$item->id]->file_name}}">
                    <p>{{$item->name}}</p>
                </a>
            </li>
        @empty
            <li> 등록된 프로그램이 존재하지 않습니다. </li>
        @endforelse 
           
        </ul>
    </div>
    <div class="btn-wrap">
        <a href="/program/current/1">더보기 +</a>
    </div>
</section>
<span class="anchor" id="contact"></span>
<section  class="contact">
    <h2>Contact</h2>
    <ul>
        <li>
            <div class="map" id="map1">
                
            </div>
            <div>
                <h3>서울사무소</h3>
                <h4>서울시 마포구 양화로 12길 33 (서교동 373-6) 4층<br/>(04043)</h4>
                <p><span class="tel">TEL</span>02-337-0061 <span class="fax">FAX</span> 02-337-0067</p>
            </div>
        </li>
        <li>
            <div class="map" id="map2">
                
            </div>
            <div>
                <h3>안성사무실</h3>
                <h4>경기도 안성시 삼죽면 동아예대길 47 동아방송예술대학교 기예관 방송예술창작센터<br/>(17516)</h4>
                <p><span class="tel">TEL</span>031-670-6961 <span class="fax">FAX</span> 031-670-6926</p>
            </div>
        </li>
    </ul>
</section>
<span class="anchor" id="board"></span>
<section  class="board">
    <div class="board-wrap">
        <ul>
            <li>
                <div>                            
                    <p>
                        공지사항
                        @if(!empty($notice))
                        <a href="/board/notice/detail/{{$notice->id}}">{{$notice->title}} </a>    
                        @else 
                            등록된 공지사항이 존재하지 않습니다.
                        @endif
                    </p>
                    <a href="/board/notice">더보기 +</a>
                </div>
                
            </li>
            <li>
                <div>
                    편성표
                    <a href="/board/pairing">더보기 +</a>
                </div>
            </li>
            <li>
                <div>
                    시청자 의견
                    <a href="/board/feedback">의견 남기기 +</a>
                </div>
            </li>
        </ul>
    </div>                
</section>


<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: {
        el: '.swiper-pagination',
        },
    });

    $('.js-header-menu').click(function(){
        if ($('#wrapper').hasClass('change')){
            $('#wrapper').removeClass('change');
        } else {
            $('#wrapper').addClass('change');
        }
    });
</script>
@stop

        

