@extends('layus.layus')
@section('main')
    <!-- start danpin -->
		<div class="danpin center">
			@foreach ($goodsList as $key => $item)
			<div class="biaoti center">小米手机</div>
			<div class="main center">
				<div class="mingxing fl mb20" style="border:2px solid #fff;width:230px;cursor:pointer;" onmouseout="this.style.border='2px solid #fff'" onmousemove="this.style.border='2px solid red'">
					<div class="sub_mingxing"><a href="./xiangqing.html" target="_blank"><img src="./image/liebiao_xiaomi6.jpg" alt=""></a></div>
					<div class="pinpai"><a href="./xiangqing.html" target="_blank">小米6</a></div>
					<div class="youhui">5.16早10点开售</div>
					<div class="jiage">2499.00元</div>
				</div>

				<div class="clear"></div>
			</div>
		</div>
@endsection