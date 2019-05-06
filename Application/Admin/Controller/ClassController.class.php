<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/28
 * Time: 16:05
 */

namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
use Think\Page;

class ClassController extends BaseController
{
    public function index(){
        /**
         * 分页操作逻辑及搜索
         */
        $config = getConfig();
        $pagenum = $config['pagesize'];
        $condition = array();
        if(isset($_POST['classname'])&&$_POST['classname']){
            $condition['classname'] =array('like', '%'.$_POST['classname'].'%');
        }
        $pageIndex = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : $pagenum;
        $classes = D('Class')->getClasses($condition,$pageIndex,$pageSize);
        $classesCount = D('Class')->getClassesCount($condition);
        $res = new Page($classesCount,$pageSize);
        $res->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $pageRes = $res->show();
        $this->assign('pageRes',$pageRes);
        $this->assign('classes', $classes);
        $this->display();
    }
    public function edit(){
        $classId = $_GET['id'];
        $class = D('Class')->getClassById($classId);
        $courses = D('Course')->getCoursesList();
        $issues = C("COURSE_ISSUE");
        $this->assign('vo',$class);
        $this->assign('courses',$courses);
        $this->assign('issues',$issues);
        $this->display();
    }
    public function save(){
        //编辑
        if($_POST['class_id']){
            $classId = $_POST['class_id'];
        }else{
            return show(0, '操作失败');
        }
        $data = array(
            'issue' => intval($_POST['issue']),
            'classname' => $_POST['classname'],
            'course_id' => $_POST['courseid'],
        );
        try {
            $id = D("Class")->updateById($classId, $data);
            if($id === false) {
                return show(0, '操作失败');
            }
            return show(1, '操作成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }
    public function add(){
        if($_POST){
            $class = D('Class')->getClassByName($_POST['classname']);
            if($class){
                return show(0,'班级已存在');
            }
            $data = array(
                'issue' => intval($_POST['issue']),
                'classname' => $_POST['classname'],
                'course_id' => $_POST['courseid'],
            );
            $classId = D('Class')->insert($data);
            if($classId){
                return show(1,'新增成功');
            }else{
                return show(0,'新增失败');
            }
        }else{
            $courses = D('Course')->getCoursesList();
            $issues = C("COURSE_ISSUE");
            $this->assign('courses',$courses);
            $this->assign('issues',$issues);
            $this->display();
        }
    }
    
    public function delete(){
        if($_POST){
            $classId = $_POST['id'];
            try{
                $res = D("Class")->deleteById($classId);
                if($res===false){
                    return show(0, '操作失败');
                }
                return show(1, '操作成功');
            }catch (Exception $e){
                return show(0, $e->getMessage());
            }
        }
    }
}