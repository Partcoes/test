@extends('admin.index.index')
@section('content')
<form action="{{URL::asset('admin/types')}}" method="post">
    <div class="box box-info">
        <div class="box-header with-border"><h3>添加商品分类</h3></div>
        <div class="box-body">
            @csrf
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="type_name">分类名称</label>
                <div class="col-sm-10"><input class="form-control" type="text" name="type_name" id="type_name" placeholder="分类名称"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="type_url">分类uri</label>
                <div class="col-sm-10"><input class="form-control" type="text" name="type_url" id="type_url" placeholder="分类uri"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="type_img">分类图片</label>
                <div class="col-sm-10"><input class="form-control" type="file" name="type_img" id="type_img" placeholder="分类图片"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="menus">父级ID</label>
                <div class="col-sm-10">
                    <select name="parent_id" id="parent_id" class="form-control">
                        @foreach ($types as $key => $value)
                            <option value="{{$value->type_id}}">{{str_repeat('|——',substr_count($value->path,'-'))}}{{$value->type_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="添加"></div>
    </div>
    </form>
@endsection
@section('js')
<script>
    
</script>
@endsection