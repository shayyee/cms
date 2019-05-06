<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/13
 * Time: 15:34
 */

namespace Admin\Model;


use Think\Model;

class TeacherModel extends Model
{
    private $_db = '';
    public function __construct() {
        $this->_db = M('Teacher');
    }
    public function getTeacherByUsername($username){
        $condition['username'] = $username;
        $data = $this->_db->where($condition)->find();
        //   var_dump($data);
        return $data;
    }
    public function getTeacherByRealname($realname){
        $condition['realname'] = $realname;
        $data = $this->_db->where($condition)->find();
        //   var_dump($data);
        return $data;
    }
    public function getTeacherById($tid=0) {
        $res = $this->_db->where('t_id='.$tid)->find();
        return $res;
    }

    public function updateById($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('t_id='.$id)->save($data); // 根据条件更新记录
    }
    
    public function deleteById($id){
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        return  $this->_db->where('t_id='.$id)->delete(); // 根据条件删除记录
    }
    
    public function insert($data = array()) {
        if(!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }
    
    public function getTeachersRealname(){
        $list = $this->_db->field('t_id,realname')->select();
        return $list;
    }
    public function getTeachers($condition,$pageIndex,$pageSize=10) {
        $offset = ($pageIndex - 1) * $pageSize;//起始位置
        $list = $this->_db->where($condition)->order('t_id desc')->limit($offset,$pageSize)->select();
        return $list;
    }
    public function getTeachersCount($condition=array()){
        $count = $this->_db->where($condition)->Count();
        return $count;
    }
}