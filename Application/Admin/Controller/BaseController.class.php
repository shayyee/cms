<?php
/**
 * 基本通用类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/9
 * Time: 14:27
 */

namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller
{
    public function __construct() {

        parent::__construct();
        $this->_init();
    }
    /**
     * 初始化
     * @return
     */
    private function _init() {
        // 如果已经登录
        $isLogin = $this->isLogin();
        if(!$isLogin) {
            // 跳转到登录页面
            $this->redirect('/Admin/Login');
        }
    }

    /**
     * 获取登录用户信息
     * @return array
     */
    public function getLoginUser() {
        $usertype = session('userType');
        if($usertype==1){
            return session("adminUser");
        }else{
            return session("teacherUser");
        }
    }

    /**
     * 判定是否登录
     * @return boolean
     */
    public function isLogin() {
        $user = $this->getLoginUser();
        if($user && is_array($user)) {
            return true;
        }

        return false;
    }

//    public function setStatus($data, $models) {
//        try {
//            if ($_POST) {
//                $id = $data['admin_id'];
//                $status = $data['status'];
//                if (!$id) {
//                    return show(0, 'ID不存在');
//                }
//                $res = D($models)->updateStatusById($id, $status);
//                var_dump($res);
//                if ($res) {
//                    return show(1, '操作成功');
//                } else {
//                    return show(0, '操作失败');
//                }
//            }
//            return show(0, '没有提交的内容');
//        }catch(Exception $e) {
//            return show(0, $e->getMessage());
//        }
//    }
}