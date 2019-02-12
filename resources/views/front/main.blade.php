
@extends('layout.front')


@section('content')
<!--
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA83MlliXCs_2B_zQOt_1aBDK4EiXEq4JQ&callback=initMap" async defer></script>
-->
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=f0f958a746873e01ef3eb1f26d4da648"></script>
<script>
//AIzaSyA83MlliXCs_2B_zQOt_1aBDK4EiXEq4JQ = goog
var map1;
var map2;
function initMap() {
    var con1 =  document.getElementById('map1');
    var con2 =  document.getElementById('map2');
    var markerPosition1  = new daum.maps.LatLng(37.551930, 126.917985); 
    var markerPosition2  = new daum.maps.LatLng(37.059839, 127.356765); 
    var options1 = { //지도를 생성할 때 필요한 기본 옵션
        center: markerPosition1, //지도의 중심좌표.
        level: 3 //지도의 레벨(확대, 축소 정도)
    };
    var options2 = { //지도를 생성할 때 필요한 기본 옵션
        center: markerPosition2, //지도의 중심좌표.
        level: 3 //지도의 레벨(확대, 축소 정도)
    };
    var map1 = new daum.maps.Map(con1, options1); //지도 생성 및 객체 리턴
    var map2 = new daum.maps.Map(con2, options2); //지도 생성 및 객체 리턴

    

    // 마커를 생성합니다
    var marker1 = new daum.maps.Marker({
        position: markerPosition1
    });
    var marker2 = new daum.maps.Marker({
        position: markerPosition2
    });

    // 마커가 지도 위에 표시되도록 설정합니다
    marker1.setMap(map1);
    marker2.setMap(map2);

    // map1 = new google.maps.Map(document.getElementById('map1'), {
    //     center: {lat: 37.551930, lng: 126.917985},
    //     zoom: 18
    // });
    // map2 = new google.maps.Map(document.getElementById('map2'), {
    //     center: {lat: 37.059839, lng: 127.356765},
    //     zoom: 15
    // });

    // var marker = new google.maps.Marker({
    //     position: {lat: 37.551930, lng: 126.917985},
    //     map: map1,
       
    // });

    // var marker = new google.maps.Marker({
    //     position: {lat: 37.059839, lng: 127.356765},
    //     map: map2,
       
    // });
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
<section id="vision" class="vision">
    <h2>vision</h2>
    <p>
        연결에서 개척으로, Find New Contents! <strong>브릿지TV!</strong><br/>
        <span>브릿지TV가 새로운 모습으로 찾아갑니다!</span>
    </p>
</section>
<section id="channel" class="channel">
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
<section id="advertising" class="partner">
    <div>
        BRIDGE TV는 <span>여러분의 광고, 제작지원, 제작협찬 제안을 기다립니다.</span><br/>
        <strong>청년문화를 이끌어나가는 브릿지TV의 든든한 파트너가 되어주세요.</strong>
        <p>
            <span>광고문의 :</span> hy2dahaha@hanmail.net 02-337-0061
        </p>                    
    </div>
</section>
<section id="program" class="program">
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
<section id="contact" class="contact">
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
<section id="board" class="board">
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

    initMap();
</script>
@stop

        

