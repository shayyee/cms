<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/4/5
 * Time: 15:50
 */

namespace Home\Model;


use Think\Model;

class HomeworkModel extends Model
{
    private $_db = '';
    function __construct() {
        $this->_db = M('Homework');
    }

    public function getHomeworks($condition,$pageIndex,$pageSize=10) {
        $offset = ($pageIndex - 1) * $pageSize;//起始位置
        $list = $this->_db->table('cms_homework hw')
            ->join('LEFT JOIN cms_s_c AS sc ON hw.class_id = sc.class_id')
            ->join('LEFT JOIN cms_class AS cl ON sc.class_id = cl.class_id')
            ->field('hw.hw_id,hw.title,cl.classname,hw.createtime,hw.endtime')
            ->where($condition)->order('hw.hw_id desc')
            ->limit($offset,$pageSize)->select();
//        p($list);
        return $list;
    }
    public function getHomeworksCount($condition=array()){
        $count = $this->_db->table('cms_homework hw')
            ->join('LEFT JOIN cms_s_c AS sc ON hw.class_id = sc.class_id')
            ->join('LEFT JOIN cms_class AS cl ON sc.class_id = cl.class_id')
            ->where($condition)->Count();
        return $count;
    }
    
    public function getHomeworkById($id){
        $result = $this->_db->where('hw_id='.$id)->find();
        return $result;
    }
    public function getHwsByCid($cid){
        $result = $this->_db->where('class_id='.$cid)
        ->field('hw_id,title')->select();
        return $result;
    }
    
//    public function getTopByCid($cid){
//        $res = $this->_db->table('cms_homework hw')
//            ->join('cms_donehw AS dhw ON hw.hw_id = dhw.dhw_id')
//            ->join('LEFT JOIN cms_student AS s ON dhw.s_id = s.s_id')
//            ->field('dhw.dhw_id,s.realname,dhw.score')->select();
//        return $res;
//    }
}