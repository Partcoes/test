@extends('admin.index.index')
@section('content')
<form action="{{URL::asset('admin/attributes')}}" method="post">
    <div class="box box-info">
        <div class="box-header with-border"><h3>属性信息</h3></div>
        <div class="box-body">
            @csrf
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="attr_name">属性名称</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="attr_name" id="attr_name" placeholder="商品名称" value="{{isset($default->attr_name)?$default->attr_name:''}}">
                </div>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="保存"></div>
    </div>
    </form>
@endsection