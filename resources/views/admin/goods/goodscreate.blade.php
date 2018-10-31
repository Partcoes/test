@extends('admin.index.index')
@section('css')
<link rel="stylesheet" href="{{ asset('css/fileinput.min.css') }}">
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
        .form-group{
            min-height:30px;
            margin-top:30px;
        }
    </style>
@endsection
@section('content')
<form action="{{URL::asset('admin/goods')}}" method="post" enctype="multipart/form-data">
    <div class="box box-info">
        <div class="box-header with-border"><h3>商品信息</h3></div>
        <div class="box-body">
            @csrf
            <div class="form-group col-sm-12">
                <label class="col-sm-2 control-label" for="good_name">商品名称</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="good_name" id="good_name" placeholder="商品名称" value="{{isset($default->good_name)?$default->good_name:''}}">
                </div>
            </div>
            <div class="form-group col-sm-12">
                <label class="col-sm-2 control-label" for="good_price">商品价格</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="good_price" id="good_price" placeholder="商品价格" value="{{isset($default->good_price)?$default->good_price:''}}">
                </div>
            </div>
            <div class="form-group col-sm-12">
                <label class="col-sm-2 control-label" for="good_num">商品数量</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="good_num" id="good_num" placeholder="商品数量" value="{{isset($default->good_num)?$default->good_num:''}}">
                </div>
            </div>
            <div class="form-group col-sm-12">
                <label class="col-sm-2 control-label" for="good_num">商品图片</label>
                <div class="col-sm-10">
                    <input multiple data-show-caption="true" type="file" name="good_img[]" id="good_img">
                </div>
            </div>
            <div class="form-group col-sm-12">
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
            <div class="form-group col-sm-12" id="good_attrs" hidden>
                <div class="col-sm-2"><b>商品属性</b></div>
                <ul class="col-sm-7" id="goodattrs">
                    @foreach ($attrs as $key => $value)
                        <li id="attr_{{$value->attr_id}}" autocomplete="off" hidden><label class="checkbox-inline"><input class="ownattrs" type="checkbox" name="attr[]" value="{{$value->attr_id}}">{{$value->attr_name}}</label></li>
                    @endforeach
                </ul>
                <div class="col-sm-3">
                    <span style="color:red;">*请选择商品属性</span>
                </div>
            </div>
            <div class="form-group col-sm-12" id="attr_value" hidden>
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
                <div class='col-sm-12'>
                    <p style="text-align:center;"><button type="button" class="btn btn-success" id="createSku">生成货品</button></p>
                </div>
            </div>
            <div class="form-group col-sm-12" id="skuInfo" hidden>
                <label class="col-sm-2 control-label" for="good_name">货品信息</label>
                <div class="col-sm-7">
                    <div>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td>组合类型</td>
                                    <td>sku_str</td>
                                    <td>价格</td>
                                    <td>库存</td>
                                    <td>重量</td>
                                    <td>操作</td>
                                </tr>
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
            <div class="form-group col-sm-12">
                <label class="col-sm-2 control-label" for="description">商品描述</label>
                <div id="editor" class="col-sm-10" name="description">
                    <p>请输入商品描述</p>
                </div>
                <textarea name="description" id="description" hidden></textarea>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="下一步"></div>
    </div>
    </form>
@endsection
@section('js')
<script type="text/javascript" src="{{URL::asset('js/wangEditor.min.js')}}"></script>
<script src="{{ asset('js/fileinput.min.js') }}"></script>
<script>
    $(function(){
        /**
         * 商品图片js
         */
	    initFileInput("good_img");
 
	    function initFileInput(ctrlName) {
	        var control = $('#' + ctrlName);
	        control.fileinput({
	            language: 'zh', //设置语言
	            uploadUrl: "", //上传的地址
	            allowedFileExtensions: ['jpg', 'gif', 'png','jpeg'],//接收的文件后缀
	            maxFilesNum : 5,//上传最大的文件数量
	            //uploadExtraData:{"id": 1, "fileName":'123.mp3'},
	            uploadAsync: true, //默认异步上传
	            showUpload: false, //是否显示上传按钮
	            showRemove : true, //显示移除按钮
	            showPreview : true, //是否显示预览
	            showCaption: false,//是否显示标题
	            browseClass: "btn btn-primary", //按钮样式
	            dropZoneEnabled: true,//是否显示拖拽区域
	            // minImageWidth: 50, //图片的最小宽度
	            // minImageHeight: 50,//图片的最小高度
	            // maxImageWidth: 1000,//图片的最大宽度
	            // maxImageHeight: 1000,//图片的最大高度
	            maxFileSize: 2048,//单位为kb，如果为0表示不限制文件大小
	            //minFileCount: 0,
	            // maxFileCount: 10, //表示允许同时上传的最大文件个数
	            enctype: 'multipart/form-data',
	            validateInitialCount:false,
	            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
	            msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
 
	        }).on('filepreupload', function(event, data, previewId, index) {     //上传中
	            var form = data.form, files = data.files, extra = data.extra,
	            response = data.response, reader = data.reader;
	            console.log('文件正在上传');
	        }).on("fileuploaded", function (event, data, previewId, index) {    //一个文件上传成功
	            console.log('文件上传成功！'+data.id);
 
	        }).on('fileerror', function(event, data, msg) {  //一个文件上传失败
	            console.log('文件上传失败！'+data.id);
	        })
		}

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
                    $('#skuInfo').hide();
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
                $('#attr_value').show(500);
                $('#tr_'+attrId).show(500);
            } else {
                $('#tr_'+attrId).hide(500);
                $('.attr_value_element').prop('checked',false);
                if (!$('.ownattrs').is(':checked')) {
                    $('#attr_value').hide(500);
                }
            }
            
        }
        
        /**
         * 点击生成货品信息
         */
        $('#createSku').click(function(){
            var allAttrId = [];
            var allAttrVal = [];
            $('.attr_vals').each(function(){
                var child = [];
                var val = [];
                $(this).find('.attr_value_element').each(function(){
                    if ($(this).is(':checked')) {
                        child.push($(this).val());
                        val.push($(this).parent().text());
                    }
                });
                allAttrId.push(child);
                allAttrVal.push(val);
            });
            $.ajax({
                type : 'post',
                url : "{{URL::asset('admin/goods/sku')}}",
                data : {allAttrId:allAttrId,allAttrVal:allAttrVal,'_token':"{{csrf_token()}}"},
                dataType : 'json',
                success:function(msg) {
                    if (!msg) {
                        alert('请选择属性值');return;
                    } else {
                        $('#skuInfo').show(500);
                        var skuInfoHtml = '';
                        for ( var start in msg[1]) {
                            skuInfoHtml += "<tr id='sku-tr-"+start+"'><td><input type='hidden' name='sku_str["+start+"][]' value='"+msg[0][start]+"' /><input readonly unselectable='on' type='text' name='sku_name["+start+"][]' value='"+msg[1][start]+"'  /></td><td><input type='text' name='sku_price["+start+"][]' placeholder='请输入货品价格'></td><td><input type='text' name='sku_inventory["+start+"][]' placeholder='请输入货品库存量'></td><td><input type='text' name='sku_weight["+start+"][]' placeholder='请输入货品重量'></td><td><button type='button' class='btn btn-warning sku-del' id='"+start+"'>删除</button></td></tr>";
                        }
                        $('#skuDetail').html(skuInfoHtml);
                    }
                    $('.sku-del').each(function(){
                        $(this).click(function(){
                            var id = $(this).attr('id');
                            $('#sku-tr-'+id).remove();
                            if ($('.sku-del').length == 0) {
                                $('#skuInfo').hide(500);
                            }
                        });
                    });
                }
            });
        });
    });
</script>
@endsection