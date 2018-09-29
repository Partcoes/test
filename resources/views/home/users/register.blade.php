<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="author" content="order by dede58.com"/>
		<title>用户注册</title>
		<link rel="stylesheet" type="text/css" href="{{URL::asset('/home/css/login.css')}}">
		<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
	</head>
	<body>
		<form  method="post" action="{{url('users/register')}}">
		@csrf
		<div class="regist">
			<div class="regist_center">
				<div class="regist_top">
					<div class="left fl">会员注册</div>
					<div class="right fr"><a href="/" target="_self">小米商城</a></div>
					<div class="clear"></div>
					<div class="xian center"></div>
				</div>
				<div class="regist_main center">
					<div class="username">用&nbsp;&nbsp;户&nbsp;&nbsp;名:&nbsp;&nbsp;<input onblur="checkName()" class="shurukuang" type="text" id="user_name" name="user_name" placeholder="请输入邮箱或者手机号"/><span id="checkName">请输入邮箱或者手机号</span></div>
					<div class="username">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;&nbsp;<input class="shurukuang" type="password" name="user_pwd" placeholder="请输入你的密码"/><span id="checkPwd">请输入6位以上字符</span></div>
					<div class="username">确认密码:&nbsp;&nbsp;<input class="shurukuang" type="password" name="user_repwd" placeholder="请确认你的密码"/><span id="checkRepwd">两次密码要输入一致哦</span></div>
					<div class="username">
						<div class="left fl">验&nbsp;&nbsp;证&nbsp;&nbsp;码:&nbsp;&nbsp;<input class="yanzhengma" type="text" name="verification" placeholder="请输入验证码"/></div>
						<div class="right fl"><img src="/home/image/yanzhengma.jpg"></div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="regist_submit">
					<input class="submit" type="submit" value="立即注册" >
				</div>
				<script>
					function checkName()
					{
						var user_name = $('#user_name').val();
						var regEmail = /^[A-Za-z0-9]+\@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
						var regTel = /^[\d]{11}$/;
						if (regEmail.test(user_name)) {
							$('#checkName').text('用户邮箱登录');$('#user_name').css('border-color','green');
						} else if (regTel.test(user_name)) {
							$('#checkName').text('用户手机号码登录');$('#user_name').css('border-color','green');
						} else {
							$('#checkName').text('验证失败');$('#user_name').css('border-color','red');
						}
						$.ajax({
							type : 'post',
							url : "{{url('users/rename')}}",
							datatype : 'json',
							data : {'_token':'{{csrf_token()}}','userName':user_name},
							success:function (msg) {
								if (msg == 'null') {
									// $('#user_name').css('border-color','green');
								} else {
									alert('用户已经存在');
								}
							}
						});
					}
				</script>
			</div>
		</div>
		</form>
	</body>
</html>