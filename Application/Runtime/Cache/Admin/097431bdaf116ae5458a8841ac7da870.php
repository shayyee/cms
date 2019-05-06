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
                    <a href="<?php echo U('Config/index');?>" class="active-menu waves-effect waves-dark"><i
                            class="fa fa-sitemap"></i>系统设置</a>
                </li>
                <li>
                    <a href="<?php echo U('Manager/index');?>" class="waves-effect waves-dark"><i
                            class="fa fa-sitemap"></i>管理员管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Teacher/index');?>" class="waves-effect waves-dark"><i
                            class="fa fa-sitemap"></i>教师管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Student/index');?>" class="waves-effect waves-dark"><i
                            class="fa fa-sitemap"></i>学生管理</a>
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
                            <i class="fa fa-dashboard"></i> <a href="<?php echo U('Config/index');?>">系统管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Buckets管理
                        </li>
                    </ol>
                </div>
            </div>


            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="oss">
                    <table class="table table-bordered table-hover singcms-table">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>bucket</th>
                            <th>endpoint</th>
                            <th>weight</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($buckets)): $i = 0; $__LIST__ = $buckets;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>

                                <td><?php echo ($vo["bucket_id"]); ?></td>
                                <td><input type="text" value="<?php echo ($vo["bucketname"]); ?>"></td>
                                <td><input type="text" value="<?php echo ($vo["endpoint"]); ?>"></td>
                                <td><input type="text" value="<?php echo ($vo["weight"]); ?>"></td>
                                <td>
                                    <button class="btn btn-primary">修改</button>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>


        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <!-- Morris Charts JavaScript -->
</div><!-- /. WRAPPER  -->
<script>

    $('.btn').click(function () {
        var url = '/Admin/Config/bucket';
        var data = {
            'id': $(this).parents('tr').children().eq(0).text(),
            'name': $(this).parents('tr').children().eq(1).children().val(),
            'endpoint': $(this).parents('tr').children().eq(2).children().val(),
            'weight': $(this).parents('tr').children().eq(3).children().val(),
        }
//        console.log(data);
        $.post(url,data,function(result){
            if(result.status == 1) {
                //成功
                return dialog.success(result.message,'/Admin/Config/bucket.html');
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