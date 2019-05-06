<?php
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING'  =>array(
        '__CSS__' => '/Public/css',
        '__JS__' => '/Public/js',
        '__IMG__' => '/Public/img',
    ),
    //路由模式
    'URL_MODEL'=>2, //REWRITE模式

//***********************************OSS设置**********************************
//    'ALIOSS_CONFIG' => array(
//        'KEY_ID' => 'LTAIDEA9Usu0tbjx', // 阿里云oss key_id
//        'KEY_SECRET' => 'fCJcflBD9V75S81QdmNCT4xA3ap8wv', // 阿里云oss key_secret
//        'END_POINT'=> 'oss-cn-shanghai.aliyuncs.com', // 阿里云oss endpoint
//        'BUCKET'=> 'shaycms'  // bucket 名称
//    ),
//    'NEED_UPLOAD_OSS'        => array( // 需要上传的目录
//        'AVATAR' => 'avatar',
//        'HOMEWORK' => 'homework',
//        'SHARE' => 'share',
//    ),
    //mysql数据库配置
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'cms', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'xxy', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PARAMS' =>  array(), // 数据库连接参数
    'DB_PREFIX' => 'cms_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志

    'MD5_PRE'   => 'homework',

);