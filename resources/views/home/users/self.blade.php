@extends('home.layus.left')
@section('right')
    <div class="rtcont fr">
        <div class="grzlbt ml40">我的资料</div>
        <div class="subgrzl ml40"><span>昵称</span><span>{{session()->get('userInfo')->user_nickname}}</span><span><a href="">编辑</a></span></div>
        <div class="subgrzl ml40"><span>手机号</span><span>{{session()->get('userInfo')->user_mobile?:'请完善信息'}}</span><span><a href="">编辑</a></span></div>
        <div class="subgrzl ml40"><span>邮箱</span><span>{{session()->get('userInfo')->user_email?:'请完善信息'}}</span><span><a href="">编辑</a></span></div>
        <div class="subgrzl ml40"><span>我的爱好</span><span>游戏，音乐，旅游，健身</span><span><a href="">编辑</a></span></div>
        <div class="subgrzl ml40"><span>收货地址</span><span>浙江省杭州市江干区19号大街571号</span><span><a href="">编辑</a></span></div>
    </div>
@endsection