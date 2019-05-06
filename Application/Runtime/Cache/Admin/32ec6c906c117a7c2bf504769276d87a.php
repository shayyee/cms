<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <title>登录</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <link href="/Public/css/layer.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/Public/css/custom-styles.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="/Public/css/login.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body>
<div class="login">
    <h2>作业管理系统</h2>
    <div class="login-top">
        <h1>管理员登录</h1>
        <form method="post">
            <input name="username" type="text" onfocus="this.value = '';" placeholder="Username">
            <input name="password" type="password" onfocus="this.value = '';" placeholder="Password">
            <input id="r1" type="radio" name="usertype" value="1" checked="checked"><label for="r1"><i>✓</i>管理员</label>
            <input id="r2" type="radio" name="usertype" value="2"><label for="r2"><i>✓</i>教师</label>
        </form>
    </div>
    <button type="button" onclick="login.check('/Admin/Login/check','/Admin/Index/index.html')">Login</button>

</div>
<script src="/Public/js/jquery-3.1.0.js"></script>
<script src="/Public/js/layer.js"></script>
<script src="/Public/js/dialog.js"></script>
<script src="/Public/js/login.js"></script>
<script>
    $(document).keypress(function(event){
        if(event.keyCode ==13){
            $("button").trigger("click");
        }
    });
</script>
</body>
</html>