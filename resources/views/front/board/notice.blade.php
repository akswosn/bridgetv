
@extends('layout.front')


@section('content')
<div class="tab">
    <ul class="nav">
        <li>
            <a class="nav-link active show" href="/board/notice">공지사항</a>
        </li>
        <li>
            <a class="nav-link" href="/board/pairing">편성표</a>
        </li>
        <li>
            <a class="nav-link" href="/board/feedback">시청자 의견</a>
        </li>
    </ul>
</div>

<!-- 공지사항 리스트 시작 -->
<div class="table-wrap">
    <table width="100%" class="table" cellpadding="0" cellspacing="0">
        <colgroup class="pc-colgroup">
            <col width="55px">
            <col width="370px"/>                        
            <col width="100px">
            <col width="75px">
        </colgroup>   
        <colgroup class="mb-colgroup">
            <col width="15%">
            <col width="45%"/>                        
            <col width="25%">
            <col width="15%">
        </colgroup>                      
        <thead>
            <tr>
                <th>분류</th>
                <th>제목</th>
                <th>작성일</th>
                <th>조회수</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>공지</td>
                <td><a href="">전공탐구생활</a></td>
                <td>2019-01-01</td>
                <td>868</td>
            </tr>
            <tr>
                <td>공지</td>
                <td><a href="">전공탐구생활</a></td>
                <td>2019-01-01</td>
                <td>868</td>
            </tr>
            <tr>
                <td>공지</td>
                <td><a href="">전공탐구생활</a></td>
                <td>2019-01-01</td>
                <td>868</td>
            </tr>
        </tbody>
    </table>
</div>
<nav class="page-wrap">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="" aria-label="Previous">
                <i class="fa fa-angle-left"></i>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="">1</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="">2</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="">3</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="" aria-label="Next">
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- 공지사항 리스트 끝 -->
@stop

        

