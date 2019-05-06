<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
<body>

<div id="wrapper">

    <?php
 $username = getLoginUsername(); ?>

<nav class="navbar navbar-default top-navbar" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle waves-effect waves-dark" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand waves-effect waves-dark" href="<?php echo U('Index/index');?>"><i class="large material-icons">insert_chart</i> <strong>作业管理系统</strong></a>

        <div id="sideNav" href=""><i class="material-icons dp48">toc</i></div>
    </div>

    <ul class="nav navbar-top-links navbar-right">
        <li>
            <a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown1"><i class="fa fa-user fa-fw"></i> <b><?php echo ($username); ?></b> <i class="material-icons right">arrow_drop_down</i></a>
        </li>
    </ul>
</nav>
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
    <li>
        <?php if($usertype == 1): ?><a href="<?php echo U('Manager/personal');?>"><i class="fa fa-gear fa-fw"></i>个人中心</a>
            <?php else: ?>
            <a href="<?php echo U('Teacher/personal');?>"><i class="fa fa-gear fa-fw"></i>个人中心</a><?php endif; ?>
    </li>
    <li>
        <a href="<?php echo U('Login/logout');?>"><i class="fa fa-sign-out fa-fw"></i>退出</a>
    </li>
</ul>

    <!--/. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <li>
                    <a href="<?php echo U('Donehw/index');?>" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>已交作业</a>
                <li>
                <li>
                    <a href="<?php echo U('Homework/add');?>" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>发布作业</a>
                <li>
                <li>
                    <a href="<?php echo U('Homework/index');?>" class="active-menu waves-effect waves-dark"><i class="fa fa-sitemap"></i>作业列表</a>
                <li>
                <li>
                    <a href="<?php echo U('Share/index');?>" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>共享资料</a>
                <li>
            </ul>

        </div>

    </nav>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="<?php echo U('Homework/index');?>">作业列表</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i>编辑
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-6">

                    <form class="form-horizontal" id="singcms-form" style="margin-top: 0">
                        <div class="form-group">
                            <label for="inputtitle" class="col-sm-2 control-label">作业标题:</label>
                            <div class="col-sm-5">
                                <input type="text" name="title" class="form-control" id="inputtitle" value="<?php echo ($vo["title"]); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="classname" class="col-sm-2 control-label">所属班级:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="classid" id="classname" style="height:40px;">
                                    <?php if(is_array($classes)): foreach($classes as $key=>$c): ?><option value="<?php echo ($c["class_id"]); ?>" <?php if($c['class_id'] == $vo['class_id']): ?>selected="selected"<?php endif; ?>><?php echo ($c["classname"]); ?></option><?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editor_singcms" class="col-sm-2 control-label">内容:</label>
                            <div class="col-sm-5">
                                <textarea class="input js-editor" id="editor_singcms" name="content" style="width:700px;height:300px;"><?php echo ($vo["content"]); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endtime" class="col-sm-2 control-label">截止时间:</label>
                            <div class="col-sm-5">
                                <input value="<?php echo (date('Y-m-d H:i:s',$vo["endtime"])); ?>" id="endtime" name="endtime" readonly class="laydate-icon" style="width:230px;">
                            </div>
                        </div>

                        <input type="hidden" name="hw_id" value="<?php echo ($vo["hw_id"]); ?>"/>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-primary" id="singcms-button-submit">提交</button>
                            </div>
                        </div>
                    </form>


                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<script>
    var SCOPE = {
        'save_url' : '/Admin/Homework/save',
        'jump_url' : '/Admin/Homework/index.html',
    };

</script>
<script src="/Public/js/kindeditor/kindeditor-all.js"></script>
<script src="/Public/js/laydate/laydate.js"></script>
<script>
    // 6.2
    KindEditor.ready(function(K) {
        window.editor = K.create('#editor_singcms',{
            uploadJson : '/Admin/Upload/uploadkindeditor',
            afterBlur : function(){this.sync();}, //
        });
    });
</script>
<script>
    laydate({
        elem: '#endtime', //目标元素。由于laydate.js封装了一个轻量级的选择器引擎，因此elem还允许你传入class、tag但必须按照这种方式 '#id .class'
        event: 'focus', //响应事件。如果没有传入event，则按照默认的click
        format: 'YYYY-MM-DD hh:mm:ss', //日期格式
        istime: true, //是否开启时间选择
    });
    laydate.skin('molv');
</script>
<!-- /#wrapper -->

<!-- Bootstrap Js -->
<script src="/Public/js/bootstrap.min.js"></script>

<script src="/Public/js/materialize.min.js"></script>

<!-- Metis Menu Js -->
<script src="/Public/js/jquery.metisMenu.js"></script>
<!-- Custom Js -->
<script src="/Public/js/custom-scripts.js"></script>
<script src="/Public/js/common.js"></script>
</body>
</html>