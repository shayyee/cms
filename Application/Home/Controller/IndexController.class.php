<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;
use Think\Page;

header("Content-Type: text/html;charset=utf-8");

//header('Access-Control-Allow-Origin:*');//允许跨域
class IndexController extends Controller
{
    public function index()
    {

        if (!session('studentUser')) {
            redirect('/Home/Index/login.html');
        } else {
            $config = getConfig();
            $pagenum = $config['pagesize'];
            $condition = array();
            $condition['s_id'] = intval($_SESSION['studentUser']['s_id']);
            $condition['status'] = 0;
            $pageIndex = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : $pagenum;
            $homeworks = D('Myhw')->getHomeworks($condition, $pageIndex, $pageSize);
            $homeworksCount = D('Myhw')->getHomeworksCount($condition);
            $res = new Page($homeworksCount, $pageSize);
            $res->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            $pageRes = $res->show();
            $this->assign('pageRes', $pageRes);
            $this->assign('homeworks', $homeworks);
            $user = session('studentUser');
            $this->assign('user', $user);
            $this->display();
        }
    }

    public function statics()
    {
        $sid = intval($_SESSION['studentUser']['s_id']);
        $finished = D('Myhw')->getCount(1, $sid);
        $unfinished = D('Myhw')->getCount(0, $sid);
//        $user = getLoginRealname();
        $this->assign('done', $finished);
        $this->assign('undone', $unfinished);
        $this->assign('sid', $sid);
        $this->display();
    }

    public function login()
    {
        $this->display();
    }

    public function logout()
    {
        session('studentUser', null);
        $this->redirect('/Home/Index/login');
    }

    public function check()
    {
        if (IS_POST) {
            $sno = $_POST['username'];
            $password = $_POST['password'];
            if (!trim($sno)) {
                return show(0, '用户名不能为空');
            }
            if (!trim($password)) {
                return show(0, '密码不能为空');
            }

            $ret = D('Student')->getStudentBySno($sno);

            if (!$ret) {
                return show(0, '该用户不存在');
            }

            if ($ret['password'] != getMd5Password($password)) {
                return show(0, '密码错误');
            }
            session('studentUser', $ret);
            return show(1, '登录成功');


        }
    }

    public function chartdata()
    {
        if ($_GET['sid']) {
            $sid = $_GET['sid'];
            $res = D('Donehw')->getDatesBySid($sid);
            foreach ($res as $v) {
                $dateMap[$v['timer']] = $v['count'];
            }
            $start = $_SESSION['studentUser']['firstlogindate'];
            $end = date('Y-m-d');
            $j=0;
            for ($i = strtotime($start); $i <= strtotime($end); $i += 86400) {
                $key = date('Y-m-d', $i);
                $date[$j]['timer'] = $key;
                if($dateMap[$key]){
                    $date[$j]['count'] = intval($dateMap[$key]);
                }else{
                    $date[$j]['count'] = 0;
                }
                $j++;

            }

            if ($date) {
//                p($formatdate);
                $data['status'] = 1;
                $data['data'] = $date;
                $this->ajaxReturn($data);
            } else {
                $data['status'] = 0;
                $data['data'] = null;
                $this->ajaxReturn($data);
            }
        } else {
            $this->ajaxError('Bad input parameter');
        }
    }
}