
@extends('layout.admin')


@section('content')
<div>
    관리자 메인<br/>


    브릿지 TV 홈페이지 관리 시스템에
    오신 것을 환영합니다.
    <br/>
    최근 로그인 : {{session('user')->logindate =='' ? '최초로그인':session('user')->logindate}}
</div>
@stop

        

