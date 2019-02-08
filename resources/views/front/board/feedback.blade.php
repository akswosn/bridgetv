
@extends('layout.front')


@section('content')
<div class="tab">
    <ul class="nav">
        <li>
            <a class="nav-link" href="/board/notice">공지사항</a>
        </li>
        <li>
            <a class="nav-link" href="/board/pairing">편성표</a>
        </li>
        <li>
            <a class="nav-link active show" href="/board/feedback">시청자 의견</a>
        </li>
    </ul>
</div>
 <!-- 시청자의견 시작 -->
 <div class="table-wrap">
    <table width="100%" class="table-row" cellpadding="0" cellspacing="0">
        <colgroup class="pc-colgroup">
            <col width="80px">
            <col width="520px">
        </colgroup>  
        <colgroup class="mb-colgroup">
            <col width="20%">
            <col width="80%"/>   
        </colgroup>     
        <tr>
            <th>이름</th>
            <td>
                <label>
                    <input type="text" class="form-text" placeholder="이름을 입력해주세요.">
                </label>
            </td>
        </tr>
        <tr>
            <th>이메일</th>
            <td>
                <label>
                    <input type="text" class="form-text" placeholder="이메일을 입력해주세요.">
                </label>
            </td>
        </tr>
        <tr>
            <th>휴대전화</th>
            <td>
                <label>
                    <input type="tel" class="form-text" placeholder="휴대전화 번호를 입력해주세요.">
                </label>
            </td>
        </tr>
        <tr>
            <th>문의사항</th>
            <td>
                <label>
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                </label>                            
            </td>
        </tr>
    </table>
</div> 
<div class="privacy-wrap">
    <ul>
        <label>
            <input type="checkbox" class="form-checkbox"> 
            개인정보 수집/이용에 동의합니다.
        </label>
        <p>
            <strong>개인정보보호법 제30조에 따라 서비스 이용을 위한 아래 개인정보 수집.이용 동의를 받습니다.</strong><br/>
            1. 개인정보를 다음의 목적을 위하여 개인정보를 처리하고, 그 목적 이외로는 이용하지 않습니다. 이용자 식별 및 본인여부 확인, 목적 계약 이행을 위한 연락민원 등 고객 고충 처리<br/>
            2. 개인정보 수집항목 : 성명, 이메일, 휴대전화번호<br/>
            3. 개인정보의 처리 및 보유기간 : 게시글 삭제 시 즉시 삭제
        </p>     
    </ul>
                
</div>           
<div class="btn-wrap">
    <ul>
        <li>
            <button type="button" class="btn btn-write float-right">문의하기</button>
        </li>
    </ul>
</div>
<!-- 시청자의견 끝 -->
@stop

        

