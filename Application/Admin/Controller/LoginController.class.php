<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/8
 * Time: 10:11
 */
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{

    public function index()
    {
//        if(session('adminUser')) {
//            $this->redirect('/Admin/Index/index');
//        }
//        var_dump(getMd5Password("123456"));
//        var_dump(session('userType'));
        $this->display();
    }

    public function check()
    {
        if (IS_POST) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $usertype = intval($_POST['usertype']);
            if (!trim($username)) {
                return show(0, '用户名不能为空');
            }
            if (!trim($password)) {
                return show(0, '密码不能为空');
            }
            if($usertype==1){
                $ret = D('Admin')->getAdminByUsername($username);

                if (!$ret || $ret['status'] != 1) {
                    return show(0, '该用户不存在');
                }

                if ($ret['password'] != getMd5Password($password)) {
                    return show(0, '密码错误');
                }
                D("Admin")->updateByAdminId($ret['admin_id'], array('lastlogintime' => time(), 'lastloginip' => get_client_ip()));

                session('adminUser', $ret);
                session('userType',1);
                return show(1, '登录成功');
            }else{
                $ret = D('Teacher')->getTeacherByUsername($username);
                if (!$ret) {
                    return show(0, '该用户不存在');
                }
                if ($ret['password'] != getMd5Password($password)) {
                    return show(0, '密码错误');
                }
                session('teacherUser', $ret);
                session('userType',2);
                return show(1, '登录成功');
            }

        }

    }


    public function logout()
    {
        session('adminUser', null);
        session('teacherUser', null);
        session('userType',null);
        $this->redirect('/Admin/Login');
    }


}