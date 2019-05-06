<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/1
 * Time: 13:18
 */

namespace Admin\Controller;
use Think\Controller;

class CommonController extends BaseController
{
    public function index(){
        $ossConfig = C('ALIOSS_CONFIG');
        $ossPaths = C('NEED_UPLOAD_OSS');
        $boot = C('UPLOAD');
        $pageSize = C('PAGESIZE');
        $userName = getLoginUsername();
        $this->assign('config',$ossConfig);
        $this->assign('paths',$ossPaths);
        $this->assign('user',$userName);
        $this->assign('boot',$boot);
        $this->assign('pagesize',$pageSize);
        $this->display();
    }

    public function save(){
        if($_POST){
            if($_POST['id']) {
                C('ALIOSS_CONFIG.KEY_ID',$_POST['id']);
            }
            if($_POST['secret']) {
                C('ALIOSS_CONFIG.KEY_SECRET',$_POST['secret']);
            }
            if($_POST['endpoint']) {
                C('ALIOSS_CONFIG.END_POINT',$_POST['endpoint']);
            }
            if($_POST['bucket']) {
                C('ALIOSS_CONFIG.BUCKET',$_POST['bucket']);
            }
            if($_POST['boot']) {
                var_dump($_POST['boot']);
                C('UPLOAD',$_POST['boot']);
            }
            if($_POST['avatar']) {
                C('NEED_UPLOAD_OSS.AVATAR',$_POST['avatar']);
            }
            if($_POST['homework']) {
                C('NEED_UPLOAD_OSS.HOMEWORK',$_POST['homework']);
            }
            if($_POST['share']) {
                C('NEED_UPLOAD_OSS.SHARE',$_POST['share']);
            }
            if($_POST['pagesize']) {
                var_dump($_POST['pagesize']);
                C('PAGESIZE',intval($_POST['pagesize']));
            }
            if($_POST['issue']) {
                array_push(C('COURSE_ISSUE'),$_POST['issue']);

            }
            return show(1,"配置成功");
        }
    }
}