@extends('admin.index.index')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">菜单展示</div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <td></td>
                    <td>菜单名称</td>
                    <td>菜单地址</td>
                    <td>上级菜单</td>
                    <td>path</td>
                    <td>是否是菜单</td>
                    <td>操作</td>
                </tr>
                @foreach ($menus as $key => $item)
                <tr>
                    <td><input type="checkbox" name="" id=""></td>
                    <td>{{str_repeat('|——',substr_count($item->path,'-'))}}{{$item->menu_name}}</td>
                    <td>{{$item->menu_uri}}</td>
                    <td>{{$item->parent_id}}</td>
                    <td>{{$item->path}}</td>
                    <td><span>{{$item->is_menu?'菜单':'按钮'}}</span></td>
                    <td></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection