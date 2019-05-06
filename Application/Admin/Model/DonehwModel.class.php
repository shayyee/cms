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

class DonehwModel extends Model
{
    private $_db = '';
    public function __construct() {
        $this->_db = M('donehw');
    }

    public function getDonehws($condition,$pageIndex,$pageSize=10){
        $offset = ($pageIndex - 1) * $pageSize;//起始位置
        $list = $this->_db->table('cms_donehw d')
            ->join('LEFT JOIN cms_homework AS hw ON d.hw_id = hw.hw_id')
            ->join('LEFT JOIN cms_class AS cl ON hw.class_id = cl.class_id')
            ->join('LEFT JOIN cms_student AS s ON d.s_id = s.s_id')
            ->field('d.dhw_id,d.status,s.sno,hw.t_id,d.hw_id,hw.title,cl.classname,d.updatetime')
            ->where($condition)->order('dhw_id desc')
            ->limit($offset,$pageSize)->select();
//        p($list);
        return $list;
    }
    public function getDonehwsCount($condition=array()){
        $count = $this->_db->table('cms_donehw d')
            ->join('LEFT JOIN cms_homework AS hw ON d.hw_id = hw.hw_id')
            ->join('LEFT JOIN cms_class AS cl ON hw.class_id = cl.class_id')
            ->join('LEFT JOIN cms_student AS s ON d.s_id = s.s_id')
            ->field('d.dhw_id,d.status,s.sno,hw.t_id,d.hw_id,hw.title,cl.classname,d.updatetime')
            ->where($condition)->Count();
        return $count;
    }
    public function getDonehwById($dhwid){
        return $this->_db->where('dhw_id='.$dhwid)->find();
    }
    public function insert($data = array()){
        if(!is_array($data) || !data){
            return 0;
        }

        return $this->_db->add($data);
    }
    public function updateById($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('dhw_id='.$id)->save($data); // 根据条件更新记录
    }

    public function deleteById($id){
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        return  $this->_db->where('hw_id='.$id)->delete(); // 根据条件删除记录
    }


//    public function getPathsByHwid($hwid){
//        $res = $this->_db->where("hw_id=".$hwid." AND status=0 AND path<>''")
//            ->field('path')->select();
//        return $res;
//    }
    public function getPathsByHwid($hwid){
        $list = $this->_db->table('cms_donehw d')
            ->join('LEFT JOIN cms_student AS s ON d.s_id = s.s_id')
            ->where("hw_id=".$hwid." AND status=0 AND path<>''")
            ->field('path,s.sno')
            ->select();
        return $list;
    }
    
    public function getScorelist($hwid){
        $list = $this->_db->table('cms_donehw d')
            ->join('LEFT JOIN cms_student AS s ON d.s_id = s.s_id')
            ->where("hw_id=".$hwid)
            ->field('dhw_id,realname,sno,comment,score')
            ->select();
        return $list;
    }
}