<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>个人中心</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="/Public/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/ucenter.css"/>
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
            <aside class=""><img id="userImgId" src="/Public/img/user_default.jpg" height="100" width="100" alt="">

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
                    <dt class="active">
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
                            <a href="javascript:void(0)" title="">作业任务</a>
                        </li>
                    </ul>
                    <div class="clear"></div>
                </section>
                <section class="line1">
                    <!--若无学习记录-->
                    <?php if($donehws == null): ?><div style="margin-top:80px">
                            <div style="background: url('/Public/img/nothing.png') center no-repeat;height:260px;"></div>
                            <h2 style="text-align:center;padding-left:40px;font-size:16px;">好好学习，天天向上！</h2>
                        </div><?php endif; ?>
                    <!--作业列表-->
                    <?php if($donehws != null): ?><table class="table table-bordered table-hover singcms-table">
                            <thead>
                            <tr>
                                <th>作业</th>
                                <th>所属班级</th>
                                <th>更新日期</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($donehws)): $i = 0; $__LIST__ = $donehws;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>

                                    <td><?php echo ($vo["title"]); ?></td>
                                    <td><?php echo ($vo["classname"]); ?></td>
                                    <td><?php echo ($vo["updatetime"]); ?></td>
                                    <?php if($vo["status"] == 1): ?><td style="color: red;">已批改</td>
                                        <?php else: ?><td>已完成</td><?php endif; ?>
                                    <td>
                                        <input type="text" hidden value="<?php echo ($vo["dhw_id"]); ?>">
                                        <button type="button" class="btn btn-primary">查看</button>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <?php echo ($pageRes); ?>
                        </ul><?php endif; ?>
                </section>
            </section>
        </article>
    </div>
</section>
<script src="/Public/js/jquery-3.1.0.js" type="text/javascript" charset="utf-8"></script>
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
</script>
<script>
    $('.btn').click(function () {
        var hw_id = $(this).prev().val();
        window.location.href = '/Home/Donehw/detail.html?id=' + hw_id;
    })
    $('#userImgId').click(function () {
        window.location.href = '/Home/Index/statics.html';
    });
</script>
</body>

</html>