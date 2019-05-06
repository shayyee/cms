<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/2/15
 * Time: 21:08
 */

namespace Home\Model;


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
    
    public function updateById($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('s_id='.$id)->save($data); // 根据条件更新记录
    }
}