
@extends('layout.front')


@section('content')
<div class="tab">
    <ul class="nav">
        <li>
            <a class="nav-link active show" href="/program/current">방영 프로그램</a>
        </li>
        <li>
            <a class="nav-link" href="/program/end">종영 프로그램</a>
        </li>
        <li>
            <a class="nav-link" href="/program/all">전체 프로그램</a>
        </li>
    </ul>
</div>
<div class="sorting">
    <ul>
        <li class="right">
            <a href="">가나다순</a>
        </li>
        <li class="right">
                <a href="" class="active">최신순</a>
        </li>
    </ul>
</div>
<section id="program" class="program-list">
    <div class="program-wrap">
        <ul>
            <li>
                <a href="/program/detail/1">
                    <img src="/images/program.jpg">
                    <p>이미쉘의 I CAN SING 2회</p>
                </a>
            </li>
            <li>
                <a href="/program/detail/1">
                    <img src="/images/program.jpg">
                    <p>이미쉘의 I CAN SING 2회</p>
                </a>
            </li>
            <li>
                <a href="/program/detail/1">
                    <img src="/images/program.jpg">
                    <p>이미쉘의 I CAN SING 2회</p>
                </a>
            </li>
            <li>
                <a href="/program/detail/1">
                    <img src="/images/program.jpg">
                    <p>이미쉘의 I CAN SING 2회</p>
                </a>
            </li>
        </ul>
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
</section>
@stop

        

