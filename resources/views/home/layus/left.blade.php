@extends('home.layus.layus')
@section('main')
    <!-- self_info -->
    <div class="grzxbj">
        <div class="selfinfo center">
            <div class="lfnav fl">
                <div class="ddzx">订单中心</div>
                <div class="subddzx">
                    <ul>
                        <li><a href="./dingdanzhongxin.html" >我的订单</a></li>
                        <li><a href="">意外保</a></li>
                        <li><a href="">团购订单</a></li>
                        <li><a href="">评价晒单</a></li>
                    </ul>
                </div>
                <div class="ddzx">个人中心</div>
                <div class="subddzx">
                    <ul>
                        <li><a href="./self_info.html" style="color:#ff6700;font-weight:bold;">我的个人中心</a></li>
                        <li><a href="">消息通知</a></li>
                        <li><a href="">优惠券</a></li>
                        <li><a href="">收货地址</a></li>
                    </ul>
                </div>
            </div>
                @yield('right')
            <div class="clear"></div>
        </div>
    </div>
    <!-- self_info -->
@endsection