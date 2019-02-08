<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>BridgeTV</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1">
    <!--CSS-->
    <link rel="stylesheet" href="/assets/css/reset.css">
    <link rel="stylesheet" href="/css/admin.css">
    <!--JS-->
    <!-- jQuery library -->
    <script src="/js/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="/js/bootstrap.min.js"></script>
</head>
@include('admin.common.fileUpload')
<body class="login-body">
{!! $errors->first('message','<div class="message_box error"><span>:message</span></div>') !!}
    <div id="login-wrap">
        <h1 class="logo"></h1>
        <h2>관리자 로그인</h2>
        <div class="login-content">
            <form class="signin"  action="/_admin/login" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="text" class="form-control" id="userid" name="userid">
                    <label for="login-username">아이디</label>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password">
                    <label for="login-password">비밀번호</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-login">로그인하기</button>
                </div>
            </form>
           
        </div>
        <footer class="login-footer">
            Copyright ⓒ 2019 BridgeTV.<br/>All Rights Reserved.
        </footer>
    </div>
</body>
</html>