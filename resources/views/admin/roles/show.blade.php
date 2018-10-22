@extends('admin.index.index')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">角色权限详情·{{$roleHasAccess[0]->role_name}}</div>
    <table class="table table-hover table-striped">
        <tr>
            <td></td>
            <td>角色名称</td>
            <td>角色权限</td>
        </tr>
        @foreach ($roleHasAccess as $key => $value)
        <tr>
            <td><input type="checkbox" name="" id=""></td>
            <td>{{str_repeat('|——',substr_count($value->path,'-'))}}{{$value->menu_name}}</td>
            <td>
                <a href="{{URL::asset('/admin/roles/delete?roleId='.$value->role_id)}}"><button class="btn btn-default btn-sm" title="删除"><i class="fa fa-trash-o"></i></button></a>
            </td>
        </tr>
        @endforeach
    </table>
    </div>
@endsection