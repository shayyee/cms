<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/14
 * Time: 9:37
 */

namespace Admin\Model;
use Think\Model;
use Think\Exception;
class ShareModel extends Model
{
    private $_db = '';
    public function __construct() {
        $this->_db = M('Share');
    }


    public function getShares($condition,$pageIndex,$pageSize=10) {
        $offset = ($pageIndex - 1) * $pageSize;//起始位置
        $list = $this->_db->table('cms_share s')->where($condition)
            ->join('LEFT JOIN cms_course AS c ON s.course_id = c.course_id')
            ->field('s.share_id,s.filename,c.name,s.create_time,s.size,s.status')
            ->where($condition)->order('share_id desc')->limit($offset,$pageSize)->select();
        return $list;
    }
    public function getSharesCount($condition=array()){
        $count = $this->_db->where($condition)->Count();
        return $count;
    }

    public function insert($data = array()){
        if(!is_array($data) || !data){
            return 0;
        }

        return $this->_db->add($data);
    }
    
    public function getShareById($id=0) {
        $res = $this->_db->where('share_id='.$id)->find();
        return $res;
    }
   
    public function updateById($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('share_id='.$id)->save($data); // 根据条件更新记录
    }

    public function deleteById($id){
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        return  $this->_db->where('share_id='.$id)->delete(); // 根据条件删除记录
    }
    
}