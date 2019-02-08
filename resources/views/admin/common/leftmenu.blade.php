
    <ul>
        <li class="title">메인페이지 디자인</li>
        <li><a href="/_admin/banner" class="{{strpos(url()->current(), 'banner') != false ? 'on' : ''}}" >- 메인 배너</a></li>
        <li><a href="/_admin/program/config"  class="{{strpos(url()->current(), '/program/config') != false ? 'on' : ''}}">- 프로그램 노출</a></li>
    </ul>
    <ul>
        <li class="title">프로그램 등록/수정</li>
        <li><a href="/_admin/program/list"  class="{{strpos(url()->current(), '/program/list') != false ? 'on' : ''}}">- 프로그램 리스트</a></li>
        <li><a href="/_admin/program/regist"  class="{{strpos(url()->current(), '/program/regist') != false ? 'on' : ''}}">- 프로그램 등록</a></li>
    </ul>
    <ul>
        <li class="title">게시판</li>
        <li><a href="/_admin/notice"  class="{{strpos(url()->current(), 'notice') != false ? 'on' : ''}}">- 공지사항</a></li>
        <li><a href="/_admin/pairing"  class="{{strpos(url()->current(), 'pairing') != false ? 'on' : ''}}">- 편성표</a></li>
        <li><a href="/_admin/feedback"  class="{{strpos(url()->current(), 'feedback') != false ? 'on' : ''}}">- 시청자 의견</a></li>
    </ul>
    <ul>
        <li class="title">관리자 설정</li>
        <li><a href="/_admin/account"  class="{{strpos(url()->current(), 'account') != false ? 'on' : ''}}">- 계정 관리</a></li>
    </ul>
    <ul>
        <li class="footer">
            Copyright ⓒ 2019 아이캔피알.<br/>All Rights Reserved.
        </li>
    </ul>
