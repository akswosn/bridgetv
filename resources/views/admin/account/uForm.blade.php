@extends('layout.admin')


@section('content')
<script>
function onAction(){
    $('#regFrm').submit();
}   
</script>

<form id="regFrm" name="regFrm" method="post" action="/_admin/account/update/{{$account->id}}">
    {!! csrf_field() !!}
<div class="content">
    <h2>관리자 아이디 수정</h2>
    <div class="table-wrap">
        <table width="100%" class="table-row" cellpadding="0" cellspacing="0">
            <colgroup>
                <col width="120px">
                <col width="480px">
            </colgroup>    
            <tr>
                <th>구분</th>
                <td>
                    <label>
                        <input type="radio" name="type" value="0" class="form-radio" {{ $account->type =='0'? 'checked' : '' }}> 일반
                    </label>
                    <label>
                        <input type="radio" name="type" value="1" class="form-radio" {{ $account->type =='1'? 'checked' : '' }}> 마스터
                    </label>
                    {!! $errors->first('type', '<br/><span class="form-error">:message</span>') !!}
                </td>
            </tr>
            <tr>
                <th>아이디</th>
                <td>
                    <label>
                        <input type="text" id="userid" name="userid" class="form-text" placeholder="아이디를 입력해주세요." value="{{ $account->userid}}">
                    </label>
                    {!! $errors->first('userid', '<br/><span class="form-error">:message</span>') !!}
                </td>
            </tr>
            <tr>
                <th>이름</th>
                <td>
                    <label>
                        <input type="text" id="name" name="name" class="form-text" placeholder="이름을 입력해주세요." value="{{ $account->name }}">
                    </label>
                    {!! $errors->first('name', '<br/><span class="form-error">:message</span>') !!}
                </td>
            </tr>
            <tr>
                <th>이전 비밀번호</th>
                <td>
                    <label>
                        <input type="password" name="password_pre" id="password_pre" class="form-text" placeholder="">
                    </label>
                    {!! $errors->first('password_pre', '<br/><span class="form-error">:message</span>') !!}
                </td>
            </tr>
            <tr>
                <th>새 비밀번호</th>
                <td>
                    <label>
                        <input type="password" name="password" id="password" class="form-text" placeholder="">
                    </label>
                    {!! $errors->first('password', '<br/><span class="form-error">:message</span>') !!}
                </td>
            </tr>
            <tr>
                <th>새 비밀번호 확인</th>
                <td>
                    <label>
                        <input type="password" name="password_confirm" id="password_confirm" class="form-text" placeholder="">
                    </label>
                    {!! $errors->first('password_confirm', '<br/><span class="form-error">:message</span>') !!}
                </td>
            </tr>
        </table>
    </div>
    <div class="btn-wrap">
            <button type="button" class="btn btn-write float-right" onclick="onAction()">관리자 아이디 수정하기</button>
    </div>
</div>
</form>
@stop

