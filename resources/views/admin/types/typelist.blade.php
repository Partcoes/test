@extends('admin.index.index')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">商品分类列表</div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <td></td>
                    <td>商品分类名称</td>
                    <td>分类uri</td>
                    <td>上级id</td>
                    <td>属性</td>
                    <td>分类图片</td>
                    <td>操作</td>
                </tr>
                @foreach ($types as $key => $value)
                    <tr>
                        <td><input type="checkbox" name="" id=""></td>
                        <td>{{str_repeat('|——',substr_count($value->path,'-'))}}{{$value->type_name}}</td>
                        <td>{{$value->type_url}}</td>
                        <td>{{$value->parent_id}}</td>
                        <td>
                            @foreach ($value->attrs as $k => $item)
                                <span>{{$item->attr_name}}</span>
                            @endforeach
                        </td>
                        <td><img src="{{URL::asset('/uploads/'.$value->type_img)}}" alt="分类图片" width="60"></td>
                        <td>
                            <a href="{{URL::asset('/admin/types/getattrsform?typeId='.$value->type_id)}}"><button class="btn btn-default btn-sm" data-toggle="tooltip" title="分配属性"><i class="fa fa-plus-square"></i></button></a>
                            <a href="{{URL::asset('/admin/types/edit?typeId='.$value->type_id)}}"><button class="btn btn-default btn-sm" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></button></a>
                            <a href="{{URL::asset('/admin/types/delete?typeId='.$value->type_id)}}"><button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除"><i class="fa fa-trash-o"></i></button></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box-footer" style="text-align:right;">
            {{$types->links()}}
        </div>
    </div>
@endsection
@section('js')
<script>
    $(function(){
        $("[data-toggle='tooltip']").tooltip();
    });
</script>
@endsection