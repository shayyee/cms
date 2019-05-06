<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/14
 * Time: 9:37
 */

namespace Home\Model;
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
        $list = $this->_db->where($condition)
            ->order('share_id desc')->limit($offset,$pageSize)->select();
        return $list;
    }
    public function getSharesCount($condition=array()){
        $count = $this->_db->where($condition)->Count();
        return $count;
    }
    
}