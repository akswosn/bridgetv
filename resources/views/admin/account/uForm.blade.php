관리자 아이디 수정

<form id="regFrm" name="regFrm" method="post" action="/_admin/account/update/{{$account->id}}">
    {!! csrf_field() !!}
    <input type="hidden" id="id" name="name" value="{{$account->id}}"/>
    구분 : 일반<input type="radio" name="type" value="0" {{$account->type == 0 ? 'checked' : ''}}/> 
    마스터<input type="radio" name="type" value="1"  {{$account->type == 1 ? 'checked' : ''}}/><br/>
    아이디 : <input type="text" name="userid" value="{{$account->userid}}"/><br/>
    이름 : <input type="text" name="name" value="{{$account->name}}"/><br/>
    이전 비밀번호 : <input type="password" name="password_pre"/><br/>
    {!! $errors->first('msg','<div class="form_error_box"><span>:message</span></div>') !!}
    비밀번호 : <input type="password" name="password"/><br/>
    비밀번호 확인 : <input type="password" name="password_confirm"/><br/>
    <input type="submit" class="btn btn-primary" value="수정"/>
</form>