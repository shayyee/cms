<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/13
 * Time: 15:33
 */

namespace Admin\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

class TeacherController extends BaseController
{
    public function index()
    {
        /**
         * 分页操作逻辑及搜索
         */
        $config = getConfig();
        $pagenum = $config['pagesize'];
        $condition = array();
        if (isset($_POST['username']) && $_POST['username']) {
            $condition['username'] = array('like', '%' . $_POST['username'] . '%');
        }
        if (isset($_POST['realname']) && $_POST['realname']) {
            $condition['realname'] = array('like', '%' . $_POST['realname'] . '%');
        }
        $pageIndex = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : $pagenum;
        $teachers = D('Teacher')->getTeachers($condition, $pageIndex, $pageSize);
        $teachersCount = D('Teacher')->getTeachersCount($condition);
        $res = new Page($teachersCount, $pageSize);
        $res->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $pageRes = $res->show();
        $this->assign('pageRes', $pageRes);
        $this->assign('teachers', $teachers);
        $this->display();
    }

    public function personal()
    {
        $res = $this->getLoginUser();
        $user = D("Teacher")->getTeacherById($res['t_id']);
        $this->assign('vo', $user);
        $this->display();
    }

    public function add()
    {
        // 保存数据
        if (IS_POST) {

            if (!isset($_POST['username']) || !$_POST['username']) {
                return show(0, '用户名不能为空');
            }
            if (!isset($_POST['password']) || !$_POST['password']) {
                return show(0, '密码不能为空');
            }
            if (!isset($_POST['realname']) || !$_POST['realname']) {
                return show(0, '姓名不能为空');
            }
            $_POST['password'] = getMd5Password($_POST['password']);
            // 判定用户名是否存在
            $teacher = D("Teacher")->getTeacherByUsername($_POST['username']);
            if ($teacher) {
                return show(0, '该用户存在');
            }
            // 新增
            $id = D("Teacher")->insert($_POST);
            if (!$id) {
                return show(0, '新增失败');
            }
            return show(1, '新增成功');
        }
        $this->display();
    }

    public function edit()
    {
        $teacherId = $_GET['id'];
        $user = D("Teacher")->getTeacherById($teacherId);
        $this->assign('vo', $user);
        $this->display();
    }

    public function save()
    {
        //编辑
        if ($_POST['t_id']) {
            $teacherId = $_POST['t_id'];
        } else {
            //个人中心
            $res = $this->getLoginUser();
            $teacherId = $res['t_id'];
        }
        if (!isset($_POST['username']) || !$_POST['username']) {
            return show(0, '用户名不能为空');
        }
        if (!isset($_POST['realname']) || !$_POST['realname']) {
            return show(0, '姓名不能为空');
        }
        if ($_POST['password']) {
            $data['password'] = getMd5Password($_POST['password']);
        }
        $data['username'] = $_POST['username'];
        $data['realname'] = $_POST['realname'];
        $data['college'] = $_POST['college'];
        $data['qq'] = $_POST['qq'];
        try {
            $id = D("Teacher")->updateById($teacherId, $data);
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
            $teacherId = $_POST['id'];
            $course = D('Course')->getCourseByTid($teacherId);
            if ($course) {
                return show(0, '该教师参与授课 禁止删除');
            }
            try {
                $res = D("Teacher")->deleteById($teacherId);
                if ($res === false) {
                    return show(0, '操作失败');
                }
                return show(1, '操作成功');
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        }
    }

    public function import()
    {
        if ($_POST) {
            $path = $_POST['excel'];
            if ($path) {
                $num = import_teacher($path);
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