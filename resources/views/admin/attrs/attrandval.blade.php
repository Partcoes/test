@extends('admin.index.index')
@section('content')
<form action="{{URL::asset('admin/attributes/edit')}}" method="post">
    <div class="box box-info">
        <div class="box-header with-border"><h3>属性值信息</h3></div>
        <div class="box-body">
            @csrf
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="attr_name">属性名称</label>
                <div class="col-sm-10">
                    <input type="hidden" name="attr_id" value="{{isset($attrInfo->attr_id)?$attrInfo->attr_id:''}}" {{isset($attrInfo->attr_id)?'':'disabled'}}>
                    <input class="form-control" type="text" name="attr_name" id="attr_name" placeholder="商品名称" value="{{isset($attrInfo->attr_name)?$attrInfo->attr_name:''}}">
                </div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="attr_values">属性值</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="attr_values" id="attr_values" value="{{isset($valueStr)?$valueStr:''}}">
                </div>
                <div class="con-sm-4">
                    <span style="color:red;">*请填写属性值，不同的属性值以-分隔</span>
                </div>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="保存"></div>
    </div>
    </form>
@endsection