<<<<<<< HEAD
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Warning</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{URL::asset('/js/jquery-3.1.1.min.js')}}"></script>
</head>
<body>
<div class="container" style="width:40%;position: fixed;top: 30%;left:30%;">
    <div class="wrapper-page">
        <div class="panel panel-color {{ $data['status']?'panel-inverse':'panel-danger' }}">

            <div class="panel-heading">
                <h3 class="text-center m-t-10">{{ $data['message'] }}</h3>
            </div>

            <div class="panel-body">
                <div class="text-center">
                    <div class="alert {{ $data['status']?'alert-info':'alert-danger' }} alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        浏览器页面将在<b id="loginTime">{{ $data['jumpTime'] }}</b>秒后跳转......
                    </div>
                    <div class="form-group m-b-0">
                        <div class="input-group">
                            {{--<input type="password" class="form-control" placeholder="Enter Email">--}}
                            <span class="input-group-btn"> <button type="submit" class="btn {{ $data['status']?'btn-success':'btn-danger' }}">点击立即跳转</button> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        //循环倒计时，并跳转
        var url = "{{ $data['url'] }}";
        var loginTime = parseInt($('#loginTime').text());
        var time = setInterval(function(){
            loginTime = loginTime-1;
            $('#loginTime').text(loginTime);
            if(loginTime==0){
                clearInterval(time);
                window.location.href=url;
            }
        },1000);
    })
    //点击跳转
    $('.btn').click(function () {
        var url = "{{ $data['url'] }}";
        window.location.href=url;
    })
</script>
</body>
=======
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Warning</title>
    <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.min.css')}}">
    <script src="{{URL::asset('/js/jquery-3.1.1.min.js')}}"></script>
</head>
<body>
<div class="container" style="width:40%;position: fixed;top: 30%;left:30%;">
    <div class="wrapper-page">
        <div class="panel panel-color {{ $data['status']?'panel-inverse':'panel-danger' }}">

            <div class="panel-heading">
                <h3 class="text-center m-t-10">{{ $data['message'] }}</h3>
            </div>

            <div class="panel-body">
                <div class="text-center">
                    <div class="alert {{ $data['status']?'alert-info':'alert-danger' }} alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        浏览器页面将在<b id="loginTime">{{ $data['jumpTime'] }}</b>秒后跳转......
                    </div>
                    <div class="form-group m-b-0">
                        <div class="input-group">
                            {{--<input type="password" class="form-control" placeholder="Enter Email">--}}
                            <span class="input-group-btn"> <button type="submit" class="btn {{ $data['status']?'btn-success':'btn-danger' }}">点击立即跳转</button> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        //循环倒计时，并跳转
        var url = "{{ $data['url'] }}";
        var loginTime = parseInt($('#loginTime').text());
        var time = setInterval(function(){
            loginTime = loginTime-1;
            $('#loginTime').text(loginTime);
            if(loginTime==0){
                clearInterval(time);
                window.location.href=url;
            }
        },1000);
    })
    //点击跳转
    $('.btn').click(function () {
        var url = "{{ $data['url'] }}";
        window.location.href=url;
    })
</script>
</body>
>>>>>>> d44f2f3efc6cb1f8c34cd192d953ebe542ea1fbe
</html>