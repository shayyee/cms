<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/1
 * Time: 13:18
 */

namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class ConfigController extends BaseController
{
    public function index()
    {
        $config = getConfig();
        $user = $_SESSION['adminUser']['admin_id'];
        $this->assign('user', $user);
        $this->assign('config', $config);
        $this->display();
    }

    public function save()
    {
        if ($_POST) {
            $data = array();
            if ($_POST['id']) {
                $data['key_id'] = $_POST['id'];
            }
            if ($_POST['secret']) {
                $data['key_secret'] = $_POST['secret'];
            }
            if ($_POST['endpoint']) {
                $data['end_point'] = $_POST['endpoint'];
            }
            if ($_POST['bucket']) {
                $data['bucket'] = $_POST['bucket'];
            }
            if ($_POST['boot']) {
                $data['upload'] = $_POST['boot'];
            }
            if ($_POST['avatar']) {
                $data['avatar'] = $_POST['avatar'];
            }
            if ($_POST['homework']) {
                $data['homework'] = $_POST['homework'];
            }
            if ($_POST['share']) {
                $data['share'] = $_POST['share'];
            }
            if ($_POST['pagesize']) {
                $data['pagesize'] = $_POST['pagesize'];
            }
//            if($_POST['pagesize']) {
//                $data['key_id'] = $_POST['id'];
//            }
            try {
                $res = M('Config')->where('id=1')->save($data);
                if ($res === false) {
                    return show(0, '配置失败');
                }
                return show(1, '配置成功');
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        }
    }
    public function slbinit()
    {
        if ($_POST['slb'] == 'init') {
            session('ss',null);
            session('dss',null);
            return show(1, '初始化成功');
        }else{
            return show(0, '初始化失败');
        }
    }

    public function slbopen()
    {
        if ($_POST['slb'] == '0') {
            try {
                $data['slb'] = 1;
                $res = M('Config')->where('id=1')->save($data);
                if ($res === false) {
                    return show(0, '无法开启负载均衡');
                }
                return show(1, '操作成功');
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        }
    }

    public function slbclose()
    {
        if ($_POST['slb'] == '1') {
            try {
                $data['slb'] = 0;
                $res = M('Config')->where('id=1')->save($data);
                if ($res === false) {
                    return show(0, '无法关闭负载均衡');
                }
                session('ss',null);
                return show(1, '操作成功');
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        }
    }

    public function bucket()
    {
        if (IS_POST) {
            if (!isset($_POST['name']) || !$_POST['name']) {
                return show(0, 'bucket不能为空');
            }
            if (!isset($_POST['endpoint']) || !$_POST['endpoint']) {
                return show(0, 'endpoint不能为空');
            }
            if (!isset($_POST['weight']) || !$_POST['weight']) {
                return show(0, 'weight不能为空');
            }
            if ($_POST['id']) {
                $id = intval($_POST['id']);
                $data = array(
                    'bucketname' => $_POST['name'],
                    'endpoint' => $_POST['endpoint'],
                    'weight' => $_POST['weight']
                );
                $res = M('bucket')->where('bucket_id=' . $id)->save($data);
                if($res === false){
                    return show(0, '修改失败');
                }else{
                    session('ss',null);
                    return show(1, '修改成功');
                }
            }
        } else {
            $buckets = M('bucket')->select();
            $this->assign('buckets', $buckets);
            $this->display();
        }
    }
}