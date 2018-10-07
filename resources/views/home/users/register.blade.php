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
					<div class="username">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;&nbsp;<input onblur="checkPwd()" id="user_pwd" class="shurukuang" type="password" name="user_pwd" placeholder="请输入你的密码"/><span id="checkPwd">请输入6位以上字符</span></div>
					<div class="username">确认密码:&nbsp;&nbsp;<input onblur="checkRepwd()" class="shurukuang" type="password" id="user_repwd" name="user_repwd" placeholder="请确认你的密码"/><span id="checkRepwd">两次密码要输入一致哦</span></div>
					<div class="username">
						<div class="left fl">验&nbsp;&nbsp;证&nbsp;&nbsp;码:&nbsp;&nbsp;<input id="captcha"  class="yanzhengma" type="captcha" name="captcha" value="{{old('captcha')}}" placeholder="请输入验证码" required></div>
						<div class="right fl">
							<div class="form-group">
								<div class="form-group">
									<div class="col-md-3">
										@if($errors->has('captcha'))
											<div class="col-md-12">
												<p class="text-danger text-left"><strong>{{$errors->first('captcha')}}</strong></p>
											</div>
										@endif
									</div>
									<div class="col-md-4">
										<img src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()">
									</div>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="regist_submit">
					<input class="submit" type="submit" value="立即注册" >
				</div>
				<script>
					/** 
						判断用户注册方式 ， 并通过ajax判断邮箱或者手机号码是否已经存在
					**/
					function checkName()
					{
						var user_name = $('#user_name').val();
						var regEmail = /^[A-Za-z0-9]+\@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
						var regTel = /^[\d]{11}$/;
						if (!regEmail.test(user_name) && !regTel.test(user_name)) {
							$('#checkName').text('验证失败');$('#user_name').css('border-color','red');
							return false;
						} else {
							$.ajax({
								type : 'post',
								url : "{{url('users/rename')}}",
								datatype : 'json',
								data : {'_token':'{{csrf_token()}}','userName':user_name},
								success:function (msg) {
									if (msg == 'null') {
										$('#user_name').css('border-color','green');
									} else {
										alert('用户已经存在');
										$('#user_name').css('border-color','red');
									}
								} , error:function () {
									alert('服务器繁忙');
								},
							});
							return true;
						}
					}


					/**@argument
						验证密码是否符合规则
					**/
					function checkPwd()
					{
						var user_pwd = $('#user_pwd').val();
						var regPwd = /^[a-zA-Z\d_\.\/]{8,}$/;
						if (regPwd.test(user_pwd)) {
							$('#checkPwd').text('密码验证成功');$('#user_pwd').css('border-color','green');return true;
						} else {
							$('#checkPwd').text('密码验证失败');$('#user_pwd').css('border-color','red');return false;
						}
					}

					/**@argument
						确认密码
					**/
					function checkRepwd()
					{
						var user_pwd = $('#user_pwd').val();
						var user_repwd = $('#user_repwd').val();
						var regPwd = /^[a-zA-Z\d_\.\/]{8,}$/;
						if (regPwd.test(user_repwd) && user_repwd == user_pwd) {
							$('#checkRepwd').text('验证成功');$('#user_repwd').css('border-color','green');return true;
						} else {
							$('#checkRepwd').text('验证失败');$('#user_repwd').css('border-color','red');return false;
						}
					}

					/**@argument
						限制表单提交
					**/
					$('form').submit(function(){
						// return false;
						if (checkName() && checkPwd() && checkRepwd()) {
							return true;
						} else {
							return false;
						}
					});
				</script>
			</div>
		</div>
		</form>
	</body>
</html>