@extends('admin.index.index')
@section('content')
<form action="{{URL::asset('admin/roles/edit')}}" method="post">
    <div class="box box-info">
        <div class="box-header with-border"><h3>修改角色权限</h3></div>
        <div class="box-body">
            @csrf
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="role_name">角色名称</label>
                <div class="col-sm-10">
                    <input type="hidden" name="role_id" value="{{$role->role_id}}">
                    <input type="hidden" name="role_name" value="{{$role->role_name}}">
                    <p style="font-size:20px;"><b>{{$role->role_name}}</b></p>
                </div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="menus">分配权限</label>
                <div class="col-sm-10">
                    @foreach ($allAccess as $key => $value)
                        <p>{{str_repeat('|——',substr_count($value->path,'-'))}}
                            <input type="checkbox" name="menus[]" value="{{$value->menu_id}}" {{in_array($value->menu_id,$resourceIds)?'checked':''}}>{{$value->menu_name}}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="保存"></div>
    </div>
    </form>
@endsection
@section('js')
<script>
    
</script>
@endsection