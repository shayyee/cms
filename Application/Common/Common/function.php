<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/4
 * Time: 13:24
 */
function show($status, $message, $data = array())
{
    $reuslt = array(
        'status' => $status,
        'message' => $message,
        'data' => $data,
    );

    exit(json_encode($reuslt));
}

function showKind($status, $data)
{
    header('Content-type:application/json;charset=UTF-8');
    if ($status == 0) {
        exit(json_encode(array('error' => 0, 'url' => $data)));
    }
    exit(json_encode(array('error' => 1, 'message' => '上传失败')));
}

function getMd5Password($password)
{
    return md5($password . C('MD5_PRE'));
}

function getConfig()
{
    $config = M('Config')->select();
    return $config[0];
}

/**
 * 检测是否登录
 * @return boolean 是否登录
 */
function check_login()
{
    if (!empty($_SESSION['user']['id'])) {
        return true;
    } else {
        return false;
    }
}

function formatBytes($sizeStr)
{
    $size = intval($sizeStr);
    $units = array(' B', ' KB', ' MB', ' GB', ' TB');
    for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
    return round($size, 2) . $units[$i];
}

//传递数据以易于阅读的样式格式化后输出
function p($data)
{
    // 定义样式
    $str = '<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
    // 如果是boolean或者null直接显示文字；否则print
    if (is_bool($data)) {
        $show_data = $data ? 'true' : 'false';
    } elseif (is_null($data)) {
        $show_data = 'null';
    } else {
        $show_data = print_r($data, true);
    }
    $str .= $show_data;
    $str .= '</pre>';
    echo $str;
}


/**
 * 实例化阿里云oos
 * @return object 实例化得到的对象
 */
function new_oss()
{
    vendor('Alioss.autoload');
    $config = getConfig();
    $oss = new \OSS\OssClient($config['key_id'], $config['key_secret'], $config['end_point']);
    return $oss;
}

function new_oss1($endpoint)
{
    vendor('Alioss.autoload');
    $config = getConfig();
    $oss = new \OSS\OssClient($config['key_id'], $config['key_secret'], $endpoint);
    return $oss;
}

/**
 * 上传文件到oss并删除本地文件
 * @param  string $path 文件路径
 * @return $oss_path  Object
 */
function oss_all_upload($path)
{
    // 获取bucket名称
    //path = "/Uploads/share/20170415133814.sql"
    $oss_path = ltrim($path, './');//"Uploads/share/20170411145623.csv"
    $path = './' . $oss_path;  // "./Uploads/share/20170411145801.jpg"
    //服务器上路径
    if (file_exists($path)) {
        $buckets = M('bucket')->select();
        foreach ($buckets as $val) {
            $bucket = $val['bucketname'];
            $endpoint = $val['endpoint'];
            $oss = new_oss1($endpoint);
            try {
                $oss->uploadFile($bucket, $oss_path, $path);
            } catch (\OSS\Core\OssException $e) {
                throw new \Think\Exception($e->getMessage());
            }
        }
        unlink($path);
        return $oss_path;
    }
}

function oss_slb_upload($path)
{
    // 获取bucket名称
    $oss_path = ltrim($path, './');//"Uploads/share/20170411145623.csv"
    $path = './' . $oss_path;  // "./Uploads/share/20170411145801.jpg"
    //服务器上路径
    if (file_exists($path)) {
        $buckets = M('bucket')->select();
        $index = slb();
        $bucket = $buckets[$index]['bucketname'];
        $endpoint = $buckets[$index]['endpoint'];
        $oss = new_oss1($endpoint);
        // 上传到oss
        try {
            $oss->uploadFile($bucket, $oss_path, $path);
            // 如需上传到oss后 自动删除本地的文件 则删除下面的注释
            unlink($path);
//            $res = get_url($osspath);
            $time = 3600 * 1000 * 24 * 365 * 5;
            $res = $oss->signUrl($bucket, $oss_path, $time);
            return $res;

        } catch (OssException $e) {
            throw new \Think\Exception($e->getMessage());
        }
//        $oss1->uploadFile($bucket1,$oss_path,$path);

    }
    return false;

}

function oss_upload($path)
{
    // 获取bucket名称
    $config = getConfig();
    $oss_path = ltrim($path, './');//"Uploads/share/20170411145623.csv"
    $path = './' . $oss_path;  // "./Uploads/share/20170411145801.jpg"
    //服务器上路径
    if (file_exists($path)) {
        //未开启负载均衡
        $oss = new_oss();
        $bucket = $config['bucket'];
        $endpoint = $config['end_point'];
        // 上传到oss
        try {
            $oss->uploadFile($bucket, $oss_path, $path);
            // 如需上传到oss后 自动删除本地的文件 则删除下面的注释
            unlink($path);
            $time = 3600 * 1000 * 24 * 365 * 5;
            $res = $oss->signUrl($bucket, $oss_path, $time);
            return $res;

        } catch (OssException $e) {
            throw new \Think\Exception($e->getMessage());
        }

    }
    return false;

}
//获取
function getSignUrl($endpoint, $bucket, $object, $timeout = 60)
{
    $config = getConfig();
    $oss = new_oss1($endpoint);
    $url = $oss->signUrl($bucket, $object, $timeout);
    return $url;
}


//平滑的加权轮询调度算法
function slb()
{
    $buckets = M('bucket')->select();//配置文件中指定的该服务器的权重
    $count = intval(M('bucket')->Count());
    if (session('ss') == null) {
        $ss = initServer($buckets, $count);
    } else {
        $ss = session('ss');
    }
    $index = getNextServerIndex($ss, $count, 0);
    return $index;
}

function downslb()
{
    $buckets = M('bucket')->select();//配置文件中指定的该服务器的权重
    $count = intval(M('bucket')->Count());
    if (session('dss') == null) {
        $dss = initServer($buckets, $count);
    } else {
        $dss = session('dss');
    }
    $index = getNextServerIndex($dss, $count, 1);
    return $index;
}

function initServer($buckets, $size)
{
    $ss = array();
    for ($i = 0; $i < $size; $i++) {
        $ss[$i]['weight'] = $buckets[$i]['weight'];
        $ss[$i]['name'] = $buckets[$i]['bucketname'];
        $ss[$i]['cur_weight'] = 0;
    }
    return $ss;
}

function getNextServerIndex($ss, $size, $type = 0)
{
    $index = -1;
    $total = 0;
    for ($i = 0; $i < $size; $i++) {
        $ss[$i]['cur_weight'] += $ss[$i]['weight'];
        $total += $ss[$i]['weight'];
        if ($index == -1 || $ss[$index]['cur_weight'] < $ss[$i]['cur_weight']) {
            $index = $i;
        }
    }

    $ss[$index]['cur_weight'] -= $total;
    if ($type == 0) {  //上传
        session('ss', $ss);
    } else {   //下载
        session('dss', $ss);
    }
    return $index;
}


