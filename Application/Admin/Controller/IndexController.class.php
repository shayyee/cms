<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    /**
     * 主页视图
     */
    public function index(){
//        if(!session('adminUser')) {
//            $this->redirect('/Admin/Login/index');
//        }
        $usertype = session('userType');
        if($usertype == null) {
            $this->redirect('/Admin/Login/index');
        }
        $username = getLoginUsername();
        $studentCount = M('student')->Count();
        $teacherCount = M('teacher')->Count();
        $hwCount = M('homework')->Count();
        $shareCount = M('share')->Count();
        $counts = array(
            'student'=>$studentCount,
            'teacher'=>$teacherCount,
            'hw'=>$hwCount,
            'share'=>$shareCount
        );
        $this->assign('counts',$counts);
        $this->assign('username', $username);
        $this->assign('usertype', $usertype);
        $this->display();
    }

    /**
     * 菜单视图
     */
    public function left(){
        $this->display();
    }

    /**
     * 顶部视图
     */
    public function top(){
        $this->display();
    }

    /**
     * 内容区视图
     */
    public function main(){
        $this->display();
    }

}