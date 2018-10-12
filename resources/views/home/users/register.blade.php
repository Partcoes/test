<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="order by dede58.com"/>
    <title>用户注册</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('home/css/login.css')}}">
    <script src="http://code.jquery.com/jquery-latest.js"></script>

</head>
<body>
<form  method="post" action="{{URL::asset('index.php/users/register')}}">
    @csrf
    <div class="regist">
        <div class="regist_center">
            <div class="regist_top">
                <div class="left fl">会员注册</div>
                <div class="right fr"><a href="{{URL::asset('/')}}" target="_self">小米商城</a></div>
                <div class="clear"></div>
                <div class="xian center"></div>
            </div>
            <div class="regist_main center">
                <div class="username">用&nbsp;&nbsp;户&nbsp;&nbsp;名:&nbsp;&nbsp;<input onblur="checkName()" id="user_name" class="shurukuang" type="text" name="user_name" placeholder="请输入邮箱或者手机号"/><span id="checkName">请输入邮箱或者手机号注册</span></div>
                <div class="username">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;&nbsp;<input onblur="checkPwd()" id="user_pwd" class="shurukuang" type="password" name="user_pwd" placeholder="请输入你的密码"/><span id="checkPwd">请输入6位以上字符</span></div>
                <div class="username">确认密码:&nbsp;&nbsp;<input onblur="checkRePwd()" id="user_re_pwd" class="shurukuang" type="password" name="user_re_pwd" placeholder="请确认你的密码"/><span id="checkRePwd">两次密码要输入一致哦</span></div>
                <div class="username">
                    <div class="left fl">验&nbsp;&nbsp;证&nbsp;&nbsp;码:&nbsp;&nbsp;<input onblur="checkCaptcha()" type="text" id="captcha" class="yanzhengma form-control {{$errors->has('captcha')?'parsley-error':''}}" name="captcha" placeholder="请输入验证码"></div>
                    <div class="right fl"><img id="captchaImg" src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()"><span id="checkCaptcha">请输入验证码</span></div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="regist_submit">
                <input class="submit" type="submit" value="立即注册" >
            </div>

        </div>
    </div>
</form>
<script>
        var resultCaptcha = false;
        /**@argument
         验证用户名是否符合规则
         **/
        function checkName()
        {
            var user_name = $('#user_name').val();
            var regEmail = /^[A-Za-z0-9]+\@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
            var regTel = /^[\d]{11}$/;
            if (!regEmail.test(user_name) && !regTel.test(user_name)) {
                $('#checkName').text('验证失败');$('#user_name').css('border-color','red');return false;
            } else {
                $('#checkName').text('验证成功');$('#user_name').css('border-color','green');return true;
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
        function checkRePwd()
        {
            var user_pwd = $('#user_pwd').val();
            var user_re_pwd = $('#user_re_pwd').val();
            var regPwd = /^[a-zA-Z\d_\.\/]{8,}$/;
            if (regPwd.test(user_re_pwd) && user_re_pwd == user_pwd) {
                $('#checkRePwd').text('验证成功');$('#user_re_pwd').css('border-color','green');return true;
            } else {
                $('#checkRePwd').text('验证失败');$('#user_re_pwd').css('border-color','red');return false;
            }
        }

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
                    url : "{{URL::asset('index.php/users/checkCaptcha')}}",
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
                case 0 : $('#checkCaptcha').text('请输入验证码');$('#captcha').css('border-color','red');resultCaptcha = false;return;
                case 1 : $('#checkCaptcha').text('验证成功');$('#captcha').css('border-color','green');resultCaptcha = true;return;
                case 2 : $('#checkCaptcha').text('验证码错误');$('#captcha').css('border-color','red');resultCaptcha = false;return;
            }
        }

        /**@argument
         限制表单提交
         **/
        $('form').submit(function(){
            if (checkName() && checkPwd() && checkRePwd() && resultCaptcha == true) {
                return true;
            } else {
                return false;
            }
        });
</script>
</body>
</html>