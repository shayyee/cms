<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/28
 * Time: 9:36
 */

namespace Home\Controller;

use Think\Controller;
use Think\Upload;

class UploadController extends Controller
{
    private $_uploadObj;
    
    public function __construct() {
        $this->_uploadObj = new \Think\Upload();
        $config = getConfig();
        $root = $config['upload'];
        $this->_uploadObj->rootPath = './'.$root.'/';
        $this->_uploadObj->maxSize = 0 ;// 不限大小
    }
    public function ajaxuploadimage() {
        $config = getConfig();
        $root = $config['upload'];
        $this->_uploadObj->subName = $config['avatar'];
        $name = date("YmdHis",time());
        $this->_uploadObj->saveName = $name;

        $res = $this->_uploadObj->upload();
        if($res) {
            $data = '/' .$root . '/' . $res['file']['savepath'] . $res['file']['savename'];
//            var_dump($data); //string(33) "/Uploads/avatar/58b632b1cbd05.jpg"
            $path = oss_upload($data);
            return show(1,'上传成功',$path);
        }else{
            return show(0,'上传失败','');
        }
    }

    public function uploadhw(){
        $config = getConfig();
        $root = $config['upload'];
        $this->_uploadObj->subName = $config['homework'];
        $name = date("YmdHis",time());
        $this->_uploadObj->saveName = $name;

        $res = $this->_uploadObj->upload();
//        var_dump($res);
        if($res) {
            $data = '/' .$root . '/' . $res['file']['savepath'] . $res['file']['savename'];
//            var_dump($data); //string(33) "/Uploads/avatar/58b632b1cbd05.jpg"
            $path = oss_slb_upload($data);
            return show(1,'上传成功',$path);
        }else{
            return show(0,'上传失败','');
        }
    }

    public function uploadkindeditor(){
        $config = getConfig();
        $root = $config['upload'];

        $this->_uploadObj->subName = 'editor_img';
        $name = date("YmdHis",time());
        $this->_uploadObj->saveName = $name;
        $res = $this->_uploadObj->upload();

        if($res===false) {
            return showKind(1,'上传失败');
        }else{
            $data = '/' .$root . '/' . $res['imgFile']['savepath'] . $res['imgFile']['savename'];
            $path = oss_upload($data);
            return showKind(0,$path);
        }
    }

    public function downloadshare(){
        if($_POST){
            $object = $_POST['info'];
            $buckets = M('bucket')->select();
            $index = downslb();
            $bucket = $buckets[$index]['bucketname'];
            $endpoint = $buckets[$index]['endpoint'];
            $url = getSignUrl($endpoint,$bucket,$object);
            if($url){
                return show(1,'连接获取成功',$url);
            }else{
                return show(0,'链接获取失败','');
            }
        }
    }


    public function downloadhw(){
        if($_POST){
            $info = explode(',',$_POST['info']);
            $url = getSignUrl($info[0],$info[1],$info[2]);
            if($url){
                return show(1,'连接获取成功',$url);
            }else{
                return show(0,'链接获取失败','');
            }
        }
    }
}