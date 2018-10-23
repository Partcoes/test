@extends('admin.index.index')
@section('content')
<form action="{{URL::asset('admin/menus')}}" method="post">
    <div class="box box-primary">
        <div class="box-header with-border"><h3>添加菜单</h3></div>
        <div class="box-body">
            @csrf
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="menu_name">菜单名称</label>
                <div class="col-sm-10"><input class="form-control" type="text" name="menu_name" id="menu_name" placeholder="菜单名称" value="{{isset($default->menu_name)?$default->menu_name:''}}"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="menu_uri">菜单uri</label>
                <div class="col-sm-10"><input class="form-control" type="text" name="menu_uri" id="menu_uri" placeholder="菜单uri" value="{{isset($default->menu_uri)?$default->menu_uri:''}}"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="menu_uri">是否是菜单</label>
                <div class="col-sm-10">
                    <div class="col-sm-5"><input type="radio" name="is_menu" id="" value="1" {{isset($default->is_menu)&&$default?'checked':''}}>是</div>
                    <div class="col-sm-5"><input type="radio" name="is_menu" id="" value="0" {{isset($default->is_menu)&&$default?'checked':''}}>否</div>
                </div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="parent_id">上级菜单</label>
                <div class="col-sm-7">
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="0">请选择上级菜单</option>
                        @foreach ($menus as $key => $value)
                            <option value="{{$value->menu_id}}" {{isset($default->parent_id)&&$default->parent_id==$value->menu_id?'selected':''}}>{{str_repeat('|——',substr_count($value->path,'-'))}}{{$value->menu_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <span style="color:red;">*请选择上级菜单，不选择为最高级</span>
                </div>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="保存"></div>
    </div>
    </form>
@endsection