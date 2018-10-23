@extends('admin.index.index')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">管理员列表</div>
    <table class="table table-hover table-striped">
        <tr>
            <td></td>
            <td>角色名称</td>
            <td>操作</td>
        </tr>
        @foreach ($roles as $key => $value)
        <tr>
            <td><input type="checkbox" name="" id=""></td>
            <td>{{$value->role_name}}</td>
            <td>
                <a href="{{URL::asset('/admin/roles/show?roleId='.$value->role_id)}}"><button class="btn btn-default btn-sm" title="查看权限"><i class="glyphicon glyphicon-list-alt"></i></button></a>
                <a href="{{URL::asset('/admin/roles/edit?roleId='.$value->role_id)}}"><button class="btn btn-default btn-sm" title="修改权限"><i class="fa fa-edit"></i></button></a>
                <a href="{{URL::asset('/admin/roles/delete?roleId='.$value->role_id)}}"><button class="btn btn-default btn-sm" title="删除"><i class="fa fa-trash-o"></i></button></a>
            </td>
        </tr>
        @endforeach
    </table>
    </div>
@endsection