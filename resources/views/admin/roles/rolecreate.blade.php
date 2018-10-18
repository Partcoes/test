@extends('admin.index.index')
@section('content')
<form action="{{URL::asset('admin/roles')}}" method="post">
    <div class="box box-primary">
        <div class="box-header with-border"><h3>添加角色</h3></div>
        <div class="box-body">
            @csrf
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="role_name">角色名称</label>
                <div class="col-sm-10"><input class="form-control" type="text" name="role_name" id="role_name" placeholder="角色名称"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="menus">分配权限</label>
                <div class="col-sm-10">
                    @foreach ($menus as $key => $value)
                        <h3><input type="checkbox" name="" id="">{{$value->menu_name}}</h3>
                        <p>
                            @foreach ($value->son as $k => $item)
                            <span><input type="checkbox" name="" id="">{{$item->menu_name}}</span>
                            @endforeach
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="添加"></div>
    </div>
    </form>
@endsection