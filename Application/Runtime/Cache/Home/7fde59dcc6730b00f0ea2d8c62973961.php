<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>个人中心</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/Public/css/custom-styles.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/Public/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/ucenter.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/search.css"/>
    <script src="/Public/js/jquery-3.1.0.js"></script>
    <!--[if lt IE 9]>
    <script src="http://nt1.268xue.com/static/common/html5.js?v=1486227637308"></script><![endif]-->
</head>

<body class="W-body U-body" style="background: none;">

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
<section class="c-main" style="margin-bottom: 45px">
    <form method="post" action="/Home/Class/index" style="width:487px;height:34px;margin:40px auto 0 auto;">
        <div id="searchTxt" class="searchTxt" onMouseOver="this.className='searchTxt searchTxtHover';"
             onMouseOut="this.className='searchTxt';">
            <input id="search" name="searchTx" type="text" placeholder="请输入班级名、课程名、课号或授课老师"/>
        </div>
        <div class="searchBtn">
            <button id="searchBtn" type="submit">找班级</button>
        </div>
    </form>
</section>
<section class="c-main1">
    <div>
        <ul class="u-buying-list u-collect-list">
            <?php if(is_array($classes)): $i = 0; $__LIST__ = $classes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    <section class="fl u-c-img pr u-c-img-tc">
                        <?php if($vo["picpath"] != null): ?><img src="<?php echo ($vo["picpath"]); ?>" class="dis">
                            <?php else: ?><img src="/Public/img/class_default.png" class="dis"><?php endif; ?>
                    </section>
                    <h6 class="hLh20 of unFw mt10">
                        <a class="c-4e fsize18 f-fM" title="<?php echo ($vo["classname"]); ?>" href=""><?php echo (delBrackets($vo["classname"])); ?></a>
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
                        <button class="btn btn-primary join" style="float:right">加入班级</button>
                    </div>

                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <ul class="pagination">
        <?php echo ($pageRes); ?>
    </ul>
</section>
</body>
<script src="/Public/js/layer.js"></script>
<script src="/Public/js/dialog.js"></script>
<script>
    var url = '/Home/Sc/join';
    $('.join').click(function () {
        var class_id = $(this).prev().val();
        var _this = this;
        $.post(url,{'class_id':class_id},function(result){
            if(result.status == 1) {
                //成功
                dialog.success_f(result.message,function () {
                    $(_this).text('已加入');
                    $(_this).removeClass("btn-primary");
                    $(_this).addClass("btn-success");
                    layer.close(layer.index);
                });
            }else if(result.status == 0) {
                // 失败
                dialog.error_f(result.message,function () {
                    $(_this).text('已加入');
                    $(_this).removeClass("btn-primary");
                    $(_this).addClass("btn-success");
                    layer.close(layer.index);
                });
            }
        },"JSON");
    })
</script>
</html>