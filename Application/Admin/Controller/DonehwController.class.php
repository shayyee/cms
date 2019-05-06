<?php
/**
 * Created by PhpStorm.
 * User: Homeworkistrator
 * Date: 2017/3/3
 * Time: 8:52
 */

namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
use Think\Page;

class DonehwController extends BaseController
{
    public function index(){
        /**
         * 分页操作逻辑及搜索
         */
        $config = getConfig();
        $pagenum = $config['pagesize'];
        $condition = array();
        if(isset($_POST['title'])&&$_POST['title']){
            $condition['title'] =array('like', '%'.$_POST['title'].'%');
        }
        if(isset($_POST['classname'])&&$_POST['classname']){
            $condition['classname'] =array('like', '%'.$_POST['classname'].'%');
        }
        if(isset($_POST['student'])&&$_POST['student']){
            $condition['sno'] =array('like', '%'.$_POST['student'].'%');
        }
        if(isset($_POST['status'])&&$_POST['status']){
//            $condition['status'] = $_POST['status'];
            if($_POST['status'] == "0"){
                $condition['status'] = intval($_POST['status']);
            }else if($_POST['status'] == "1"){
                $condition['status'] = 0;
            }else{
                $condition['status'] = 1;
            }
        }else{
            $condition['status'] = array('in','0,1');
        }
        $condition['t_id'] = intval($_SESSION['teacherUser']['t_id']);
        $pageIndex = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : $pagenum;
        $homeworks = D('Donehw')->getDonehws($condition,$pageIndex,$pageSize);
        $homeworksCount = D('Donehw')->getDonehwsCount($condition);
        $res = new Page($homeworksCount,$pageSize);
        $res->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $pageRes = $res->show();
        $this->assign('pageRes',$pageRes);
        $this->assign('homeworks', $homeworks);
        //课程下拉框
        $con['t_id'] = intval($_SESSION['teacherUser']['t_id']);
        $classes = D('Class')->getClassesName($con);
        $this->assign('classes', $classes);
        //作业下拉框
        if($_POST['classid']){
            $hws = D('Homework')-> getHomeworksByCid(intval($_POST['classid']));
            $this->ajaxReturn($hws);
        }

        $this->display();
    }
    public function add(){
        if($_POST){
            if(!isset($_POST['title']) || !$_POST['title']) {
                return show(0,'标题不能为空');
            }
            if(!isset($_POST['endtime']) || !$_POST['endtime']) {
                return show(0,'截止时间不能为空');
            }
            $data = array(
                'title'  => $_POST['title'],
                'content' => $_POST['content'],
                'class_id' => $_POST['classid'],
                'endtime' => strtotime($_POST['endtime']),
                'createtime' => time()
            );
            $hwId = D('Homework')->insert($data);
            if($hwId){
                return show(1,'新增成功');
            }else{
                return show(0,'新增失败');
            }
        }else {
            $classes = D('Class')->getClassesName();
            $this->assign('classes',$classes);
            $this->display();
        }
    }
    public function detail(){
        $dhw_id = intval($_GET['id']);
        $dhw = D('Donehw')->getDonehwById($dhw_id);
        $hw_id = $dhw['hw_id'];
        $hw = D('Homework')->getHomeworkById($hw_id);
        $this->assign('dhw',$dhw);
        $this->assign('hw',$hw);
        $this->display();
    }
    public function save(){
        //编辑
        if($_POST['dhw_id']){
            $dhwid= $_POST['dhw_id'];
        }else{
            return show(0, '操作失败');
        }
        if(!isset($_POST['score']) || !$_POST['score']) {
            return show(0,'成绩不能为空');
        }

        $data = array(
            'comment' => $_POST['comment'],
            'score' => floatval($_POST['score']),
            'status'=> 1
        );
        try {
            $id = D("Donehw")->updateById($dhwid, $data);
            if($id === false) {
                return show(0, '操作失败');
            }
            return show(1, '操作成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }
    public function score(){
        if($_GET['hwid']){
            $hwid = intval($_GET['hwid']);
            $res = D('Donehw')->getScorelist($hwid);
//            p($res);
            $this->assign('scores',$res);
            
        }
        $this->display();

    }
    public function insertAll(){
        if($_POST){
            foreach ($_POST as $val){
                $data = array(
                    'comment' => $val['comment'],
                    'score' => floatval($val['score']),
                    'status'=> 1
                );
                $dhwid = intval($val['dhw_id']);
                $id = D("Donehw")->updateById($dhwid, $data);
                if($id === false) {
                    return show(0, '操作失败');
                }
            }
            return show(1, '操作成功');
        }
    }
}