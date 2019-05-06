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

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Home</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/Public/css/materialize.min.css" media="screen,projection" />
    <!-- Bootstrap Styles-->
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="/Public/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="/Public/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="/Public/css/uploadify.css">
    <!-- jQuery Js -->
    <script src="/Public/js/jquery-3.1.0.js"></script>
    <script src="/Public/js/layer.js"></script>
    <script src="/Public/js/dialog.js"></script>
</head>
<section class="c-main1" style="margin-bottom: 45px">
    <h3 style="margin-top:20px;"><?php echo ($hw["title"]); ?></h3>
    <div style="margin-top:20px;border:1px solid #ccc;padding:30px;background-color:rgba(204,202,202,0.3)">
        <h3 style="margin-bottom:10px;">作业内容</h3>
        <p><?php echo ($hw["content"]); ?></p>
    </div>
    <div style="margin-top:20px;border:1px solid #ccc;padding:30px;background-color:rgba(204,202,202,0.3)">
        <h3 style="margin-bottom:20px;">学生答案</h3>
        <p><?php echo ($dhw["content"]); ?></p>
        <div style="margin-top: 10px;">
            <span>作业附件：</span>
            <?php if($dhw["path"] != null): ?><a style="color:red;" href="<?php echo ($dhw["path"]); ?>" download>下载附件</a><?php endif; ?>
        </div>
    </div>
    <div style="margin-top:20px;border:1px solid #ccc;padding:30px;background-color:rgba(204,202,202,0.3)">
        <h3 style="margin-bottom:20px;">评分</h3>
        <form id="singcms-form">
            <div class="form-group">
                <label style="color: black;vertical-align: top;" for="comment">评语：</label>
                <textarea style="width:50%;" id="comment" name="comment"><?php echo ($dhw["comment"]); ?></textarea>
            </div>
            <div class="form-group">
                <label style="color: black;vertical-align: top;" for="score">得分：</label>
                <input id="score" name="score" type="text" value="<?php echo ($dhw["score"]); ?>">
            </div>
            <input name="dhw_id" type="text" hidden value="<?php echo ($dhw["dhw_id"]); ?>">
            <div>
                <button type="button" class="btn btn-primary" id="singcms-button-submit">提交</button>
            </div>
        </form>
    </div>
</section>
</body>
<script src="/Public/js/layer.js"></script>
<script src="/Public/js/dialog.js"></script>
<script>
    // 6.2
    var SCOPE = {
        'save_url' : '/Admin/Donehw/save',
        'jump_url' : '/Admin/Donehw/index.html',
    }

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