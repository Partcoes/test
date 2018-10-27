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
            <div class="form-group" style="height:180px;">
                <label class="col-sm-2 control-label" for="good_num">商品图片</label>
                <div class="col-sm-10" style="position:relative">
                    <input style="width:250px;height:150px;position:absolute;opacity:0;" type="file" name="good_img" id="good_img" img="{{isset($goodInfo->good_img)?$goodInfo->good_img:''}}">
                    <img class="thumb" style="width:250px;height:150px;border-radius:25px;" src="" alt="">
                </div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="type_id">商品分类</label>
                <div class="col-sm-7">
                    <select name="type_id" id="type_id" class="form-control">
                        <option value="">请选择分类</option>
                        @foreach ($types as $key => $value)
                            <option value="{{$value->type_id}}">{{str_repeat('|——',substr_count($value->path,'-'))}}{{$value->type_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <span style="color:red;">*请选择商品分类</span>
                </div>
            </div>
            <div class="form-group" style="height:85px;">
                <label class="col-sm-2 control-label" for="attr_id">商品属性</label>
                <div class="col-sm-7">
                    <select name="attr_id[]" id="attr_id" class="form-control">
                        <option value="">请选择属性</option>
                        @foreach ($attrs as $key => $value)
                            <option value="{{$value->attr_id}}">{{$value->attr_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <span style="color:red;">*请选择商品属性</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="attr_id">属性值</label>
                <div class="col-sm-7">
                    <table class="table table-bordered">
                    @foreach ($attrs as $key => $value)
                        <tr>
                            <td class="col-sm-2">{{$value->attr_name}}</td>
                            <td class="col-sm-10">
                                <p>
                                @foreach ($value->values as $k => $item)
                                    <span>
                                        <input type="checkbox" name="attr_val_id">{{$item->attr_val_name}}
                                    </span>
                                @endforeach
                                </p>
                                <p>
                                    <input class="form-control" type="text" name="attr_val_name" id="attr_val_name" placeholder="没有想要的属性值可以手动添加">
                                </p>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
                <div class="col-sm-3">
                    <span style="color:red;">*请选择属性值</span>
                </div>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="保存"></div>
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
        $("#good_img").change(function(){
            $(".thumb").attr("src",URL.createObjectURL($(this)[0].files[0]));
        });
    });
</script>
@endsection