@extends('admin.index.index')
@section('content')
<form action="{{URL::asset('admin/menus')}}" method="post">
    <div class="box box-info">
        <div class="box-header with-border"><h3>商品信息</h3></div>
        <div class="box-body">
            @csrf
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="good_name">商品名称</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="good_name" id="good_name" placeholder="商品名称" value="{{isset($default->good_name)?$default->good_name:''}}">
                </div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="good_price">商品价格</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="good_price" id="good_price" placeholder="商品价格" value="{{isset($default->good_price)?$default->good_price:''}}">
                </div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="good_num">商品数量</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="good_num" id="good_num" placeholder="商品数量" value="{{isset($default->good_num)?$default->good_num:''}}">
                </div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="brand_id">商品品牌</label>
                <div class="col-sm-7">
                    <select name="brand_id" id="brand_id" class="form-control">
                        <option value="0">请选择品牌</option>
                        @foreach ($brands as $key => $value)
                            <option value="{{$value->brand_id}}">{{$value->brand_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <span style="color:red;">*请选择商品品牌</span>
                </div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="attr_id">商品属性</label>
                <div class="col-sm-7">
                    @foreach ($attrs as $key => $value)
                        <div class="col-sm-4">
                            <p><b>{{$value->attr_name}}</b></p>
                            <select name="" id="" class="form-control">
                                <option value="0">请选择属性值</option>
                                @foreach ($value->values as $k => $item)
                                    <option><span>{{$item->attr_val_name}}</span></option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-3">
                    <span style="color:red;">*请选择属性</span>
                </div>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="保存"></div>
    </div>
    </form>
@endsection