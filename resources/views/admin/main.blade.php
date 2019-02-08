
@extends('layout.admin')


@section('content')
<div class="content">
    <div class="login-wrap">
        <h3 class="login-title">
            {{session('user')->name}}님!<br/>
            브릿지 TV 홈페이지 관리 시스템에<br/>
            오신 것을 환영합니다.
        </h3>
        <p class="login-time"><span>최근 로그인 :</span> {{session('user')->logindate =='' ? '최초로그인':session('user')->logindate}}</p>
    </div>  
</div>
@stop

        

