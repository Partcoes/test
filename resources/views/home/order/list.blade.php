@extends('home.order.main')
@section('right')
<div class="rtcont fr">
        <div class="ddzxbt">交易订单</div>
        <div class="ddxq">
            <div class="ddspt fl"><img src="{{URL::asset('/home/image/gwc_xiaomi6.jpg')}}" alt=""></div>
            <div class="ddbh fl">订单号:1705205643098724</div>
            <div class="ztxx fr">
                <ul>
                    <li>已发货</li>
                    <li>￥2499.00</li>
                    <li>2017/05/20 13:30</li>
                    <li><a href="">订单详情></a></li>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="ddxq">
            <div class="ddspt fl"><img src="{{URL::asset('/home/image/liebiao_hongmin4_dd.jpg')}}" alt=""></div>
            <div class="ddbh fl">订单号:170526435444865</div>
            <div class="ztxx fr">
                <ul>
                    <li>已发货</li>
                    <li>￥1999.00</li>
                    <li>2017/05/26 14:02</li>
                    <li><a href="">订单详情></a></li>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection