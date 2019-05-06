<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <title>登录</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <link href="/Public/Admin/css/login.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/Public/Admin/css/layer.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body>
<div class="login">
    <h2>作业管理系统</h2>
    <div class="login-top">
        <h1>管理员登录</h1>
        <form>
            <input type="text" value="User Id" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'User Id';}">
            <input type="password" value="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}">
        </form>
    </div>

    <input type="submit" value="Login" >

</div>
<script src="/Public/Admin/js/jquery-3.1.0.js"></script>
<script src="/Public/Admin/js/layer.js"></script>
<script src="/Public/Admin/js/dialog.js"></script>
<script>
    dialog.error("登录失败!");
</script>
</body>
</html>