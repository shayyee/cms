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

class MyhwModel extends Model
{
    private $_db = '';
    function __construct() {
        $this->_db = M('my_hw');
    }

    public function getHomeworks($condition,$pageIndex,$pageSize=10) {
        $offset = ($pageIndex - 1) * $pageSize;//起始位置
        $list = $this->_db->table('cms_my_hw my')
            ->join('LEFT JOIN cms_homework AS hw ON my.hw_id = hw.hw_id')
            ->join('LEFT JOIN cms_class AS cl ON hw.class_id = cl.class_id')
            ->field('hw.hw_id,hw.title,cl.classname,hw.createtime,hw.endtime')
            ->where($condition)->order('endtime')
            ->limit($offset,$pageSize)->select();
//        p($list);
        return $list;
    }
    public function getHomeworksCount($condition=array()){
        $count = $this->_db->table('cms_my_hw my')
            ->join('LEFT JOIN cms_homework AS hw ON my.hw_id = hw.hw_id')
            ->join('LEFT JOIN cms_class AS cl ON hw.class_id = cl.class_id')
            ->where($condition)->Count();
        return $count;
    }
    public function getCount($status,$sid){
        $condition['s_id'] = $sid;
        $condition['status'] = $status;
        return $this->_db->where($condition)->Count();
    }

    public function insert($data = array()){
        if(!is_array($data) || !data){
            return 0;
        }
        return $this->_db->add($data);
    }
    public function insertAll($data = array()){
        if(!is_array($data) || !data){
            return 0;
        }
        return $this->_db->addAll($data);
    }
    public function updateStatus($condition){
        $data['status'] = 1;
        return  $this->_db->where($condition)->save($data); // 根据条件更新记录
    }

    public function deleteByHwid($hwid){
        if(!$hwid || !is_numeric($hwid)) {
            throw_exception("ID不合法");
        }
        return  $this->_db->where('hw_id='.$hwid)->delete();
    }
}