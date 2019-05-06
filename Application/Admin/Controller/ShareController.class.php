<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/3
 * Time: 15:47
 */

namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
use Think\Page;

class ShareController extends BaseController
{
    public function index(){
//        $admins = D('Admin')->getAdmins();
//        $this->assign('admins', $admins);
        /**
         * 分页操作逻辑及搜索
         */
        $config = getConfig();
        $pagenum = $config['pagesize'];
        $condition = array();
        if(isset($_POST['name'])&&$_POST['name']){
            $condition['name'] =array('like', '%'.$_POST['name'].'%');
        }
        $condition['author'] = $_SESSION['teacherUser']['t_id'];
        $pageIndex = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : $pagenum;
        $shares = D('Share')->getShares($condition,$pageIndex,$pageSize);
        $sharesCount = D('Share')->getSharesCount($condition);
        $res = new Page($sharesCount,$pageSize);
        $res->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $pageRes = $res->show();
        $this->assign('pageRes',$pageRes);
        $this->assign('shares', $shares);
        $this->display();
    }
    public function add(){
        // 保存数据
        if(IS_POST) {

            if(!isset($_POST['filename']) || !$_POST['filename']) {
                return show(0, '资料名称不能为空');
            }
            if(!isset($_POST['courseid']) || !$_POST['courseid']) {
                return show(0,'所属课程不能为空');
            }
            if(!isset($_POST['share']) || !$_POST['share']) {
                return show(0,'资料未上传');
            }
            // 新增
            $data = array(
                'filename'  => $_POST['filename'],
                'course_id' => $_POST['courseid'],
                'author' => $_SESSION['teacherUser']['t_id'],
                'path' => $_POST['share'],
                'size' => $_POST['size'],
                'create_time' => date("Y-m-d H:i:s",time())
                
            );
            $courseId = D('Share')->insert($data);
            if($courseId){
                return show(1,'新增成功');
            }else{
                return show(0,'新增失败');
            }
        }else{
            $tid = $_SESSION['teacherUser']['t_id'];
            $courses = D('Course')->getCoursesListByTid($tid);
            $this->assign('courses',$courses);
            $this->display();
        }
       
    }
    public function edit(){
        $shareId = $_GET['id'];
        $share = D("Share")->getShareById($shareId);
        $tid = $_SESSION['teacherUser']['t_id'];
        $courses = D('Course')->getCoursesListByTid($tid);
        $this->assign('courses',$courses);
//        p($courses);
        $this->assign('vo',$share);
        $this->display();
    }
    public function save(){
        //编辑
        if($_POST['share_id']){
            $shareId = $_POST['share_id'];
        }else{
            return show(0, '操作失败');
        }
        if(!isset($_POST['filename']) || !$_POST['filename']) {
            return show(0, '资料名称不能为空');
        }
        $data = array(
            'filename'  => $_POST['filename'],
            'course_id' => $_POST['courseid'],
            'author' => $_SESSION['teacherUser']['t_id'],
            'create_time' => date("Y-m-d H:i:s",time())
        );
        if($_POST['share']){
            $data['path'] = $_POST['share'];
            $data['size'] = $_POST['size'];
        }
        try {
            $id = D("Share")->updateById($shareId, $data);
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
            $shareId = $_POST['id'];
            try{
                $res = D("Share")->deleteById($shareId);
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