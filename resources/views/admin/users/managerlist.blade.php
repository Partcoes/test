@extends('admin.index.index')
@section('content')
    <div class="box box-primary">
    <div class="box-header with-border">管理员列表</div>
    <table class="table table-hover table-striped">
        <tr>
            <td></td>
            <td>管理员名称</td>
            <td>管理员邮箱</td>
            <td>管理员手机</td>
            <td>是否是超级管理员</td>
            <td>是否冻结</td>
            <td>最后登录时间</td>
            <td>操作</td>
        </tr>
        @foreach ($managerList as $key => $value)
        <tr>
            <td><input type="checkbox" name="" id=""></td>
            <td>{{$value->manager_name}}</td>
            <td>{{$value->manager_email}}</td>
            <td>{{$value->manager_mobile?:'此管理员手机号码未知'}}</td>
            <td><span>{{$value->is_super?'是':'否'}}</span></td>
            <td id="is_freeze_td_{{$value->manager_id}}"><a class="freeze" id="{{$value->manager_id}}" href="javascript:void(0);">{{$value->is_freeze?'点击解冻':'点击冻结'}}</a></td>
            <td>{{date('Y-m-d H:i:s',$value->last_login_time)}}</td> 
            <td>
                <button id="{{$value->manager_id}}" class="btn btn-default btn-sm delete" title="删除"><i class="fa fa-trash-o"></i></button>
                <a href="{{URL::asset('/admin/users/edit?manager_id='.$value->manager_id)}}"><button id="{{$value->manager_id}}" class="btn btn-default btn-sm edit" title="编辑"><i class="fa fa-edit"></i></button></a>
            </td>
        </tr>
        @endforeach
    </table>
    </div>
@endsection
@section('js')
    <script>
        $('.delete').click(function(){
            var managerId = $(this).attr('id');
            $.ajax({
                type : 'post',
                url : "{{URL::asset('/admin/users/delete')}}",
                data : {managerId:managerId,"_token":"{{csrf_token()}}"},
                success:function(msg){
                    if (msg == 0) {
                        alert('此账号已登录');
                    } else {
                        alert('删除成功');history.go(0);
                    }
                }
            });
        });
        $('.freeze').click(function(){
            var managerId = $(this).attr('id');
            var is_freeze = $()
            $.ajax({
                type : 'post',
                url : "{{URL::asset('/admin/users/freeze')}}",
                data : {managerId:managerId,"_token":"{{csrf_token()}}"},
                success:function(msg){
                    if (msg == 0) {
                        alert('此账号已登录');
                    } else {
                        alert('冻结/解冻成功');history.go(0);
                    }
                }
            });
        });
    </script>
@endsection