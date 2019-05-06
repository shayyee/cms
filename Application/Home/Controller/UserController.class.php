<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 15:47
 */

namespace Home\Controller;
use Think\Controller;

class UserController extends Controller
{
    public function index(){

        if(!session('studentUser')){
            redirect('/Home/Index/login.html');
        }else{
            $user = session('studentUser');
            $this->assign('user',$user);
            $this->display();
        }
    }
    public function save(){
        if($_POST['password']) {
            $data['password'] = getMd5Password($_POST['password']);
        }
        try {
            $studentId = $_POST['id'];
            $id = D("Student")->updateById($studentId, $data);
            if($id === false) {
                return show(0, '操作失败');
            }
            return show(1, '操作成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }
}