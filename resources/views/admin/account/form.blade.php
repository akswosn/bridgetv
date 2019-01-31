관리자 아이디 추가

<form id="regFrm" name="regFrm" method="post" action="/_admin/account/reg">
    {!! csrf_field() !!}
    구분 : 일반<input type="radio" name="type" value="0" checked/> 마스터<input type="radio" name="type" value="1"/><br/>
    아이디 : <input type="text" name="userid" value=""/><br/>
    이름 : <input type="text" name="name"/><br/>
    비밀번호 : <input type="password" name="password"/><br/>
    비밀번호 확인 : <input type="password" name="password_confirm"/><br/>
    <input type="submit" class="btn btn-primary" value="등록"/>
</form>