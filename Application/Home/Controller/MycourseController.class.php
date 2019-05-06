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

class MycourseController extends Controller
{
    public function index(){
//        getObjectToLocalFile('shayyee');
        $config = getConfig();
        $pagenum = $config['pagesize'];
        $condition = array();
        $condition['s_id'] =intval($_SESSION['studentUser']['s_id']);
        $pageIndex = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : $pagenum;
        $classes = D('sc')->getClasses($condition,$pageIndex,$pageSize);
        $classesCount = D('sc')->getClassesCount($condition);
        $res = new Page($classesCount,$pageSize);
        $res->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $pageRes = $res->show();
        $this->assign('pageRes',$pageRes);
        $this->assign('classes', $classes);
        $this->display();
    }
}