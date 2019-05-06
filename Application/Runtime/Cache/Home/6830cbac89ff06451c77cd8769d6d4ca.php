<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>个人中心</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="/Public/css/common.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/ucenter.css" />
    <script src="/Public/js/jquery-3.1.0.js"></script>
    <script src="/Public/js/layer.js"></script>
    <script src="/Public/js/dialog.js"></script>
    <!--[if lt IE 9]><script src="http://nt1.268xue.com/static/common/html5.js?v=1486227637308"></script><![endif]-->
</head>

<body class="W-body U-body">

<?php
 $realname = getLoginRealname(); ?>

<header id="u-header">
    <section class="w1000">
        <div class="u-h-left">
            <section class="u-logo-slogn">
                <a href="/Home/Index/index.html" title="" class="u-logo">
                    <img src="/Public/img/logo1.png" alt="">
                </a>
						<span class="u-slogn" style="cursor: pointer;vertical-align: top;" onclick="location.href='/Home/Index/index.html'">
							<strong class="c-master">个人空间</strong>
						</span>
            </section>
        </div>
        <div class="u-h-right">
            <section class="u-h-r-user">
                <div class="tar">
                    <span class="u-h-name-wrap">你好，</span>
                    <span class="u-h-name" id="unameheader"><?php echo ($realname); ?></span>
                    <span><a href="<?php echo U('Index/logout');?>" title="退出" class="c-666">退出</a></span>
                </div>
            </section>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </section>
</header>

<section class="u-banner">
    <a href="javascript:void(0)" class="u-tem-change"></a>
    <div id="uPosition">&nbsp;</div>
</section>
<section id="u-main">
    <menu class="u-m-left">
        <div class="u-elephant of">
            <aside class=""> <img id="userImgId" src="/Public/img/user_default.jpg" height="100" width="100" alt="">

            </aside>
            <div class="u-elephant-bg"></div>
        </div>
        <section class="uMenuFixed">
            <div class="u-menu-head">
                <a href="javascript:;" title="个人空间">
                    <em class="icon-2-18 u-m-icon-1">&nbsp;</em>
                    <strong class="c-fff ml5 fsize18 vam">个人空间</strong>
                </a>
            </div>
            <div class="u-menu-list">
                <dl id="leftdl_1">
                    <dt>
                        <em class="icon-2-18 u-m-icon-6">&nbsp;</em>
                        <span class="c-333 ml10 fsize16 vam">作业任务</span>
                        <em class="icon-2-14 u-up-down ml15">&nbsp;</em>
                    </dt>
                </dl>
                <dl id='leftdl_2'>
                    <dt>
                        <em class="icon-2-18 u-m-icon-8">&nbsp;</em>
                        <span class="c-333 ml10 fsize16 vam">我的班级</span>
                        <em class="icon-2-14 u-up-down ml15">&nbsp;</em>
                    </dt>
                </dl>
                <dl id="leftdl_3">
                    <dt>
                        <em class="icon-2-18 u-m-icon-6">&nbsp;</em>
                        <span class="c-333 ml10 fsize16 vam">已交作业</span>
                        <em class="icon-2-14 u-up-down ml15">&nbsp;</em>
                    </dt>
                </dl>
                <dl id="leftdl_4">
                    <dt class="active">
                        <em class="icon-2-18 u-m-icon-6">&nbsp;</em>
                        <span class="c-333 ml10 fsize16 vam">修改密码</span>
                        <em class="icon-2-14 u-up-down ml15">&nbsp;</em>
                    </dt>
                </dl>
            </div>
        </section>
        <input type="hidden" id="ctx" value="http://nt1.268xue.com">
    </menu>
    <div class="clearfix">
        <article class="u-m-c-w837 u-m-center">
            <section class="u-m-c-wrap">
                <section class="u-m-c-head">
                    <ul class="fl u-m-c-h-txt">
                        <li class="current">
                            <a href="" title="">个人信息</a>
                        </li>
                    </ul>
                    <div class="clear"></div>
                </section>
                <section class="line1">
                    <form class="form-horizontal" id="singcms-form">
                        <div class="mt50">
                            <ol class="u-account-set">
                                <li>
                                    <span class="vam u-a-lab">姓名：</span>
                                    <label class="u-a-txt">
                                        <input type="text" name="realname" value="<?php echo ($user["realname"]); ?>" disabled>
                                    </label>
                                </li>
                                <li>
                                    <span class="vam u-a-lab">学号：</span>
                                    <label class="u-a-txt">
                                        <input type="text" name="sno" value="<?php echo ($user["sno"]); ?>" disabled>
                                    </label>
                                </li>
                                <li>
                                    <span class="vam u-a-lab">密码：</span>
                                    <label class="u-a-txt">
                                        <input id="password" name="password" type="password" value="<?php echo ($user["password"]); ?>" onfocus="this.value = '';">
                                    </label>
                                </li>
                                <input type="hidden" name="id" value="<?php echo ($user["s_id"]); ?>"/>
                                <li style="text-align: center;">
                                    <button type="button" class="btn btn-primary" id="singcms-button-submit">保存</button>
                                </li>
                            </ol>
                        </div>
                    </form>
                </section>
            </section>
        </article>
    </div>
</section>
<script src="/Public/js/common.js"></script>
<script>
    var SCOPE = {
        'save_url' : '/Home/User/save',
        'jump_url' : '/Home/Index/index.html'
    };
    $('#leftdl_1').click(function () {
        window.location.href = '/Home/Index/index.html';
    });
    $('#leftdl_2').click(function () {
        window.location.href = '/Home/Mycourse/index.html';
    });
    $('#leftdl_3').click(function () {
        window.location.href = '/Home/Donehw/index.html';
    });
    $('#leftdl_4').click(function () {
        window.location.href = '/Home/User/index.html';
    });
    $('#userImgId').click(function () {
        window.location.href = '/Home/Index/statics.html';
    });
</script>
</body>

</html>