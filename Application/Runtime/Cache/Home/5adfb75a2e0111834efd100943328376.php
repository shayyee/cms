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
    <h3 style="margin-top:20px;"><?php echo ($hw["title"]); ?></h3>
    <div style="margin-top:20px;border:1px solid #ccc;padding:30px;background-color:rgba(204,202,202,0.3)">
        <h3 style="margin-bottom:10px;">作业内容</h3>
        <p><?php echo ($hw["content"]); ?></p>
    </div>
    <?php if($dhw["status"] == 1): ?><div style="margin-top:20px;border:1px solid #ccc;padding:30px;background-color:rgba(204,202,202,0.3)">
            <h3 style="margin-bottom:10px;">教师评分</h3>
            <p style="color: red;"><?php echo ($dhw["comment"]); ?></p>
            <p>得分：<b><?php echo ($dhw["score"]); ?></b></p>
        </div><?php endif; ?>
    <div style="margin-top:20px;">
        <h3 style="margin-bottom:20px;">你的回答</h3>
        <form id="singcms-form">
            <?php if($dhw["status"] == 0): ?><textarea class="input js-editor" id="editor_singcms" name="content" style="width:100%;height:300px;"><?php echo ($dhw["content"]); ?></textarea>
                <?php else: ?>
                <p><?php echo ($dhw["content"]); ?></p><?php endif; ?>
            <div style="margin-top: 10px;">
                <?php if($dhw["status"] == 0): ?><label for="file_upload_hw">上传作业附件（最大不超过5GB）：</label><?php endif; ?>
                <?php if($dhw["path"] != null): ?><a style="color:red;" href="<?php echo ($dhw["path"]); ?>" download>下载我的作业</a><?php endif; ?>
                <?php if($dhw["status"] == 0): ?><input id="file_upload"  type="file">
                    <input id="file_upload_hw" name="path" type="hidden" value=""><?php endif; ?>
            </div>
            <input name="dhw_id" type="text" hidden value="<?php echo ($dhw["dhw_id"]); ?>">
            <input name="endtime" type="text" hidden value="<?php echo ($hw["endtime"]); ?>">
            <div style="text-align:center;">
                <?php if($dhw["status"] == 0): ?><button type="button" class="btn btn-primary" id="singcms-button-submit">提交修改</button><?php endif; ?>
            </div>
        </form>
    </div>
</section>
</body>
<script src="/Public/js/layer.js"></script>
<script src="/Public/js/dialog.js"></script>
<script src="/Public/js/kindeditor/kindeditor-all.js"></script>
<script type="text/javascript" src="/Public/js/uploadify/jquery.uploadify.js"></script>
<script>
    // 6.2
    var SCOPE = {
        'save_url' : '/Home/Donehw/save',
        'jump_url' : '/Home/Donehw/index.html',
        'ajax_upload_hw_url' : '/Home/Upload/uploadhw',
        'ajax_upload_swf' : '/Public/js/uploadify/uploadify.swf',
    }
    KindEditor.ready(function(K) {
        window.editor = K.create('#editor_singcms',{
            uploadJson : '/Home/Upload/uploadkindeditor',
            afterBlur : function(){this.sync();}, //
        });
    });

    $(function() {
        $('#file_upload').uploadify({
            'swf'      : SCOPE.ajax_upload_swf,
            'uploader' : SCOPE.ajax_upload_hw_url,
            'buttonText': '选择本地文件',
            'fileTypeDesc': 'All Files',
            'fileObjName' : 'file',
            'removeTimeout' : 10,
            'fileSizeLimit' : '5GB',
            'onUploadSuccess' : function(file,data,response) {
                // response true ,false
                if(response) {
                    var obj = JSON.parse(data); //由JSON字符串转换为JSON对象
                    $('#' + file.id).find('.data').html(' 上传完毕');
                    $("#file_upload_hw").attr('value',obj.data);
                }else{
                    alert('上传失败');
                }
            },
        });

    });

    $("#singcms-button-submit").click(function(){
        var data = $("#singcms-form").serializeArray();
        var postData = {};
        $(data).each(function(i){
            postData[this.name] = this.value;
        });
        console.log(postData);
        // 将获取到的数据post给服务器
        url = SCOPE.save_url;
        jump_url = SCOPE.jump_url;
        $.post(url,postData,function(result){
            if(result.status == 1) {
                //成功
                return dialog.success(result.message,jump_url);
            }else if(result.status == 0) {
                // 失败
                return dialog.error(result.message);
            }
        },"JSON");
    });
</script>
</html>