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

class HomeworkController extends Controller
{
    public function index(){
        $this->display();
    }
    public function detail(){
        $hw_id = intval($_GET['id']);
        $detail = D('Homework')->getHomeworkById($hw_id);
//        p($detail);
        $this->assign('detail',$detail);
        $this->display();
    }
}