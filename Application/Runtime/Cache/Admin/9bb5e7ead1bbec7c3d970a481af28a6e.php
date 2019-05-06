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
                    <a href="<?php echo U('Config/index');?>" class="active-menu waves-effect waves-dark"><i class="fa fa-sitemap"></i>系统设置</a>
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
                            <i class="fa fa-dashboard"></i> <a href="/Admin/Config/index.html">系统管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i><?php echo ($nav); ?>
                        </li>
                    </ol>
                </div>
            </div>


            <ul id="myTab" class="nav nav-tabs">
                <li class="active">
                    <a href="#oss" data-toggle="tab">
                        OSS存储配置
                    </a>
                </li>
                <li>
                    <a href="#basic" data-toggle="tab">
                        基本配置
                    </a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="oss">
                    <form class="form-horizontal" id="singcms-form">
                        <?php if($user == 1): ?><div class="form-group">
                                <label for="inputid" class="col-sm-2 control-label">Access Key ID:</label>
                                <div class="col-sm-5">
                                    <input type="text" name="id" class="form-control" id="inputid" value="<?php echo ($config['key_id']); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputsecret" class="col-sm-2 control-label">Access Key Secret:</label>
                                <div class="col-sm-5">
                                    <input type="password" name="secret" class="form-control" id="inputsecret" value="<?php echo ($config['key_secret']); ?>"/>
                                </div>
                            </div>

                            <!--<div class="form-group">-->
                                <!--<label for="inputendpoint" class="col-sm-2 control-label">End Point:</label>-->
                                <!--<div class="col-sm-5">-->
                                    <!--<input type="text" name="endpoint" class="form-control" id="inputendpoint" value="<?php echo ($config['end_point']); ?>"/>-->
                                <!--</div>-->
                            <!--</div>-->

                            <!--<div class="form-group">-->
                                <!--<label for="inputbucket" class="col-sm-2 control-label">BucketName:</label>-->
                                <!--<div class="col-sm-5">-->
                                    <!--<input type="text" name="bucket" class="form-control" id="inputbucket" value="<?php echo ($config['bucket']); ?>"/>-->
                                <!--</div>-->
                            <!--</div>--><?php endif; ?>
                        <div class="form-group">
                            <label for="inputboot" class="col-sm-2 control-label">文件上传根目录:</label>
                            <div class="col-sm-5">
                                <input type="text" name="boot" class="form-control" id="inputboot" value="<?php echo ($config['upload']); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputavatar" class="col-sm-2 control-label">头像上传目录:</label>
                            <div class="col-sm-5">
                                <input type="text" name="avatar" class="form-control" id="inputavatar" value="<?php echo ($config['avatar']); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputhomework" class="col-sm-2 control-label">作业上传目录:</label>
                            <div class="col-sm-5">
                                <input type="text" name="homework" class="form-control" id="inputhomework" value="<?php echo ($config['homework']); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputshare" class="col-sm-2 control-label">共享资料上传目录:</label>
                            <div class="col-sm-5">
                                <input type="text" name="share" class="form-control" id="inputshare" value="<?php echo ($config['share']); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-primary" id="singcms-button-submit">提交</button>
                                <?php if($user == 1): ?><button type="button" class="btn btn-warning" style="margin-left:26%" id="slbinit">重置负载均衡</button>
                                    <a href="/Admin/Config/bucket.html">管理Buckets</a><?php endif; ?>
                                <!--<a class="btn btn-primary" style="margin-left: 26%;padding-top: 7px;" href="/Admin/Config/bucket.html">负载均衡管理</a>-->
                                <!--<input type="text" name="slb" value="<?php echo ($config['slb']); ?>" hidden>-->
                                <!--<?php if($config['slb'] == 0): ?>-->
                                    <!--<button type="button" class="btn btn-primary" style="margin-left:26%" id="slbopen">开启负载均衡</button>-->
                                    <!--<?php else: ?>-->
                                    <!--<button type="button" class="btn btn-warning" style="margin-left:26%" id="slbclose">关闭负载均衡</button>-->
                                    <!--<a href="/Admin/Config/bucket.html">管理Buckets</a>-->
                                <!--<?php endif; ?>-->
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="basic">
                    <form class="form-horizontal" id="singcms-form1">
                        <!--<div class="form-group">-->
                            <!--<label for="inputissue" class="col-sm-2 control-label">增加开课班次:</label>-->
                            <!--<div class="col-sm-5">-->
                                <!--<input type="text" name="issue" class="form-control" id="inputissue" placeholder="请填写班次（例：2017年春）">-->
                            <!--</div>-->
                        <!--</div>-->

                        <div class="form-group">
                            <label for="inputps" class="col-sm-2 control-label">页面显示条数:</label>
                            <div class="col-sm-5">
                                <input type="text" name="pagesize" class="form-control" id="inputps" placeholder="PageSize" value="<?php echo ($config['pagesize']); ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-primary" id="singcms-button-submit1">提交</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>


        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <!-- Morris Charts JavaScript -->
</div><!-- /. WRAPPER  -->
<script>
    var SCOPE = {
        'save_url' : '/Admin/Config/save',
        'jump_url' : '/Admin/Config/index.html',
    };
    $('#slbinit').click(function () {
        var url = '/Admin/Config/slbinit';
        $.post(url,{
            slb:"init"
        },function(result){
            if(result.status == 1) {
                //成功
                return dialog.success(result.message,SCOPE.jump_url);
            }else if(result.status == 0) {
                // 失败
                return dialog.error(result.message);
            }
        },"JSON");
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