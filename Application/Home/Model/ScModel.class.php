<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/28
 * Time: 16:06
 */

namespace Home\Model;
use Think\Model;
use Think\Exception;

class ScModel extends Model
{
    private $_db = '';
    function __construct() {
        $this->_db = M('s_c');
    }
    
    public function SCcount($condition){
        $count = $this->_db->where($condition)->Count();
        return $count;
    }

//    public function getHomeworks($condition,$pageIndex,$pageSize){
//        $offset = ($pageIndex - 1) * $pageSize;//起始位置
//        $list = $this->_db->table('cms_s_c sc')
//            ->join('JOIN cms_homework AS hw ON sc.class_id = hw.class_id')
//            ->field('sc.s_id,hw.hw_id')->select();
//        p($list);
//        return $list;
//    }
//
//    public function getHomeworksCount($condition=array()){
//        $count = $this->_db->table('cms_s_c sc')
//            ->join('LEFT JOIN cms_homework AS hw ON sc.class_id = hw.class_id')
//            ->join('LEFT JOIN cms_class AS cl ON sc.class_id = cl.class_id')
//            ->where($condition)->Count();
//        return $count;
//    }
    public function getClasses($condition,$pageIndex,$pageSize){
        $offset = ($pageIndex - 1) * $pageSize;//起始位置
        $list = $this->_db->table('cms_s_c sc')->where($condition)
            ->join('LEFT JOIN cms_class AS cl ON sc.class_id = cl.class_id')
            ->join('LEFT JOIN cms_course AS co ON cl.course_id = co.course_id')
            ->join('LEFT JOIN cms_teacher AS t ON co.t_id = t.t_id')
            ->field('cl.class_id,co.course_id,cl.classname,cl.issue,co.name,co.picpath,t.realname,t.college,t.qq')
            ->order('sc_id desc')->limit($offset,$pageSize)->select();
//        p($list);
        return $list;
    }
    
    public function getClassesCount($condition){
        $count = $this->_db->table('cms_s_c sc')->where($condition)
            ->join('LEFT JOIN cms_class AS cl ON sc.class_id = cl.class_id')
            ->join('LEFT JOIN cms_course AS co ON cl.course_id = co.course_id')
            ->join('LEFT JOIN cms_teacher AS t ON co.t_id = t.t_id')
            ->Count();
        return $count;
    }
    
    
    function insert($data){
        if(!is_array($data) || !data){
            return 0;
        }
        return $this->_db->add($data);
    }
    
    function deleteById($id){
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        return  $this->_db->where('class_id='.$id)->delete(); // 根据条件删除记录
    }
    function getClassesName(){
        $list = $this->_db->field('class_id,classname')->select();
        return $list;
    }
    function getSidsByCid($cid){
        return $this->_db->where('class_id='.$cid)->select();
    }
}