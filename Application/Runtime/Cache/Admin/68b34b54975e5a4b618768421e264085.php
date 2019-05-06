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

            <div class="row">
                <div class="col-lg-6">

                    <form class="form-horizontal" id="singcms-form" style="margin-top: 0">
                        <div class="form-group">
                            <label for="inputtitle" class="col-sm-2 control-label">资料名称:</label>
                            <div class="col-sm-5">
                                <input type="text" name="filename" class="form-control" id="inputtitle" placeholder="请填写资料名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cname" class="col-sm-2 control-label">所属课程:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="courseid" id="cname" style="height:40px;">
                                    <?php if(is_array($courses)): foreach($courses as $key=>$c): ?><option value="<?php echo ($c["course_id"]); ?>"><?php echo ($c["name"]); ?>(<?php echo ($c["cno"]); ?>)</option><?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file_upload" class="col-sm-2 control-label">上传文件:</label>
                            <div class="col-sm-5">
                                <input id="file_upload" type="file">
                                <span style="font-size: 12px;">(请耐心等待上传成功的弹窗提示)</span>
                                <input id="file_upload_share" name="share" type="hidden" value="">
                                <input id="file_size" name="size" type="hidden" value="">
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
        'save_url' : '/Admin/Share/add',
        'jump_url' : '/Admin/Share/index.html',
        'ajax_upload_share_url' : '/Admin/Upload/uploadshare',
        'ajax_upload_swf' : '/Public/js/uploadify/uploadify.swf',
    }
</script>
<script type="text/javascript" src="/Public/js/uploadify/jquery.uploadify.js"></script>
<script>
    $(function() {
        $('#file_upload').uploadify({
            'swf'      : SCOPE.ajax_upload_swf,
            'uploader' : SCOPE.ajax_upload_share_url,
            'buttonText': '选择本地文件',
            'fileTypeDesc': 'All Files',
            'fileObjName' : 'file',
            'removeTimeout' : 15,
            'fileSizeLimit' : '5GB',
            'progressData' : 'speed',
            'successTimeout' : 120,
            'onUploadSuccess' : function(file,data,response) {
                // response true ,false
                if(response) {
                    console.log(data);
                    var obj = JSON.parse(data); //由JSON字符串转换为JSON对象
                    $('#' + file.id).find('.data').html(' 上传完毕');
                    $("#file_upload_share").attr('value',obj.data);
                    $("#file_size").attr('value',file.size);
                    layer.alert('上传成功',{title:'提示',icon:6});
                }else{
                    layer.alert('上传失败',{title:'提示',icon:5});
                }
            },
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
            }
        });

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