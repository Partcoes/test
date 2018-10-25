@extends('admin.index.index')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">属性列表</div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <td></td>
                    <td>属性名称</td>
                    <td>类型</td>
                    <td>状态</td>
                    <td>操作</td>
                </tr>
                @foreach ($attrs as $key => $value)
                    <tr>
                        <td><input type="checkbox" name="" id=""></td>
                        <td>{{$value->attr_name}}</td>
                        <td>{{$value->types->type_name}}</td>
                        <td><a href="">{{$value->status?'点击禁用':'点击恢复'}}</a></td>
                        <td>
                            <a href="{{URL::asset('/admin/attrs/show?attrId='.$value->attr_id)}}"><button class="btn btn-default btn-sm" title="查看详情"><i class="fa fa-list"></i></button></a>
                            <a href="{{URL::asset('/admin/attrs/edit?attrId='.$value->attr_id)}}"><button class="btn btn-default btn-sm" title="编辑"><i class="fa fa-edit"></i></button></a>
                            <a href="{{URL::asset('/admin/attrs/delete?attrId='.$value->attr_id)}}"><button class="btn btn-default btn-sm" title="删除"><i class="fa fa-trash-o"></i></button></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box-footer" style="text-align:right;">
            
        </div>
    </div>
@endsection