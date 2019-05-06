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
                    <a href="<?php echo U('Homework/index');?>" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>作业列表</a>
                <li>
                <li>
                    <a href="<?php echo U('Share/index');?>" class="active-menu waves-effect waves-dark"><i class="fa fa-sitemap"></i>共享资料</a>
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
                            <i class="fa fa-dashboard"></i> <a href="<?php echo U('Share/index');?>">我的共享资料</a>
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
                <form action="<?php echo U('Admin/Share/index');?>" method="POST">
                    <ul>
                        <li><label>名称</label><input name="name" type="text" class="input length_2 mr10"></li>
                        <li><button type="submit" class="btn btn_submit">搜索</button>
                    </ul>
                </form>
            </div>
            <div>
                <button id="button-add" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>上传共享资料
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
                                    <th>名称</th>
                                    <th>所属课程</th>
                                    <th>上传时间</th>
                                    <th>文件大小</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($shares)): $i = 0; $__LIST__ = $shares;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>

                                        <td><?php echo ($vo["share_id"]); ?></td>
                                        <td><?php echo ($vo["filename"]); ?></td>
                                        <td><?php echo ($vo["name"]); ?></td>
                                        <td><?php echo ($vo["create_time"]); ?></td>
                                        <td><?php echo (formatBytes($vo["size"])); ?></td>
                                        <td><span  attr-status="<?php if($vo['status'] == 1): ?>0<?php else: ?>1<?php endif; ?>"  attr-id="<?php echo ($vo["share_id"]); ?>" class="sing_cursor singcms-on-off" id="singcms-on-off" ><?php echo (status($vo["status"])); ?></span></td>
                                        <td>
                                            <a href="javascript:void(0)" attr-id="<?php echo ($vo["share_id"]); ?>" id="singcms-edit" attr-a="Homework" attr-message="编辑">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            </a>
                                            <a href="javascript:void(0)" attr-id="<?php echo ($vo["share_id"]); ?>" id="singcms-delete"  attr-a="Homework" attr-message="删除">
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
                        <!--<div>-->
                        <!--<button id="singcms-button-back" class="btn btn-default">返回</button>-->
                        <!--</div>-->

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
        'add_url':'/Admin/Share/add.html',
        'edit_url' : '/Admin/Share/edit.html',
        'delete_url' : '/Admin/Share/delete',
        'index_url' : '/Admin/Share/index.html',
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