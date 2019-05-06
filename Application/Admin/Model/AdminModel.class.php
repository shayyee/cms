<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/9
 * Time: 11:18
 */
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model{

    private $_db = '';
    public function __construct() {
        $this->_db = M('admin');
    }

    public function getAdminByUsername($username){
        $condition['username'] = $username;
        $data = $this->_db->where($condition)->find();
     //   var_dump($data);
        return $data;
    }
    public function getAdminByAdminId($adminId=0) {
        $res = $this->_db->where('admin_id='.$adminId)->find();
        return $res;
    }

    public function updateByAdminId($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('admin_id='.$id)->save($data); // 根据条件更新记录
    }

    public function insert($data = array()) {
        if(!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }
    
    public function deleteByAdminId($id){
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        return  $this->_db->where('admin_id='.$id)->delete(); // 根据条件删除记录
    }
    
    public function getAdmins($condition,$pageIndex,$pageSize=10) {
//        $data = array(
//            'status' => array('neq',-1),
//        );
//        return $this->_db->where($data)->order('admin_id desc')->select();
        $condition['status']  = array('in','0,1');
        $offset = ($pageIndex - 1) * $pageSize;//起始位置
        $list = $this->_db->where($condition)->order('admin_id desc')->limit($offset,$pageSize)->select();
        return $list;
    }
    public function getAdminsCount($condition=array()){
        $condition['status']  = array('in','0,1');
        $count = $this->_db->where($condition)->count();
        return $count;
    }

    /**
     * 通过id更新的状态
     * @param $id
     * @param $status
     * @return bool
     */
//    public function updateStatusById($id, $status) {
//        if(!is_numeric($status)) {
//            throw_exception("status不能为非数字");
//        }
//        if(!$id || !is_numeric($id)) {
//            throw_exception("ID不合法");
//        }
//        $data['status'] = $status;
//        return  $this->_db->where('admin_id='.$id)->save($data); // 根据条件更新记录
//
//    }

    public function getLastLoginUsers() {
        $time = mktime(0,0,0,date("m"),date("d"),date("Y"));
        $data = array(
            'status' => 1,
            'lastlogintime' => array("gt",$time),
        );

        $res = $this->_db->where($data)->count();
        return $res['tp_count'];
    }
}