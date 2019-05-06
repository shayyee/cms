<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>作业管理系统学生登陆</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript"> addEventListener("load", function () {
        setTimeout(hideURLbar, 0);
    }, false);
    function hideURLbar() {
        window.scrollTo(0, 1);
    } </script>
    <link href="/Public/css/login1.css" rel='stylesheet' type='text/css'/>
    <!--//webfonts-->
    <script src="/Public/js/jquery-3.1.0.js"></script>
</head>
<body>
<script>$(document).ready(function (c) {
    $('.close').on('click', function (c) {
        $('.login-form').fadeOut('slow', function (c) {
            $('.login-form').remove();
        });
    });
});
</script>
<!--SIGN UP-->
<div class="container">
    <h1>学生登陆</h1>
    <div class="login-form">
        <div class="head-info"></div>
        <div class="clear"></div>
        <div class="avtar">
            <img src="/Public/img/avtar.png"/>
        </div>
        <form method="post">
            <input name="username" type="text" class="text" placeholder="学号" onfocus="this.value = '';">
            <div class="key">
                <input name="password" type="password" placeholder="密码" onfocus="this.value = '';">
            </div>
        </form>
        <div class="signin">
            <button type="button" onclick="login.check('/Home/Index/check','/Home/Index/index.html')">Login</button>
        </div>
    </div>
</div>
<script src="/Public/js/layer.js"></script>
<script src="/Public/js/dialog.js"></script>
<script src="/Public/js/login.js"></script>
<script>
    $(document).keypress(function(event){
        if(event.keyCode ==13){
            $("button").trigger("click");
        }
    });
    //使内容保持居中
    $(document).ready(function(){
        $(".container").css({
            left: ($(window).width() - $(".container").outerWidth())/2,
            top: ($(window).height() - $(".container").outerHeight())/2
        });
        $(window).resize(function(){
            $(".container").css({
                left: ($(window).width() - $(".container").outerWidth())/2,
                top: ($(window).height() - $(".container").outerHeight())/2
            });
        });

    });
</script>
</body>
</html>