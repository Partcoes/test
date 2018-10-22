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
                <button class="btn btn-default btn-sm" title="删除"><i class="fa fa-trash-o"></i></button>
                <button class="btn btn-default btn-sm" title="编辑"><i class="fa fa-edit"></i></button>
            </td>
        </tr>
        @endforeach
    </table>
    </div>
@endsection