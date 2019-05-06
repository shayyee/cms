<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/3
 * Time: 14:18
 */

namespace Admin\Model;
use Think\Model;
use Think\Exception;

class HomeworkModel extends Model
{
    private $_db = '';
    public function __construct() {
        $this->_db = M('Homework');
    }

    public function getHomeworks($condition,$pageIndex,$pageSize=10) {
        $offset = ($pageIndex - 1) * $pageSize;//起始位置
        $list = $this->_db->table('cms_homework hw')->where($condition)
            ->join('LEFT JOIN cms_class AS c ON hw.class_id = c.class_id')
            ->field('hw.hw_id,hw.title,c.classname,hw.createtime,hw.endtime')
            ->order('hw_id desc')->limit($offset,$pageSize)->select();
        return $list;
    }
    public function getHomeworksCount($condition=array()){
        $count = $this->_db->table('cms_homework hw')->where($condition)
            ->join('LEFT JOIN cms_class AS c ON hw.class_id = c.class_id')->Count();
        return $count;
    }

    public function insert($data = array()){
        if(!is_array($data) || !data){
            return 0;
        }

        return $this->_db->add($data);
    }
    public function getHomeworkById($id){
        $result = $this->_db->where('hw_id='.$id)->find();
        return $result;
    }
    public function getHomeworksByCid($cid){
        $result = $this->_db->where('class_id='.$cid)->select();
        return $result;
    }
    public function updateById($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('hw_id='.$id)->save($data); // 根据条件更新记录
    }

    public function deleteById($id){
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        return  $this->_db->where('hw_id='.$id)->delete(); // 根据条件删除记录
    }
}