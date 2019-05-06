<?php if (!defined('THINK_PATH')) exit();?>
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
                    <a href="<?php echo U('Config/index');?>" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>系统设置</a>
                </li>
                <li>
                    <a href="<?php echo U('Manager/index');?>" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>管理员管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Teacher/index');?>" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>教师管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Student/index');?>" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>学生管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Class/index');?>" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>班级管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Course/index');?>" class="active-menu waves-effect waves-dark"><i class="fa fa-sitemap"></i>课程管理</a>
                </li>
                <!--<li>-->
                    <!--<a href="<?php echo U('Share/index');?>" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>共享资料管理</a>-->
                <!--</li>-->
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
                            <i class="fa fa-dashboard"></i>
                            <a href="<?php echo U('Course/index');?>">课程管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i> 添加
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-6">

                    <form class="form-horizontal" id="singcms-form">
                        <div class="form-group">
                            <label for="inputcno" class="col-sm-2 control-label">课号:</label>
                            <div class="col-sm-5">
                                <input type="text" name="cno" class="form-control" id="inputcno" placeholder="请填写课号">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputcname" class="col-sm-2 control-label">课程名:</label>
                            <div class="col-sm-5">
                                <input type="text" name="cname" class="form-control" id="inputcname" placeholder="请填写课程名"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file_upload" class="col-sm-2 control-label">课程封面:</label>
                            <div class="col-sm-5">
                                <input id="file_upload"  type="file">
                                <img style="display: none" id="upload_org_code_img" src="" width="150" height="150">
                                <input id="file_upload_image" name="pic" type="hidden" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="selecttname" class="col-sm-2 control-label">任课老师:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="tid" id="selecttname" style="height:44px;">
                                    <?php if(is_array($teachers)): foreach($teachers as $key=>$t): ?><option value="<?php echo ($t["t_id"]); ?>"><?php echo ($t["realname"]); ?></option><?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>

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
<!-- /#wrapper -->
<!-- Morris Charts JavaScript -->

<script>
    var SCOPE = {
        'save_url' : '/Admin/Course/add',
        'jump_url' : '/Admin/Course',
        'ajax_upload_image_url' : '/Admin/Upload/ajaxuploadimage',
        'ajax_upload_swf' : '/Public/js/uploadify/uploadify.swf',
    }
</script>
<script type="text/javascript" src="/Public/js/uploadify/jquery.uploadify.js"></script>
<script type="text/javascript" src="/Public/js/image.js"></script>
<script>
    $('#inputcno').blur(function () {
        var reg_cno = /^[0-9a-zA-Z]*$/g;
        var val = $(this).val();
        if(val==''){
            layer.tips('课号不能为空', ":input[name='cno']");
            return false;
        }
        if(val && !reg_cno.test(val)){
            layer.tips('课号由字母或数字组成', ":input[name='cno']");
            return false;
        }
    });
    $('#inputcname').blur(function () {
        var val = $(this).val();
        if(val==''){
            layer.tips('课程名不能为空', ":input[name='cname']");
            return false;
        }
    });
</script>

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