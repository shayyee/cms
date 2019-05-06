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

class DonehwModel extends Model
{
    private $_db = '';
    function __construct() {
        $this->_db = M('donehw');
    }
    
    public function getDonehws($condition,$pageIndex,$pageSize=10){
        $offset = ($pageIndex - 1) * $pageSize;//起始位置
        $list = $this->_db->table('cms_donehw d')
            ->join('LEFT JOIN cms_homework AS hw ON d.hw_id = hw.hw_id')
            ->join('LEFT JOIN cms_class AS cl ON hw.class_id = cl.class_id')
            ->field('d.dhw_id,d.status,hw.hw_id,hw.endtime,hw.title,cl.classname,d.updatetime')
            ->where($condition)->order('dhw_id desc')
            ->limit($offset,$pageSize)->select();
//        p($list);
        return $list;
    }
    public function getDonehwsCount($condition=array()){
        $count = $this->_db->table('cms_donehw d')
            ->join('LEFT JOIN cms_homework AS hw ON d.hw_id = hw.hw_id')
            ->join('LEFT JOIN cms_class AS cl ON hw.class_id = cl.class_id')
            ->where($condition)
            ->Count();
        return $count;
    }
    public function getDonehwById($dhwid){
        return $this->_db->where('dhw_id='.$dhwid)->find();
    }
    
    public function getDatesBySid($sid){
        return $this->_db->query("SELECT count(dhw_id) AS count ,DATE_FORMAT(updatetime,'%Y-%m-%d') AS timer from cms_donehw where s_id=".$sid." group by timer");
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

//    public function getTopByCid($cid){
//        $res = $this->_db->table('cms_donehw dhw')
//            ->join('LEFT JOIN cms_homework AS hw ON dhw.hw_id = hw.hw_id')
//            ->join('LEFT JOIN cms_student AS s ON dhw.s_id = s.s_id')
//            ->field('dhw.dhw_id,hw.hw_id,hw.title,s.realname,dhw.score')
//            ->where('class_id='.$cid)->order('dhw_id')->select();
//        return $res;
//    }
    public function getGoods($cid,$hwid){
        $res = $this->_db->table('cms_donehw AS dhw')
            ->join('LEFT JOIN cms_homework AS hw ON dhw.hw_id = hw.hw_id')
            ->join('LEFT JOIN cms_student AS s ON dhw.s_id = s.s_id')
            ->field('dhw.dhw_id,s.realname,dhw.score')
            ->where('class_id='.$cid.' AND dhw.hw_id='.$hwid.' AND score is not null')
            ->order('score desc')->limit(2)->select();
        return $res;
    }
    

}