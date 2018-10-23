@extends('admin.index.index')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">角色权限详情·{{$roleHasAccess[0]->role_name}}</div>
    <table class="table table-hover table-striped">
        <tr>
            <td>角色名称</td>
        </tr>
        @foreach ($roleHasAccess as $key => $value)
        <tr>
            <td>{{str_repeat('|——',substr_count($value->path,'-'))}}{{$value->menu_name}}</td>
        </tr>
        @endforeach
    </table>
    </div>
@endsection