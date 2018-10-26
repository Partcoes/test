@extends('admin.index.index')
@section('content')
<form action="{{URL::asset('admin/types/getattrs')}}" method="post" enctype="multipart/form-data">
    <div class="box box-info">
        <div class="box-header with-border"><h3>商品分类属性</h3></div>
        <div class="box-body">
            @csrf
            <input type="hidden" name="type_id" value="{{isset($typeInfo->type_id)?$typeInfo->type_id:''}}" {{isset($typeInfo->type_id)?'':'disabled'}}>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-12 control-label" for="type_name">分类名称·{{$defaultType->type_name}}</label>
                <input type="hidden" name="type_id" value="{{isset($defaultType->type_id)?$defaultType->type_id:''}}" {{isset($defaultType->type_id)?'':'disabled'}}>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="attrs">属性列表</label>
                <div class="col-sm-10">
                    @foreach ($attrs as $key => $value)
                        <p><input type="checkbox" name="attrs[]" value="{{$value->attr_id}}" {{in_array($value->attr_id,$attrsArr)?'checked':''}}>{{$value->attr_name}}</p>
                    @endforeach
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