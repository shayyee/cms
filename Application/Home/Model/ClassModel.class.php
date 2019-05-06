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

class ClassModel extends Model
{
    private $_db = '';
    public function __construct() {
        $this->_db = M('Class');
    }


    public function getClasses($condition,$pageIndex,$pageSize=10) {
        $offset = ($pageIndex - 1) * $pageSize;//起始位置
        $list = $this->_db->table('cms_class cl')
            ->join('LEFT JOIN cms_course AS co ON cl.course_id = co.course_id')
            ->join('LEFT JOIN cms_teacher AS t ON co.t_id = t.t_id')
            ->field('cl.class_id,cl.classname,cl.issue,co.name,co.picpath,t.realname,t.college,t.qq')
            ->where($condition)->order('class_id desc')->limit($offset,$pageSize)->select();
//        p($list);
        return $list;
    }
    public function getClassesCount($condition=array()){
        $count = $this->_db->table('cms_class cl')
            ->join('LEFT JOIN cms_course AS co ON cl.course_id = co.course_id')
            ->join('LEFT JOIN cms_teacher AS t ON co.t_id = t.t_id')
            ->where($condition)->Count();
        return $count;
    }
    public function getClassById($id){
        $res = $this->_db->where('class_id='.$id)->find();
        return $res;
    }
    public function updateById($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('class_id='.$id)->save($data); // 根据条件更新记录
    }
    
    public function insert($data){
        if(!is_array($data) || !data){
            return 0;
        }
        return $this->_db->add($data);
    }
    
    
    function getClassByName($name){
        $condition['classname'] = $name;
        return $this->_db->where($condition)->find();
    }
    function deleteById($id){
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        return  $this->_db->where('class_id='.$id)->delete(); // 根据条件删除记录
    }
    public function getClassesName(){
        $list = $this->_db->field('class_id,classname')->select();
        return $list;
    }
}