<form action="" method="post">
    {{csrf_field()}}
    <p>账号：<input type="text" name="username" id="username"></p>
    <p>密码：<input type="password" name="password" id="password"></p>
    <input type="submit" value="提交">
</form>