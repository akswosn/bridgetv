<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1.0, user-scalable=yes">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--CSS-->
    <link rel="stylesheet" href="/assets/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/swiper.min.css">
    <!--JS-->
    <script src="/js/swiper.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.easing.1.3.js"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
    .anchor  {
        display: block;
        height: 60px; /*same height as header*/
        margin-top: -60px; /*same height as header*/
        visibility: hidden;
    }
    .anchor2{
        display: block;
        height: 20px; /*same height as header*/
        margin-top: -20px; /*same height as header*/
        visibility: hidden;
    }
    </style>
    <!-- Styles -->
    <script>
        $(function(){
            if($('.message_box')){
                $('.message_box').click(function(){
                    $('.message_box').fadeOut('slow');
                })
            }
        })
    </script>
</head>
<body>
{!! $errors->first('message','<div class="message_box error"><span>:message</span></div>') !!}
@if(session('success'))
<div class="message_box success"><span>{{ session('success') }}</span></div>
@endif
    <div id="wrapper">
        @include('front.common.leftmenu')

        <div id="container">
            @yield('content')

            <footer>
                <p>
                    대표이사 : 김상교  개인정보관리 책임자 : 이인철  사업자등록번호 : 125-82-07273<br/>  
                    본사 : 경기도 안성시 삼죽면 동아예대길 47 동아방송예술대학교 기예관 방송예술창작센터<br/>
                    서울사무소 : 서울시 마포구 양화로 7길 47 상훈빌딩 2층 고객만족실 (편성 문의 및 시청자 의견) : 02-337-0061<br/>
                    Copyright (C) BRIDGE TV All Rights Reserved.
                </p>    
            </footer>
        </div>
        <div class="deemed"></div>
    </div>

</body>
</html>