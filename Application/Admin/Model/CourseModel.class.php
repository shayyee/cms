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
class CourseModel extends Model
{
    private $_db = '';
    public function __construct() {
        $this->_db = M('Course');
    }


    public function getCourses($condition,$pageIndex,$pageSize=10) {
        $offset = ($pageIndex - 1) * $pageSize;//起始位置
        $list = $this->_db->table('cms_course c')->where($condition)
            ->join('LEFT JOIN cms_teacher AS t ON c.t_id = t.t_id')
            ->field('c.course_id,c.cno,c.name,c.picpath,t.realname')
            ->where($condition)->order('course_id desc')->limit($offset,$pageSize)->select();
        return $list;
    }
    public function getCoursesCount($condition=array()){
        $count = $this->_db->where($condition)->Count();
        return $count;
    }
    public function getCoursesList(){
        return $this->_db->select();
    }
    public function getCoursesListByTid($tid){
        return $this->_db->where('t_id='.$tid)->select();
    }

    public function insert($data = array()){
        if(!is_array($data) || !data){
            return 0;
        }

        return $this->_db->add($data);
    }

    public function isCno($cno){
        $condition['cno'] = $cno;
        $res = $this->_db->where($condition)->find();
        return $res;
    }

    public function getCourseById($cid=0) {
        $res = $this->_db->where('course_id='.$cid)->find();
        return $res;
    }
    public function getCourseByTid($tid){
        return $this->_db->where('t_id='.$tid)->find();
    }
    public function updateById($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('course_id='.$id)->save($data); // 根据条件更新记录
    }

    public function deleteById($id){
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        return  $this->_db->where('course_id='.$id)->delete(); // 根据条件删除记录
    }
    
}