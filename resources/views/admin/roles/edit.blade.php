@extends('admin.index.index')
@section('content')
<form action="{{URL::asset('admin/roles/edit')}}" method="post">
    <div class="box box-primary">
        <div class="box-header with-border"><h3>修改角色权限</h3></div>
        <div class="box-body">
            @csrf
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="role_name">角色名称</label>
                <div class="col-sm-10">
                    <input type="hidden" name="role_name" value="{{$role->role_name}}">
                    <p>{{$role->role_name}}</p>
                </div>
            </div>
            <div class="form-group" style="height:45px;">
                <label class="col-sm-2 control-label" for="menus">分配权限</label>
                <div class="col-sm-10">
                    @foreach ($allAccess as $key => $value)
                        @if ($value->parent_id == 0)
                            <p class="clear"><b><input onchange="parent({{$value->menu_id}})" type="checkbox"  name="menus[]" id="parent_{{$value->menu_id}}" value="{{$value->menu_id}}" {{in_array($value->menu_id,$resourceIds)?'checked':''}}>{{$value->menu_name}}</b></p>
                        @else
                            <p class="clear">{{str_repeat('|——',substr_count($value->path,'-'))}}<input onchange="child({{$value->parent_id}})" type="checkbox" name="menus[]" id="parent_{{$value->menu_id}}" class="child_{{$value->parent_id}}" value="{{$value->menu_id}}" {{in_array($value->menu_id,$resourceIds)?'checked':''}}>{{$value->menu_name}}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="box-footer"><input class="btn btn-default" type="reset" value="重置"><input class="btn btn-info pull-right" type="submit" value="保存"></div>
    </div>
    </form>
@endsection
@section('js')
<script>

    /**
        选中角色自动选中拥有权限
     */
    $('#roles').change(function(){
        var roleId = $(this).val();
        $.ajax({
            type : 'post',
            url : "{{URL::asset('/admin/roles/update')}}",
            data : {roleId:roleId,'_token':"{{csrf_token()}}"},
            success:function(msg) {
                console.log(msg);
            }
        });
    });
    /**
    *点击父级元素直接选中全部子元素
    */
    function parent(id)
    {
        var status = $('#parent_'+id).is(':checked');
        $('.child_'+id).prop('checked',status);
    }

    /**
    *当一个子集选中直接选中父元素或者所有子集未选中父元素取消选中
    */
    function child(id)
    {
        var status = $('.child_'+id).is(':checked');
        $('#parent_'+id).prop('checked',status);
    }
</script>
@endsection