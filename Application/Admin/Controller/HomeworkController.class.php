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

class HomeworkController extends BaseController
{
    public function index()
    {
        /**
         * 分页操作逻辑及搜索
         */
        $config = getConfig();
        $pagenum = $config['pagesize'];
        $condition = array();
        if (isset($_POST['title']) && $_POST['title']) {
            $condition['title'] = array('like', '%' . $_POST['title'] . '%');
        }
        if (isset($_POST['classname']) && $_POST['classname']) {
            $condition['classname'] = array('like', '%' . $_POST['classname'] . '%');
        }
        $condition['t_id'] = $_SESSION['teacherUser']['t_id'];
        $pageIndex = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : $pagenum;
        $homeworks = D('Homework')->getHomeworks($condition, $pageIndex, $pageSize);
        $homeworksCount = D('Homework')->getHomeworksCount($condition);
        $res = new Page($homeworksCount, $pageSize);
        $res->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $pageRes = $res->show();
        $this->assign('pageRes', $pageRes);
        $this->assign('homeworks', $homeworks);
        $this->display();
    }

    public function add()
    {
        if ($_POST) {
            if (!isset($_POST['title']) || !$_POST['title']) {
                return show(0, '标题不能为空');
            }
            if (!isset($_POST['endtime']) || !$_POST['endtime']) {
                return show(0, '截止时间不能为空');
            }else{
                if(strtotime($_POST['endtime'])<=time()){
                    return show(0, '截止时间不合理');
                }
            }
            $data = array(
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                't_id' => intval($_SESSION['teacherUser']['t_id']),
                'class_id' => $_POST['classid'],
                'endtime' => strtotime($_POST['endtime']),
                'createtime' => time()
            );
            $hwId = D('Homework')->insert($data);
            $cid = intval($_POST['classid']);
            if ($hwId) {
                $s_ids = D('Home/Sc')->getSidsByCid($cid);
                $myhw['hw_id'] = $hwId;
                foreach ($s_ids as $val){
                    $myhw['s_id'] = $val['s_id'];
                    D('Home/Myhw')->insert($myhw);
                }
                return show(1, '新增成功');
            } else {
                return show(0, '新增失败');
            }
        } else {
            $condition['t_id'] = intval($_SESSION['teacherUser']['t_id']);
            $classes = D('Class')->getClassesName($condition);
            $this->assign('classes', $classes);
            $this->display();
        }
    }

    public function edit()
    {
        $homeworkId = $_GET['id'];
        $homework = D('Homework')->getHomeworkById($homeworkId);
        $classes = D('Class')->getClassesName();
        $this->assign('classes', $classes);
        $this->assign('vo', $homework);
        $this->display();
    }

    public function save()
    {
        //编辑
        if ($_POST['hw_id']) {
            $homeworkId = $_POST['hw_id'];
        } else {
            return show(0, '操作失败');
        }
        $data = array(
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'class_id' => $_POST['classid'],
            'endtime' => strtotime($_POST['endtime']),
        );
        try {
            $id = D("Homework")->updateById($homeworkId, $data);
            if ($id === false) {
                return show(0, '操作失败');
            }
            return show(1, '操作成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function delete()
    {
        if ($_POST) {
            $homeworkId = $_POST['id'];
            try {
                $resh = D("Home/Myhw")->deleteByHwid($homeworkId);
                $res = D("Homework")->deleteById($homeworkId);
                if ($res !== false && $resh !== false) {
                    return show(1, '操作成功');
                }
                return show(0, '操作失败');
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        }
    }
}