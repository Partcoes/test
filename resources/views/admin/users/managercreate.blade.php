@extends('admin.index.index')
@section('content_header')
    <form action="{{URL::asset('admin/users')}}" method="post">
    <div class="box box-primary">
        <div class="box-header with-border"><h3>添加管理员</h3></div>
        <div class="box-body">
            @csrf
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="manager_name">管理员名称</label>
                <div class="col-sm-10"><input class="form-control" type="text" name="manager_name" id="manager_name" placeholder="管理员姓名"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="manager_pwd">设置密码</label>
                <div class="col-sm-10"><input class="form-control" type="password" name="manager_pwd" id="manager_pwd" placeholder="设置密码"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="manager_email">管理员邮箱</label>
                <div class="col-sm-10"><input class="form-control" type="text" name="manager_email" id="manager_email" placeholder="管理员邮箱"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="manager_mobile">管理员手机</label>
                <div class="col-sm-10"><input class="form-control" type="text" name="manager_mobile" id="manager_mobile" placeholder="管理员手机"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="is_super">是否是超级管理员</label>
                <div class="col-sm-10">
                    <div class="col-sm-5"><input type="radio" name="is_super" value="1">是</div>
                    <div class="col-sm-5"><input type="radio" name="is_super" value="0">否</div>
                </div>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="添加"></div>
    </div>
    </form>
@endsection