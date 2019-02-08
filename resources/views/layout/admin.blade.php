<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    
    <!--CSS-->
    <link rel="stylesheet" href="/assets/css/reset.css">
    <link rel="stylesheet" href="/css/admin.css">

    <!-- jQuery library -->
    <script src="/js/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="/js/bootstrap.min.js"></script>
    <!-- SmartEditor를 사용하기 위해서 다음 js파일을 추가 (경로 확인) -->
    <script type="text/javascript" src="/SE2/js/service/HuskyEZCreator.js" charset="utf-8"></script>

</head>
<body>
{!! $errors->first('message','<div class="message_box error"><span>:message</span></div>') !!}
@if(session('success'))
<div class="message_box success"><span>{{ session('success') }}</span></div>
@endif
@include('admin.common.fileUpload')
<div id="wrapper">
    <div id="header">
        <ul>
            <li class="left" onclick="window.location.href='/_admin/';" style="cursor:pointer;">           
                    <p>홈페이지 관리 시스템 <span></span></p>
            </li>
            <li class="right">
                <a href="/_admin/logout" class="logout">logout</a>
            </li>
        </ul>
    </div>

    <div id="menu">
        @include('admin.common.leftmenu')
    </div>

    <div id="container">
        @yield('content')
    <div>
</div>


</body>
</html>