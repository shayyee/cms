<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/8
 * Time: 13:50
 */

namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
use Think\Page;

class ManagerController extends BaseController{
    public function index(){
//        $admins = D('Admin')->getAdmins();
//        $this->assign('admins', $admins);
        /**
         * 分页操作逻辑及搜索
         */
        $config = getConfig();
        $pagenum = $config['pagesize'];
        $condition = array();
        if(isset($_POST['username'])&&$_POST['username']){
            $condition['username'] =array('like', '%'.$_POST['username'].'%');
        }
        if(isset($_POST['realname'])&&$_POST['realname']){
            $condition['realname'] =array('like', '%'.$_POST['realname'].'%');
        }
        $pageIndex = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : $pagenum;
        $admins = D('Admin')->getAdmins($condition,$pageIndex,$pageSize);
        $adminsCount = D('Admin')->getAdminsCount($condition);
        $res = new Page($adminsCount,$pageSize);
        $res->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $pageRes = $res->show();
        $this->assign('pageRes',$pageRes);
        $user = $_SESSION['adminUser']['admin_id'];
        $this->assign('user',$user);
        $this->assign('admins', $admins);
        $this->display();
    }
    public function add(){
        // 保存数据
        if(IS_POST) {

            if(!isset($_POST['username']) || !$_POST['username']) {
                return show(0, '用户名不能为空');
            }
            if(!isset($_POST['password']) || !$_POST['password']) {
                return show(0, '密码不能为空');
            }
            $_POST['password'] = getMd5Password($_POST['password']);
            // 判定用户名是否存在
            $admin = D("Admin")->getAdminByUsername($_POST['username']);
            if($admin && $admin['status']!=-1) {
                return show(0,'该用户存在');
            }

            // 新增
            $id = D("Admin")->insert($_POST);
            if(!$id) {
                return show(0, '新增失败');
            }
            return show(1, '新增成功');
        }
        $user = $_SESSION['adminUser']['admin_id'];
        $this->assign('user',$user);
        $this->display();

    }
    public function personal(){
        $res = $this->getLoginUser();
        $user = D("Admin")->getAdminByAdminId($res['admin_id']);
        $this->assign('vo',$user);
        $this->display();
    }
    public function edit(){
        $adminId = $_GET['id'];
        $user = D("Admin")->getAdminByAdminId($adminId);
        $userid= $_SESSION['adminUser']['admin_id'];
        $this->assign('user',$userid);
        $this->assign('vo',$user);
        $this->display();
    }
    public function save(){
        //编辑
        if($_POST['admin_id']){
            $adminId = $_POST['admin_id'];
        }else{
            //个人中心
            $res = $this->getLoginUser();
            $adminId = $res['admin_id'];
        }
        if($_POST['password']){
            $data['password'] = getMd5Password($_POST['password']);
        }
        $data['realname'] = $_POST['realname'];
        $data['email'] = $_POST['email'];
        $data['status'] = intval($_POST['status']);

        try {
            $id = D("Admin")->updateByAdminId($adminId, $data);
            if($id === false) {
                return show(0, '操作失败');
            }
            return show(1, '操作成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }
    public function delete(){
        if($_POST){
            $adminId = intval($_POST['id']);
            if($adminId == 1){
                return show(0, '您没有权限删除该帐号');
            }
            try{
                $res = D("Admin")->deleteByAdminId($adminId);
                if($res===false){
                    return show(0, '操作失败');
                }
                return show(1, '操作成功');
            }catch (Exception $e){
                return show(0, $e->getMessage());
            }
        }
    }
//    public function setStatus() {
//        $data = array(
//            'admin_id'=>intval($_POST['id']),
//            'status' => intval($_POST['status']),
//        );
////        var_dump($data);
//        return parent::setStatus($data,'Admin');
//    }
    
}