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
                    <a href="<?php echo U('Teacher/index');?>" class="active-menu waves-effect waves-dark"><i class="fa fa-sitemap"></i>教师管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Student/index');?>" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>学生管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Class/index');?>" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>班级管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Course/index');?>" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>课程管理</a>
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
                        <a href="<?php echo U('Teacher/index');?>">教师管理</a>
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
                        <label for="inputname" class="col-sm-2 control-label">用户名:</label>
                        <div class="col-sm-5">
                            <input type="text" name="username" class="form-control" id="inputname" placeholder="请填写用户名">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputpassword" class="col-sm-2 control-label">密码:</label>
                        <div class="col-sm-5">
                            <input type="password" name="password" class="form-control" id="inputpassword" placeholder="请填写密码"/>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="inputrealname" class="col-sm-2 control-label">姓名:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="realname" id="inputrealname" placeholder="请填写真实姓名">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputcollege" class="col-sm-2 control-label">所属学院:</label>
                        <div class="col-sm-5">
                            <input type="text" name="college" class="form-control" id="inputcollege" placeholder="请填写所属学院"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputqq" class="col-sm-2 control-label">QQ号:</label>
                        <div class="col-sm-5">
                            <input type="text" name="qq" class="form-control" id="inputqq" placeholder="请填写QQ号"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-default" id="singcms-button-submit">提交</button>
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
        'save_url' : '/Admin/Teacher/add.html',
        'jump_url' : '/Admin/Teacher/index.html',
    }
</script>
<script>
    $('#inputname').blur(function () {
        var val = $(this).val();
        if(val==''){
            layer.tips('用户名不能为空', ":input[name='cname']");
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