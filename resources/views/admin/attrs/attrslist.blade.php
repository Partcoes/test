@extends('admin.index.index')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">属性列表</div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <td></td>
                    <td>属性名称</td>
                    <td>操作</td>
                </tr>
                @foreach ($attrs as $key => $value)
                    <tr>
                        <td><input type="checkbox" name="" id=""></td>
                        <td>{{$value->attr_name}}</td>
                        <td>
                            <a href="{{URL::asset('/admin/attributes/edit?attrId='.$value->attr_id)}}"><button class="btn btn-default btn-sm" title="添加属性值"><i class="fa fa-edit"></i></button></a>
                            <a href="{{URL::asset('/admin/attributes/delete?attrId='.$value->attr_id)}}"><button class="btn btn-default btn-sm" title="删除"><i class="fa fa-trash-o"></i></button></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box-footer" style="text-align:right;">
            
        </div>
    </div>
@endsection