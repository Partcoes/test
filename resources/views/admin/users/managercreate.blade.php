@extends('admin.index.index')
@section('content')
    <form action="{{URL::asset('admin/users')}}" method="post">
    <div class="box box-info">
        <div class="box-header with-border"><h3>管理员信息</h3></div>
        <div class="box-body">
            @csrf
            <input type="hidden" name="manager_id" value="{{isset($default->manager_id)?$default->manager_id:''}}"  {{isset($default->manager_id)?'':'disabled'}}>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="manager_name">管理员名称</label>
                <div class="col-sm-10"><input class="form-control" type="text" name="manager_name" id="manager_name" placeholder="管理员姓名" value="{{isset($default->manager_name)?$default->manager_name:''}}"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="manager_pwd">设置密码</label>
                <div class="col-sm-10"><input class="form-control" type="password" name="manager_pwd" id="manager_pwd" placeholder="设置密码"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="manager_email">管理员邮箱</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="manager_email" id="manager_email" placeholder="管理员邮箱" value="{{isset($default->manager_email)?$default->manager_email:''}}">
                </div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="manager_mobile">管理员手机</label>
                <div class="col-sm-10"><input class="form-control" type="text" name="manager_mobile" id="manager_mobile" placeholder="管理员手机" value="{{isset($default->manager_mobile)?$default->manager_mobile:''}}"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="is_super">分配角色</label>
                <div class="col-sm-10">
                    <select name="role" id="role" class="form-control">
                        <option value="">请选择</option>
                        @foreach ($roles as $key => $item)
                            <option value="{{$item->role_id}}" {{isset($default->roles[0]->role_id)&&$default->roles[0]->role_id==$item->role_id?'selected':''}}>{{$item->role_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="保存"></div>
    </div>
    </form>
@endsection