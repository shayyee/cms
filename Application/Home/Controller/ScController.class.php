<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/31
 * Time: 16:00
 */

namespace Home\Controller;

use Common\Util\Validator\length;
use Think\Controller;
use Think\Exception;
use Think\Page;
class ScController extends Controller
{
    public function join(){
        $condition = array();
        $condition['s_id'] = $_SESSION['studentUser']['s_id'];
        if(isset($_POST['class_id'])&&$_POST['class_id']){
            $condition['class_id'] = intval($_POST['class_id']);
            $count = D('sc')->SCcount($condition);
            if($count != '0'){
                return show(0,'你已加入该班级');
            }else{
                D('sc')->insert($condition);
                $hws = D('Homework')->getHwsByCid($condition['class_id']);
                $data['s_id'] = $_SESSION['studentUser']['s_id'];
                foreach($hws as $val){
                    $data['hw_id'] = $val['hw_id'];
                    D('Myhw')->insert($data);
                }
                return show(1,'成功加入该班级');
            }
        }

    }
}