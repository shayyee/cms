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
<section class="c-main" style="margin-bottom: 45px">
    <h1 style="margin-top:20px;text-align: center;">作业完成情况统计</h1>
    <div id="container1" style="margin-top:50px;width:100%;height: 500px;float: left;"></div>
    <div id="container2" style="margin:50px 0;width: 100%;height: 500px;float: left;"></div>
</section>
</body>
<script src="/Public/js/echarts.js"></script>
<script>
    var done = <?php echo ($done); ?>;
    var undone = <?php echo ($undone); ?>;
    console.log(done+" "+undone);
    var dom1 = document.getElementById("container1");
    var myChart1 = echarts.init(dom1);
    var option1 = {
        title : {
            text: '(1)完成作业的总体情况',
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            data: ['已完成','未完成']
        },
        series : [
            {
                name: '作业总数',
                type: 'pie',
                radius : '55%',
//                roseType: 'angle',
                data:[
                    {value:done, name:'已完成'},
                    {value:undone, name:'未完成'},
                ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };
    if(option1 && typeof option1 === "object") {
        myChart1.setOption(option1, true);
    }
    $(function () {
        $.ajax({
            type: "get",
            url: "/Home/Index/chartdata/sid/"+<?php echo ($sid); ?>,
            dataType: "json",
            success: function (response) {
                if(response.status == 1){
                    var date = [];
                    var count = [];
                    var data = response.data;
                    for(var i=0;i<data.length;i++){
                        date[i] = data[i].timer;
                        count[i] = data[i].count;
                    }
//                    console.log(date);
//                    console.log(count);
                    var dom2 = document.getElementById("container2");
                    var myChart2 = echarts.init(dom2);
                    var option2 = {
                        title: {
                            text: '(2)每日完成作业数目统计折线图',
                        },
                        tooltip: {
                            trigger: 'axis'
                        },
                        dataZoom:{
                            type:'slider',
                            filterMode: 'filter'
                        },
                        toolbox: {
                            show : true,
                            feature : {
                                mark : {show: true},
                                dataView : {show: true, readOnly: false},
                                magicType : {show: true, type: ['line','bar']},
                                restore : {show: true},
                                saveAsImage : {show: true}
                            }
                        },
                        xAxis:  {
                            type: 'category',
                            boundaryGap: false,
                            data: date,
                            axisLabel:{
                                interval: 0,
                                rotate: 60,
                            }
                        },
                        yAxis: {
                            type: 'value',
                            axisLabel: {
                                formatter: '{value}',
                            }
                        },
                        grid: {
                            x: 40,
                            x2: 20,
                            y2: 100,
                        },
                        series: [
                            {
                                name:'日作业完成数',
                                type:'line',
                                data:count,
                                markPoint: {
                                    data: [
                                        {type: 'max', name: '最大值'},
                                        {type: 'min', name: '最小值'}
                                    ]
                                },
                                markLine: {
                                    data: [
                                        {type: 'average', name: '平均值'}
                                    ]
                                }
                            }
                        ]
                    };
                    if(option2 && typeof option2 === "object") {
                        myChart2.setOption(option2, true);
                    }
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    })

</script>
</html>