<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/2/15
 * Time: 21:08
 */

namespace Admin\Model;


use Think\Model;

class StudentModel extends Model
{
    private $_db = '';
    public function __construct() {
        $this->_db = M('Student');
    }
    public function getStudentBySno($sno){
        $condition['sno'] = $sno;
        $data = $this->_db->where($condition)->find();
        //   var_dump($data);
        return $data;
    }
    public function getStudentByRealname($realname){
        $condition['realname'] = $realname;
        $data = $this->_db->where($condition)->find();
        //   var_dump($data);
        return $data;
    }

    public function getStudentById($sid=0) {
        $res = $this->_db->where('s_id='.$sid)->find();
        return $res;
    }

    public function updateById($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('s_id='.$id)->save($data); // 根据条件更新记录
    }

    public function insert($data = array()) {
        if(!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }

    public function deleteById($id){
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        return  $this->_db->where('s_id='.$id)->delete(); // 根据条件删除记录
    }

    public function getStudents($condition,$pageIndex,$pageSize=10) {
        $offset = ($pageIndex - 1) * $pageSize;//起始位置
        $list = $this->_db->where($condition)->order('s_id desc')->limit($offset,$pageSize)->select();
        return $list;
    }
    public function getStudentsCount($condition=array()){
        $count = $this->_db->where($condition)->Count();
        return $count;
    }
}