<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="order by dede58.com"/>
    <title>会员登录</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/home/css/login.css')}}">
    <script src="{{URL::asset('/js/jquery-3.1.1.min.js')}}"></script>

</head>
<body>
<!-- login -->
<div class="top center">
    <div class="logo center">
        <a href="{{URL::asset('/')}}" target="_blank"><img src="{{URL::asset('/home/image/mistore_logo.png')}}" alt=""></a>
    </div>
</div>
<form  method="post" action="{{URL::asset('/users/login')}}" class="form center">
    @csrf
    <div class="login">
        <div class="login_center">
            <div class="login_top">
                <div class="left fl">会员登录</div>
                <div class="right fr">您还不是我们的会员？<a href="{{URL::asset('/users/register')}}" target="_self">立即注册</a></div>
                <div class="clear"></div>
                <div class="xian center"></div>
            </div>
            <div class="login_main center">
                <div class="username">用户名:&nbsp;<input class="shurukuang" type="text" name="user_name" placeholder="请输入你的用户名"/></div>
                <div class="username">密&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;<input class="shurukuang" type="password" name="user_pwd" placeholder="请输入你的密码"/></div>
                <div class="username">
                    <div class="left fl">验证码:&nbsp;<input onblur="checkCaptcha()" id="captcha" type="text" class="yanzhengma form-control {{$errors->has('captcha')?'parsley-error':''}}" name="captcha" placeholder="请输入验证码"></div>
                    <div class="right fl"><img id="captchaImg" src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()"></div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="login_submit">
                <input class="submit" type="submit" value="立即登录" >
            </div>

        </div>
        <script>
            var resultCaptcha = false;
            /**@argument
             验证验证码是否正确
             **/
            function checkCaptcha()
            {
                var captcha = $('#captcha').val();
                var status = 0;
                if (captcha) {
                    $.ajax({
                        type : 'post',
                        url : "{{URL::asset('/users/checkCaptcha')}}",
                        data : {captcha:captcha , '_token':"{{csrf_token()}}"},
                        datatype : 'json',
                        async : false,
                        success:function() {
                            status = 1;
                        } , error:function() {
                            $('#captchaImg').trigger('click');
                            status = 2;
                        }
                    });
                } else {
                    status = 0;
                }
                console.log(status);
                switch (status) {
                    case 0 : $('#captcha').css('border-color','red');resultCaptcha = false;return;
                    case 1 : $('#captcha').css('border-color','green');resultCaptcha = true;return;
                    case 2 : $('#captcha').css('border-color','red');resultCaptcha = false;return;
                }
            }

            /**
             * 限制表单提交
             */
            $('form').submit(function(){
                if (resultCaptcha == 1) {
                    return true;
                } else {
                    $('#captcha').css('border-color','red');
                    $('#captchaImg').trigger('click');
                    return false;
                }
            });
        </script>
    </div>
</form>
<footer>
    <div class="copyright">简体 | 繁体 | English | 常见问题</div>
    <div class="copyright">小米公司版权所有-京ICP备10046444-<img src="{{URL::asset('/home/image/ghs.png')}}" alt="">京公网安备11010802020134号-京ICP证110507号</div>

</footer>
</body>
</html>