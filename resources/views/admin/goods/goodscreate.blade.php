@extends('admin.index.index')
@section('css')
    <style>
        #goodattrs{
            list-style:none;
        }
        #goodattrs li{
            float:left;
            width:10%;
            text-align:center;
            margin-left:25px;
        }
    </style>
@endsection
@section('content')
<form action="{{URL::asset('admin/goods')}}" method="post" enctype="multipart/form-data">
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
            <div class="form-group" style="height:350px;">
                <label class="col-sm-2 control-label" for="description">商品描述</label>
                <div id="editor" class="col-sm-10" name="description">
                    <p>请输入商品描述</p>
                </div>
                <textarea name="description" id="description" hidden></textarea>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="type_id">商品分类</label>
                <div class="col-sm-7">
                    <select name="type_id" id="type_id" class="form-control">
                        <option value="0">请选择分类</option>
                        @foreach ($types as $key => $value)
                            <option value="{{$value->type_id}}">{{str_repeat('|——',substr_count($value->path,'-'))}}{{$value->type_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <span style="color:red;">*请选择商品分类</span>
                </div>
            </div>
            <div class="form-group" style="height:85px;" id="good_attrs" hidden>
                <div class="col-sm-2"><b>商品属性</b></div>
                <ul class="col-sm-7" id="goodattrs">
                    @foreach ($attrs as $key => $value)
                        <li id="attr_{{$value->attr_id}}" hidden><label class="checkbox-inline"><input class="ownattrs" type="checkbox" name="attr[]" value="{{$value->attr_id}}">{{$value->attr_name}}</label></li>
                    @endforeach
                </ul>
                <div class="col-sm-3">
                    <span style="color:red;">*请选择商品属性</span>
                </div>
            </div>
            <div class="form-group" id="attr_value" hidden>
                <div class="col-sm-2">属性值</div>
                <div class="col-sm-7">
                    <table class="table table-bordered">
                    @foreach ($attrs as $key => $value)
                        <tr id="tr_{{$value->attr_id}}" class="attr_vals" hidden>
                            <td class="col-sm-2">{{$value->attr_name}}</td>
                            <td class="col-sm-10">
                                <p>
                                @foreach ($value->values as $k => $item)
                                    <span>
                                        <label style="margin-left:25px;" class="checkbox-inline"><input type="checkbox" class="attr_value_element" name="attr_values[{{$value->attr_id}}][]" parent="{{$value->attr_id}}" value="{{$item->attr_val_id}}">{{$item->attr_val_name}}</label>
                                    </span>
                                @endforeach
                                </p>
                                <p>
                                    <input class="form-control" type="text" name="news[{{$value->attr_id}}]" id="new_{{$value->attr_id}}" placeholder="没有想要的属性值可以手动添加">
                                </p>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
                <div class="col-sm-3">
                    <span style="color:red;">*请选择属性值,自定义添加时添加多个可使用-分开</span>
                </div>
                <div class="col-sm-12">
                    <p style="text-align:center;"><button type="button" class="btn btn-success" id="createSku">生成货品</button></p>
                </div>
            </div>
            <div class="form-group" style="min-height:45px;" id="skuInfo" hidden>
                <label class="col-sm-2 control-label" for="good_name">货品信息</label>
                <div class="col-sm-7">
                    <div class="col-sm-12">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <td>组合类型</td>
                                <td>价格</td>
                                <td>库存</td>
                                <td>重量</td>
                                <td>操作</td>
                            </thead>
                            <tbody id="skuDetail">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-3">
                    <span style="color:red;">*属性值列表，不存在的可以删除</span>
                </div>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="下一步"></div>
    </div>
    </form>
@endsection
@section('js')
<script type="text/javascript" src="{{URL::asset('js/wangEditor.min.js')}}"></script>
<script>
    $(function(){
        /**
         * 商品图片js
         */
        var TypeImg = $('input:file').attr('img');
        $('.thumb').attr('src','/images/inputfile.jpg');
        if (TypeImg) {
            $('.thumb').attr('src','/uploads/'+TypeImg);
        }
        $("#good_img").change(function(){
            $(".thumb").attr("src",URL.createObjectURL($(this)[0].files[0]));
        });

        /**
         * wangeditor编辑器
         */
        var Editor = window.wangEditor;
        var editor = new Editor('#editor');
        var description = $('#description');
        editor.customConfig.onchange = function (html) {
            description.val(html)
        };
        editor.customConfig.showLinkImg = false;
        // editor.customConfig.uploadImgServer = '/upload';
        editor.customConfig.uploadImgShowBase64 = true;
        editor.customConfig.uploadImgMaxLength = 5;
        editor.create();
        description.val(editor.txt.html());
        
        /**
         * 选中分类获取属性展示
         */
        $('#type_id').change(function(){
            var typeId = $(this).val();
            $.ajax({
                type : 'get',
                url : "{{URL::asset('admin/types/getattrsbytype')}}",
                data : {typeId:typeId},
                success:function(msg) {
                    if (msg == 0) {
                        $('#good_attrs').hide();
                    } else {
                        $('#good_attrs').show();
                        $('.ownattrs').parent().parent().hide();
                        $('.ownattrs').each(function(){
                            var attrId = $(this).val();
                            $(this).prop('checked',false);
                            $(this).on('change',is_show(false,attrId));
                        });
                        for (var start = 0 ; start < msg.length ; start ++) {
                            $('#attr_'+msg[start].attr_id).show();
                        }
                    }
                }
            });
        });

        /**
         * 选中属性获取属性值
         */
        $('.ownattrs').each(function(){
            $(this).change(function(){
                var attrId = $(this).val();
                var bool = $(this).is(':checked');
                is_show(bool,attrId);
            });
        });


        /**
         * 点击判断是否显示隐藏
         */
        function is_show(bool,attrId)
        {
            if ( bool ) {
                $('#attr_value').show();
                $('#tr_'+attrId).show();
            } else {
                $('#tr_'+attrId).hide();
                $('.attr_value_element').prop('checked',false);
                if (!$('.ownattrs').is(':checked')) {
                    $('#attr_value').hide();
                }
            }
            
        }
        
        /**
         * 点击生成货品信息
         */
        $('#createSku').click(function(){
            var allAttrVal = [];
            $('.attr_vals').each(function(){
                var child = [];
                $(this).find('.attr_value_element').each(function(){
                    if ($(this).is(':checked')) {
                        child.push($(this).val());
                    }
                });
                allAttrVal.push(child);
            });
            $.ajax({
                type : 'post',
                url : "{{URL::asset('admin/goods/sku')}}",
                data : {allAttrVal:allAttrVal,'_token':"{{csrf_token()}}"},
                dataType : 'json',
                success:function(msg) {
                    if (!msg) {
                        alert('请选择属性值');return;
                    } else {
                        $('#skuInfo').show();
                        var skuInfoHtml = '';
                        for (var start in msg) {
                            skuInfoHtml += "<tr id='sku-tr-"+start+"'><td><input type='hidden' name='sku_str["+start+"][]' value='"+msg[start].idstr+"' /><input type='text' name='sku_name["+start+"][]' value='"+msg[start].valstr+"'  /></td><td><input type='text' name='sku_price["+start+"][]' placeholder='请输入货品价格'></td><td><input type='text' name='sku_inventory["+start+"][]' placeholder='请输入货品库存量'></td><td><input type='text' name='sku_weight["+start+"][]' placeholder='请输入货品重量'></td><td><button type='button' class='btn btn-warning sku-del' id='"+start+"'>删除</button></td></tr>";
                        }
                        $('#skuDetail').html(skuInfoHtml);
                    }
                    $('.sku-del').each(function(){
                        $(this).click(function(){
                            var id = $(this).attr('id');
                            $('#sku-tr-'+id).remove();
                        });
                    });
                }
            });
        });
    });
</script>
@endsection