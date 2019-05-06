<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 15:47
 */

namespace Home\Controller;
use Think\Controller;
use Think\Exception;
use Think\Page;

class DonehwController extends Controller
{
    public function index(){
        $config = getConfig();
        $pagenum = $config['pagesize'];
        $condition = array();
        $condition['s_id'] =intval($_SESSION['studentUser']['s_id']);
        $pageIndex = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : $pagenum;
        $donehws = D('donehw')->getDonehws($condition,$pageIndex,$pageSize);
        $donehwsCount = D('donehw')->getDonehwsCount($condition);
        $res = new Page($donehwsCount,$pageSize);
        $res->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $pageRes = $res->show();
        $this->assign('pageRes',$pageRes);
//        p($donehws);
        $this->assign('donehws', $donehws);
        $this->display();
    }
    public function add(){
        if($_POST){
            if(!isset($_POST['content']) || !$_POST['content']) {
                return show(0,'作业内容不能为空');
            }
            if($_POST['endtime']< time()){
                return show(0,'作业已超时');
            }
            $data = array(
                's_id'  => intval($_SESSION['studentUser']['s_id']),
                'hw_id' => $_POST['hw_id'],
                'path' => $_POST['path'],
                'content' => $_POST['content'],
                'updatetime' => date("Y-m-d H:i:s",time())
            );
            $dhwId = D('Donehw')->insert($data);
            $condition['s_id'] = intval($_SESSION['studentUser']['s_id']);
            $condition[hw_id] = $_POST['hw_id'];
            $num = D('Myhw')->updateStatus($condition);
            if($dhwId&&$num){
                return show(1,'提交成功');
            }else{
                return show(0,'提交失败');
            }
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
        if($_POST){
            if(!isset($_POST['content']) || !$_POST['content']) {
                return show(0,'作业内容不能为空');
            }
            if($_POST['endtime']< time()){
                return show(0,'作业已超时');
            }
            $data = array(
                'path' => $_POST['path'],
                'content' => $_POST['content'],
                'updatetime' => date("Y-m-d H:i:s",time())
            );
            $dhwid = $_POST['dhw_id'];
            try {
                $id = D("Donehw")->updateById($dhwid, $data);
                if($id === false) {
                    return show(0, '修改失败');
                }
                return show(1, '修改成功');
            }catch(Exception $e) {
                return show(0, $e->getMessage());
            }

        }
    }
}