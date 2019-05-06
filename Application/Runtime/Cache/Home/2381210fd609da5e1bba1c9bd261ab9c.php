<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>个人中心</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="/Public/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/ucenter.css"/>
    <script src="/Public/js/jquery-3.1.0.js"></script>
    <script src="/Public/js/layer.js"></script>
    <script src="/Public/js/dialog.js"></script>
    <!--[if lt IE 9]>
    <script src="http://nt1.268xue.com/static/common/html5.js?v=1486227637308"></script><![endif]-->
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
            <aside>
                <img id="userImgId" src="/Public/img/user_default.jpg" height="100" width="100" alt="">
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
                    <dt class="active">
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
                    <dt>
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
                            <a href="" title="">我的班级</a>
                        </li>
                    </ul>
                    <div style="display: inline-block;float: right;font-size: 18px;">
                        <a style="color:orangered" href="/Home/Class/index.html">去找班级</a>
                    </div>
                    <div class="clear"></div>
                </section>
                <div class="mt20" id="uTabCont">
                    <article id="newFreeSellWayListUlId" class="indexTab" style="display: block;">
                        <section class="ml20 mr20">
                            <div>
                                <ul class="u-buying-list u-collect-list">
                                    <?php if(is_array($classes)): $i = 0; $__LIST__ = $classes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                            <section class="fl u-c-img pr u-c-img-tc">
                                                <?php if($vo["picpath"] != null): ?><img src="<?php echo ($vo["picpath"]); ?>" class="dis">
                                                    <?php else: ?><img src="/Public/img/class_default.png" class="dis"><?php endif; ?>
                                            </section>
                                            <h6 class="hLh20 of unFw mt10">
                                                <a class="c-4e fsize18 f-fM" title="<?php echo ($vo["classname"]); ?>" href="/Home/Class/detail.html?id=<?php echo ($vo["class_id"]); ?>"><?php echo (delBrackets($vo["classname"])); ?></a>
                                            </h6>
                                            <div class="hLh20 of mt10">
                                                <span class="vam c-999 fsize14">教师：</span>
                                                <span class="vam u-m-c-teacher fsize14"><?php echo ($vo["realname"]); ?></span>
                                            </div>
                                            <div class="hLh20 of mt10">
                                                <span class="vam c-999 fsize16">学院：</span>
                                                <span class="vam u-m-c-teacher fsize16"><?php echo ($vo["college"]); ?></span>
                                            </div>
                                            <div>
                                                <input type="text" hidden value="<?php echo ($vo["class_id"]); ?>">
                                                <button class="btn btn-primary study" style="float:right;padding: 5px 15px;">进入班级</button>
                                            </div>

                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <?php if($classes == null): ?><li style="height:180px;width:200px;margin:0;background-color: #fff; float: left;zoom:1;letter-spacing:0;overflow:hidden;border:1px solid #dbdbdb;background: #f3f3f3;">
                                            <div class="">
                                                <a href="/Home/Class/index.html" class="Mdelc2dt"
                                                   title="添加课程"><span></span></a>
                                            </div>
                                        </li><?php endif; ?>
                                </ul>
                            </div>
                            <ul class="pagination">
                                <?php echo ($pageRes); ?>
                            </ul>
                        </section>
                    </article>
                </div>
            </section>
        </article>
    </div>
</section>
<script src="/Public/js/common.js"></script>
<script>
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
    $('.study').click(function () {
        var classid = $(this).prev().val();
        window.location.href = '/Home/Class/detail.html?id='+classid;
    })
    $('#userImgId').click(function () {
        window.location.href = '/Home/Index/statics.html';
    });
</script>
</body>

</html>