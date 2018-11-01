@extends('admin.index.index')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">商品列表</div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <td></td>
                    <td>商品名称</td>
                    <td>商品类型</td>
                    <td>商品价格</td>
                    <td>商品库存</td>
                    <td>上下架</td>
                    <td>是否是新品</td>
                    <td>浏览量</td>
                    <td>销量</td>
                    <td>添加时间</td>
                    <td>修改时间</td>
                    <td>操作</td>
                </tr>
                @foreach ($goodsList as $key => $value)
                    <tr>
                        <td><input type="checkbox" name="" id=""></td>
                        <td>{{$value->good_name}}</td>
                        <td>{{isset($value->types->type_name)?$value->types->type_name:''}}</td>
                        <td>￥{{$value->good_price/100}}</td>
                        <td>{{$value->good_num}}</td>
                        <td><a href="">{{$value->is_sale?'点击下架':'点击上架'}}</a></td>
                        <td><span>{{$value->is_new?'是':'否'}}</span></td>
                        <td>{{$value->view_count}}</td>
                        <td>{{$value->sales_volum}}</td>
                        <td>{{date('Y-m-d H:i:s',$value->create_time)}}</td>
                        <td>{{date('Y-m-d H:i:s',$value->update_time)}}</td>
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