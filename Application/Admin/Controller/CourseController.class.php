<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/27
 * Time: 10:57
 */

namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
use Think\Page;

class CourseController extends BaseController
{
    public function index(){
        /**
         * 分页操作逻辑及搜索
         */
        $config = getConfig();
        $pagenum = $config['pagesize'];
        $condition = array();
        if(isset($_POST['cname'])&&$_POST['cname']){
            $condition['name'] =array('like', '%'.$_POST['cname'].'%');
        }
        if(isset($_POST['tname'])&&$_POST['tname']){
            $condition['realname'] =array('like', '%'.$_POST['tname'].'%');
        }
        if(isset($_POST['cno'])&&$_POST['cno']){
            $condition['cno'] =array('like', '%'.$_POST['cno'].'%');
        }
        $pageIndex = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : $pagenum;
        $courses = D('Course')->getCourses($condition,$pageIndex,$pageSize);
        $coursesCount = D('Course')->getCoursesCount($condition);
        $res = new Page($coursesCount,$pageSize);
        $res->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $pageRes = $res->show();
        $this->assign('pageRes',$pageRes);
        $this->assign('courses', $courses);
        $this->display();
    }
    
    public function add(){
        if($_POST){
            if(!isset($_POST['cno']) || !$_POST['cno']) {
                return show(0,'课号不能为空');
            }else{
                $cno = D('Course')->isCno($_POST['cno']);
                if($cno){
                    return show(0,'课号已存在');
                }
            }
            if(!isset($_POST['cname']) || !$_POST['cname']) {
                return show(0,'课程名不能为空');
            }
//            if($_POST['course_id']) {  //update
//                return $this->save($_POST);
//            }
            $data = array(
                'cno'  => $_POST['cno'],
                'name' => $_POST['cname'],
                't_id' => $_POST['tid'],
                'picpath' => $_POST['pic']
            );
            $courseId = D('Course')->insert($data);
            if($courseId){
                return show(1,'新增成功');
            }else{
                return show(0,'新增失败');
            }
        }else{
            $teachers = D('Teacher')->getTeachersRealname();
            $this->assign('teachers',$teachers);
            $this->display();
        }
    }

    public function edit(){
        $courseId = $_GET['id'];
        $course = D('Course')->getCourseById($courseId);
        $teachers = D('Teacher')->getTeachersRealname();
        $this->assign('vo',$course);
        $this->assign('teachers',$teachers);
        $this->display();
    }

    public function save(){
        //编辑
        if($_POST['course_id']){
            $courseId = $_POST['course_id'];
        }else{
            return show(0, '操作失败');
        }
        if(!isset($_POST['cno']) || !$_POST['cno']) {
            return show(0,'课号不能为空');
        }else{
            $cno = D('Course')->isCno($_POST['cno']);
//            p($cno);
            if($cno&&$cno['course_id']!=$courseId){
                return show(0,'课号已存在');
            }
        }
        if(!isset($_POST['cname']) || !$_POST['cname']) {
            return show(0,'课程名不能为空');
        }
        $data = array(
            'cno'  => $_POST['cno'],
            'name' => $_POST['cname'],
            't_id' => $_POST['tid'],
            'picpath' => $_POST['pic']
        );
        try {
            $id = D("Course")->updateById($courseId, $data);
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
            $courseId = $_POST['id'];
            try{
                $res = D("Course")->deleteById($courseId);
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
                $num = import_course($path);
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