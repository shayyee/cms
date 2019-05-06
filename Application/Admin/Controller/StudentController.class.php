<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/2/15
 * Time: 20:45
 */

namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
use Think\Page;

class StudentController extends BaseController
{
    public function index(){
        /**
         * 分页操作逻辑及搜索
         */
        $config = getConfig();
        $pagenum = $config['pagesize'];
        $condition = array();
        if(isset($_POST['sno'])&&$_POST['sno']){
            $condition['sno'] =array('like', '%'.$_POST['sno'].'%');
        }
        if(isset($_POST['realname'])&&$_POST['realname']){
            $condition['realname'] =array('like', '%'.$_POST['realname'].'%');
        }
        $pageIndex = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : $pagenum;
        $students = D('Student')->getStudents($condition,$pageIndex,$pageSize);
        $studentsCount = D('Student')->getStudentsCount($condition);
        $res = new Page($studentsCount,$pageSize);
        $res->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $pageRes = $res->show();
        $this->assign('pageRes',$pageRes);
        $this->assign('students', $students);
        $this->display();
    }
  
    public function add(){
        // 保存数据
        if(IS_POST) {

            if(!isset($_POST['sno']) || !$_POST['sno']) {
                return show(0, '学号不能为空');
            }
            if(!isset($_POST['password']) || !$_POST['password']) {
                return show(0, '密码不能为空');
            }
            if(!isset($_POST['realname']) || !$_POST['realname']) {
                return show(0, '姓名不能为空');
            }
            $_POST['password'] = getMd5Password($_POST['password']);
            $_POST['firstlogindate'] = date('Y-m-d');
            // 判定用户名是否存在
            $student = D("Student")->getStudentBySno($_POST['sno']);
            if($student) {
                return show(0,'该用户存在');
            }
            // 新增
            $id = D("Student")->insert($_POST);
            if(!$id) {
                return show(0, '新增失败');
            }
            return show(1, '新增成功');
        }
        $this->display();
    }

    public function edit(){
        $studentId = $_GET['id'];
        $user = D("Student")->getStudentById($studentId);
        $this->assign('vo',$user);
        $this->display();
    }
    public function save(){
        //编辑
        if($_POST['s_id']){
            $studentId = $_POST['s_id'];
        }
        if($_POST['password']){
            $data['password'] = getMd5Password($_POST['password']);
        }
        $data['realname'] = $_POST['realname'];
        $data['sno'] = $_POST['sno'];
        try {
            $id = D("Student")->updateById($studentId, $data);
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
            $studentId = $_POST['id'];
            try{
                $res = D("Student")->deleteById($studentId);
                if($res===false){
                    return show(0, '操作失败');
                }
                return show(1, '操作成功');
            }catch (Exception $e){
                return show(0, $e->getMessage());
            }
        }
    }

    public function import()
    {
        if ($_POST) {
            $path = $_POST['excel'];
            if ($path) {
                $num = import_student($path);
                if ($num) {
                    return show(1, '成功导入' . $num . '条数据');
                } else {
                    return show(0, '导入失败');
                }
            } else {
                return show(0, '文件不存在');
            }
        } else {
            $this->display();
        }
    }
}