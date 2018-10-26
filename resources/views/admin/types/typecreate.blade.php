@extends('admin.index.index')
@section('content')
<form action="{{URL::asset('admin/types')}}" method="post" enctype="multipart/form-data">
    <div class="box box-info">
        <div class="box-header with-border"><h3>添加商品分类</h3></div>
        <div class="box-body">
            @csrf
            <input type="hidden" name="type_id" value="{{isset($typeInfo->type_id)?$typeInfo->type_id:''}}" {{isset($typeInfo->type_id)?'':'disabled'}}>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="type_name">分类名称</label>
                <div class="col-sm-10"><input class="form-control" type="text" name="type_name" id="type_name" value="{{isset($typeInfo->type_name)?$typeInfo->type_name:''}}" placeholder="分类名称"></div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="type_url">分类uri</label>
                <div class="col-sm-10"><input class="form-control" type="text" name="type_url" id="type_url" value="{{isset($typeInfo->type_url)?$typeInfo->type_url:''}}" placeholder="分类uri"></div>
            </div>
            <div class="form-group" style="height:180px;">
                <label class="col-sm-2 control-label" for="type_img">分类图片</label>
                <div class="col-sm-10" style="position:relative">
                    <input style="width:250px;height:150px;position:absolute;opacity:0;" type="file" name="type_img" id="type_img" img="{{isset($typeInfo->type_img)?$typeInfo->type_img:''}}">
                    <img class="thumb" style="width:250px;height:150px;border-radius:25px;" src="" alt="">
                </div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="menus">父级ID</label>
                <div class="col-sm-6">
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="0">请选择父级元素</option>
                        @foreach ($types as $key => $value)
                            <option value="{{$value->type_id}}" {{isset($typeInfo->parent_id)&&$typeInfo->parent_id==$value->type_id?'selected':''}}>{{str_repeat('|——',substr_count($value->path,'-'))}}{{$value->type_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <span style="color:red;">*请选择父级元素</span>
                </div>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="添加"></div>
    </div>
    </form>
@endsection
@section('js')
<script>
    $(function(){
        var TypeImg = $('input:file').attr('img');
        if (TypeImg) {
            $('.thumb').attr('src','/uploads/'+TypeImg);
        } else {
            $('.thumb').attr('src','/images/inputfile.jpg');
        }
        $("#type_img").change(function(){
            $(".thumb").attr("src",URL.createObjectURL($(this)[0].files[0]));
        });
    });
</script>
@endsection