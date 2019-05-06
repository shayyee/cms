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
                            <i class="fa fa-dashboard"></i> <a href="<?php echo U('Teacher/index');?>">教师管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i><?php echo ($nav); ?>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="h_a">搜索</div>
            <div class="search_type cc mb10">
                <form action="<?php echo U('Admin/Teacher/index');?>" method="POST">
                    <ul>
                        <li><label>用户名</label><input name="username" type="text" class="input length_2 mr10"></li>
                        <li><label>真实姓名</label><input name="realname" type="text" class="input length_2 mr10"></li>
                        <li><button type="submit" class="btn btn_submit">搜索</button>
                    </ul>
                </form>
            </div>
            <div>
                <button  id="button-add" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
                </button>
                <button  id="button-import" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>批量导入
                </button>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h3></h3>
                    <div class="table-responsive">
                        <form id="singcms-listorder">
                            <table class="table table-bordered table-hover singcms-table">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>用户名（工号）</th>
                                    <th>真实姓名</th>
                                    <th>QQ号</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($teachers)): $i = 0; $__LIST__ = $teachers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                        <td><?php echo ($vo["t_id"]); ?></td>
                                        <td><?php echo ($vo["username"]); ?></td>
                                        <td><?php echo ($vo["realname"]); ?></td>
                                        <td><?php echo ($vo["qq"]); ?></td>
                                        <td>
                                            <a href="javascript:void(0)" attr-id="<?php echo ($vo["t_id"]); ?>" id="singcms-edit" attr-a="teacher" attr-message="编辑">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            </a>
                                            <a href="javascript:void(0)" attr-id="<?php echo ($vo["t_id"]); ?>" id="singcms-delete"  attr-a="teacher" attr-message="删除">
                                                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            <ul class="pagination">
                                <?php echo ($pageRes); ?>
                            </ul>

                        </form>

                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <!-- Morris Charts JavaScript -->
</div><!-- /. WRAPPER  -->
<script>
    var SCOPE = {
        'add_url':'/Admin/Teacher/add',
        'edit_url' : '/Admin/Teacher/edit',
        'delete_url' : '/Admin/Teacher/delete',
        'import_url' : '/Admin/Teacher/import',
        'index_url' : '/Admin/Teacher',
    };
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