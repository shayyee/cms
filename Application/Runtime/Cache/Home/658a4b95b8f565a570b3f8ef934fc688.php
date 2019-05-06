<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>个人中心</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/Public/css/custom-styles.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/ucenter.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/search.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/uploadify.css">
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
<section class="c-main1" style="margin-bottom: 45px">
    <div style="margin-top:10px;border:1px solid #ccc;padding:30px;">
        <h3 style="margin-bottom: 10px;">共享资料
            <span style="float: right">
                <b>有问题就请教老师吧</b>
                <a target=blank href="tencent://message/?uin=<?php echo ($teacher["qq"]); ?>&Site=<?php echo ($teacher["realname"]); ?>&Menu=yes">
                    <img border="0" src="http://wpa.qq.com/pa?p=1:958662806:6">
                </a>
            </span>
        </h3>
        <?php if($shares != null): ?><table class="table table-bordered table-hover singcms-table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>名称</th>
                    <th>上传时间</th>
                    <th>文件大小</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($shares)): $i = 0; $__LIST__ = $shares;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>

                        <td><?php echo ($vo["share_id"]); ?></td>
                        <td id="filename"><?php echo ($vo["filename"]); ?></td>
                        <td><?php echo ($vo["create_time"]); ?></td>
                        <td><?php echo (formatBytes($vo["size"])); ?></td>
                        <td>
                            <input type="text" value="<?php echo ($vo["path"]); ?>" hidden>
                            <button id="download" class="btn btn-primary">下载</button>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <ul class="pagination">
                <?php echo ($pageRes); ?>
            </ul>
            <?php else: ?>
            <div style="margin-top:80px">
                <div style="background: url('/Public/img/nothing.png') center no-repeat;height:260px;"></div>
                <h2 style="text-align:center;padding-left:40px;font-size:16px;">暂无共享资料</h2>
            </div><?php endif; ?>
    </div>
</section>
</body>
<script src="/Public/js/layer.js"></script>
<script src="/Public/js/dialog.js"></script>
<script>
    $('#download').click(function () {
        var url = '/Admin/Upload/downloadshare';
        var filename = $('#filename').text();
        var _this = this;
        $.post(url,{
            info:$(this).prev().val()
        },function(result){
            if(result.status == 1) {
                //成功
                $(_this).after("<a id='url' download style='display:none;' href='"+result.data+"'><p id='down'>url</p></a>");
                $('#down').trigger('click');
                $('#url').remove();
            }else if(result.status == 0) {
                // 失败
                return dialog.error(result.message);
            }
        },"JSON");
    });
</script>
</html>