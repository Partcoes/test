@extends('admin.index.index')
@section('content_header')
    <div class="box box-primary">
    <div class="box-header with-border">管理员列表</div>
    <div class="mailbox-controls">
        <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
        <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
    </div>
    <table class="table table-hover table-striped">
        <tr align="center">
            <td></td>
            <td>管理员名称</td>
            <td>管理员邮箱</td>
            <td>管理员手机</td>
            <td>是否是超级管理员</td>
            <td>是否冻结</td>
            <td>最后登录时间</td>
            <td>操作</td>
        </tr>
        @foreach ($managerList as $key => $value)
        <tr align="center">
            <td><input type="checkbox" name="" id=""></td>
            <td>{{$value->manager_name}}</td>
            <td>{{$value->manager_email}}</td>
            <td>{{$value->manager_mobile?:'此管理员手机号吗未知'}}</td>
            <td><span>{{$value->is_super?'是':'否'}}</span></td>
            <td><button class="btn">{{$value->is_freeze?'已冻结':'可使用'}}</button></td>
            <td>{{date('Y-m-d H:i:s',$value->last_login_time)}}</td>
            <td></td>
        </tr>
        @endforeach
    </table>
    </div>
@endsection