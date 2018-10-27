@extends('admin.index.index')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">商品列表</div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <td></td>
                    <td>商品名称</td>
                    <td>商品货号</td>
                    <td>商品类型</td>
                    <td>商品库存</td>
                    <td>商品缩略图</td>
                    <td>上下架</td>
                    <td>浏览量</td>
                    <td>操作</td>
                </tr>
                @foreach ($goodsList as $key => $value)
                    <tr>
                        <td><input type="checkbox" name="" id=""></td>
                        <td>{{$value->good_name}}</td>
                        <td>{{$value->good_sn}}</td>
                        <td>{{isset($value->types->type_name)?$value->types->type_name:''}}</td>
                        <td>{{$value->good_num}}</td>
                        <td>{{$value->good_img}}</td>
                        <td><a href="">{{$value->is_sale?'点击下架':'点击上架'}}</a></td>
                        <td>{{$value->view_count}}</td>
                        <td>
                            <a href="{{URL::asset('/admin/goods/show?goodId='.$value->good_id)}}"><button class="btn btn-default btn-sm" title="查看详情"><i class="fa fa-list"></i></button></a>
                            <a href="{{URL::asset('/admin/goods/edit?goodId='.$value->good_id)}}"><button class="btn btn-default btn-sm" title="编辑"><i class="fa fa-edit"></i></button></a>
                            <a href="{{URL::asset('/admin/goods/delete?goodId='.$value->good_id)}}"><button class="btn btn-default btn-sm" title="删除"><i class="fa fa-trash-o"></i></button></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box-footer" style="text-align:right;">
            {{$goodsList->links()}}
        </div>
    </div>
@endsection