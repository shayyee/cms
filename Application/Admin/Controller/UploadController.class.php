<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/28
 * Time: 9:36
 */

namespace Admin\Controller;

use Org\Util\PHPZip;
use Think\Controller;
use Think\Exception;
use Think\Upload;
use Workerman\Protocols\Http;

class UploadController extends BaseController
{
    private $_uploadObj;

    public function __construct()
    {
        $this->_uploadObj = new \Think\Upload();
        $config = getConfig();
        $root = $config['upload'];
        $this->_uploadObj->rootPath = './' . $root . '/';
        $this->_uploadObj->maxSize = 0;// 不限大小
    }

    public function ajaxuploadimage()
    {
        $config = getConfig();
        $root = $config['upload'];
        $this->_uploadObj->subName = $config['avatar'];
        $name = date("YmdHis", time());
        $this->_uploadObj->saveName = $name;

        $res = $this->_uploadObj->upload();
        if ($res) {
            $data = '/' . $root . '/' . $res['file']['savepath'] . $res['file']['savename'];
//            var_dump($data); //string(33) "/Uploads/avatar/58b632b1cbd05.jpg"
            $path = oss_upload($data);
            return show(1, '上传成功', $path);
        } else {
            return show(0, '上传失败', '');
        }
    }

    public function uploadexcel()
    {
        $config = getConfig();
        $root = $config['upload'];
        $this->_uploadObj->subName = 'excel';
        $name = date("YmdHis", time());
        $this->_uploadObj->saveName = $name;

        $res = $this->_uploadObj->upload();
        if ($res) {
            $data = './' . $root . '/' . $res['file']['savepath'] . $res['file']['savename'];
            return show(1, '上传成功', $data);
        } else {
            return show(0, '上传失败', '');
        }
    }

    public function uploadkindeditor()
    {
        $config = getConfig();
        $root = $config['upload'];

        $this->_uploadObj->subName = 'editor_img';
        $name = date("YmdHis", time());
        $this->_uploadObj->saveName = $name;
        $res = $this->_uploadObj->upload();

        if ($res === false) {
            return showKind(1, '上传失败');
        } else {
            $data = '/' . $root . '/' . $res['imgFile']['savepath'] . $res['imgFile']['savename'];
            $path = oss_upload($data);
            return showKind(0, $path);
        }
    }

    public function uploadshare()
    {
        $config = getConfig();
        $root = $config['upload'];
        $this->_uploadObj->subName = $config['share'];
//        $this->_uploadObj->saveName = '';
        $name = date("YmdHis", time());
        $this->_uploadObj->saveName = $name;

        $res = $this->_uploadObj->upload();
//        return show(1,'上传成功','');

//        var_dump($res);
        set_time_limit(0);

        ini_set("max_execution_time", 3600);

        if ($res) {
            $data = '/' . $root . '/' . $res['file']['savepath'] . $res['file']['savename'];
//            var_dump($data); //string(33) "/Uploads/avatar/58b632b1cbd05.jpg"
            try {
                $path = oss_all_upload($data);

            } catch (Exception $e) {
                return show(0, '上传失败', $e->getMessage());

            }
//            var_dump($path);
            return show(1, '上传成功', $path);
        } else {
            return show(0, '上传失败', '');
        }
    }

    public function downAll()
    {
        $hwid = intval($_POST['hwid']);
        $classid = intval($_POST['classid']);

        $files = D('Donehw')->getPathsByHwid($hwid);
        if(count($files)==0){
            echo "<script>alert('该作业下暂无附件')</script>";
        }else {
            $zip_files = array();
            for ($i = 0; $i < count($files); $i++) {
                $str1 = explode('?', $files[$i]['path']);
                $str2 = explode('/', $str1[0]);
                $str3 = explode('.', $str2[2]);
                $str4 = explode('.', $str2[5]);
                $endpoint = $str3[1] . "." . $str3[2] . "." . $str3[3];
                $bucket = $str3[0];
                $object = $str2[3] . "/" . $str2[4] . "/" . $str2[5];
                $zip_files[$i]['endpoint'] = $endpoint;
                $zip_files[$i]['bucket'] = $bucket;
                $zip_files[$i]['object'] = $object;
                $zip_files[$i]['sno'] = $files[$i]['sno'];
                $zip_files[$i]['suffix'] = $str4[1];

            }
//            p($zip_files);
            $hwinfo = D('Homework')->getHomeworkById($hwid);
//        p($hwinfo['title']);
            $classinfo = D('Class')->getClassById($classid);
            $classname = preg_replace('/\(.*?\)/', '', $classinfo['classname']);
            $zip = new PHPZip();
            $zipfilename = date('Ymd') . "-" . $hwinfo['title'] . "(" . $classname . ")";
            $zip->ZipOSSFile($zip_files, $zipfilename);
        }
    }



}