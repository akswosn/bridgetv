
@extends('layout.front')


@section('content')
<div class="tab">
    <ul class="nav">
        <li>
            <a class="nav-link" href="/program/current/1">방영 프로그램</a>
        </li>
        <li>
            <a class="nav-link active show" href="/program/end/1">종영 프로그램</a>
        </li>
        <li>
            <a class="nav-link" href="/program/all/1">전체 프로그램</a>
        </li>
    </ul>
</div>
<div class="sorting">
    <ul>
        <li class="right">
            <a href="/program/end/2" {{$order==2 ? 'class=active' : ''}}>가나다순</a>
        </li>
        <li class="right">
            <a href="/program/end/1" {{$order==1 ? 'class=active' : ''}}>최신순</a>
        </li>
    </ul>
</div>
<section id="program" class="program-list">
    <div class="program-wrap">
        <ul>
        @forelse($program as $item)
            
            <li>
                <a href="/program/detail/{{$item->id}}">
                    <img src="{{$files[$item->id]->file_path}}/{{$files[$item->id]->file_name}}">
                    <p>{{$item->name}}</p>
                </a>
            </li>
        
        @empty
        <li>데이터가 존재하지 않습니다. </li>
        @endforelse  
        </ul>
    </div>
    @include('admin.common.page')
</section>
@stop

        

