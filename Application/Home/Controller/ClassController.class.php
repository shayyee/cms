<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/31
 * Time: 16:00
 */

namespace Home\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;
class ClassController extends Controller
{
    public function index(){

        $config = getConfig();
        $pagenum = $config['pagesize'];
        $condition = array();
        if(isset($_POST['searchTx'])&&$_POST['searchTx']){
            $condition['classname'] =array('like', '%'.$_POST['searchTx'].'%');
            $classesCount = D('Class')->getClassesCount($condition);
            if($classesCount == '0') {
                $condition = array();
                $condition['realname'] = array('like', '%' . $_POST['searchTx'] . '%');
            }
        }
        $classesCount = D('Class')->getClassesCount($condition);
        $pageIndex = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : $pagenum;
        $classes = D('Class')->getClasses($condition,$pageIndex,$pageSize);
        $res = new Page($classesCount,$pageSize);
        $res->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $res->setConfig('header','<span class="rows">共 %TOTAL_ROW% 个符合条件的班级</span>');
        $pageRes = $res->show();
        $this->assign('pageRes',$pageRes);
        $this->assign('classes', $classes);
        $this->display();
    }
    
    public function detail(){
        
        $classid = $_GET['id'];
        $res = D('Class')->getClassById($classid);
        $cres = D('Admin/Course')->getCourseById($res['course_id']);
        $teacher = D('Admin/Teacher')->getTeacherById($cres['t_id']);
        $config = getConfig();
        $pagenum = $config['pagesize'];
        $condition = array();

        $condition['course_id'] = $res['course_id'];

        $pageIndex = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : $pagenum;
        $shares = D('Share')->getShares($condition,$pageIndex,$pageSize);
        $sharesCount = D('Share')->getSharesCount($condition);
        $res = new Page($sharesCount,$pageSize);
        $res->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $pageRes = $res->show();
        $this->assign('pageRes',$pageRes);
        $this->assign('shares', $shares);
        $this->assign('teacher', $teacher);
        //优秀作业展示
        $goodhws = array();
        $hws = D('Homework')->getHwsByCid($classid);
        for($i=0;$i<count($hws);$i++){
            $goodhws[$i]['title'] = $hws[$i]['title'];
            $hwid = $hws[$i]['hw_id'];
            $goodhws[$i]['goods'] = D('Donehw')->getGoods($classid,$hwid);
        }
//        p($goodhws);
        $this->assign('goodhws',$goodhws);
        $this->display();
    }
}