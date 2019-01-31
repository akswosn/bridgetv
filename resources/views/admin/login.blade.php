<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BridgeTV</title>
    </head>
    <body>
       로그인페이지
      
       <form action="/_admin/login" method="post">
       {!! csrf_field() !!}
        <input type="text" id="userid" name="userid" value=""/> admin <br/>
        <input type="password" id="password" name="password" value=""/> 1234
        <input type="submit" value="전송"/>
       </form>

        <br/>
       {!! $errors->first('msg','<div class="form_error_box"><span>:message</span></div>') !!}
    </body>
</html>
