@extends('layus.layus')
@section('main')
    <!-- start danpin -->
		<div class="danpin center">
			<div class="biaoti center">小米手机</div>
			<div class="main center">
				@foreach ($goodsList as $key => $item)
				<div class="mingxing fl mb20" style="border:2px solid #fff;width:230px;cursor:pointer;" onmouseout="this.style.border='2px solid #fff'" onmousemove="this.style.border='2px solid red'">
					<div class="sub_mingxing"><a href="./xiangqing.html" target="_blank"><img src="./image/liebiao_xiaomi6.jpg" alt=""></a></div>
					<div class="pinpai"><a href="./xiangqing.html" target="_blank">{{$item->good_name}}</a></div>
					<div class="youhui">5.16早10点开售</div>
					<div class="jiage">{{$item->good_price}}元</div>
				</div>
				@endforeach
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
@endsection