
@extends('layout.admin')


@section('content')
<div class="content">
    <h2>프로그램 노출</h2>
    <div class="table-wrap">
    <form id="regFrm" name="regFrm" method="post" action="/_admin/program/config">
        {!! csrf_field() !!}
        <input type="hidden" id="id" name="id" value="{{$config->id}}"/>
        <table width="100%" class="table-row" cellpadding="0" cellspacing="0">
            <colgroup>
                <col width="120px">
                <col width="480px">
            </colgroup>    
            <tr>
                <th rowspan="3">노출순서</th>
                <td>
                    <label>
                        <input type="radio" name="type" value="orderby" class="form-radio" {{empty($type) || $type =='orderby' ? 'checked':''}}> 최신 등록 순
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        <input type="radio" name="type" value="hit" class="form-radio" {{ $type =='hit' ? 'checked':''}}> 조회수 순
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        <input type="radio" name="type" value="custom" class="form-radio" {{ $type =='custom' ? 'checked':''}}> 직접 지정
                    </label>
                    <div class="program-wrap">
                        <ul>
                        @forelse($program as $item)
                            <li>
                                <a href="#"><img src="{{$file[$item->id]->file_path.'/'.$file[$item->id]->file_name}}"></a>
                                <p>{{$item->name}}</p>
                            </li>
                        @empty
                            <li style="width:100%;">
                                <p title="등록된 프로그램이 존재하지 않습니다.">등록된 프로그램이 존재하지 않습니다.</p>
                            </li>
                         @endforelse
                        <!--
                            <li>
                                <a href=""><img src="/images/program.jpg"></a>
                                <p>이미쉘의 I CAN SING 2회</p>
                            </li>
                            <li>
                                <a href=""><img src="/images/program.jpg"></a>
                                <p>이미쉘의 I CAN SING 2회</p>
                            </li>
                            <li>
                                <a href=""><img src="/images/program.jpg"></a>
                                <p>이미쉘의 I CAN SING 2회</p>
                            </li>
                            <li>
                                <a href=""><img src="/images/program.jpg"></a>
                                <p>전공탐구생활 4회</p>
                            </li>-->
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
        </form>
    </div>
    <div class="btn-wrap">
        <button type="button" class="btn btn-write float-right">적용하기</button>
    </div>                   
</div>
@stop

        

