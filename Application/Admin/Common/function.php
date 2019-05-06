<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/9
 * Time: 11:10
 */

function getLoginUsername() {
    $usertype = $_SESSION['userType'];
    if($usertype==1){
        return $_SESSION['adminUser']['username'];
    }else{
        return $_SESSION['teacherUser']['realname'];
    }
    
}
function status($status) {
    if($status == 0) {
        $str = '禁用';
    }elseif($status == 1) {
        $str = '正常';
    }else{
        $str = '状态异常';
    }
    return $str;
}


function isThumb($thumb) {
    if($thumb) {
        return '<span style="color:red">有</span>';
    }
    return '无';
}


function getIssueById($id){
    $issue = C("COURSE_ISSUE");
    return $issue[$id] ? $issue[$id] : '';
}

/**
 * @param $file excel文件路径
 * @return $j int 插入数据库的条数
 */
function import_teacher($file)
{
    $type = pathinfo($file);
    $type = strtolower($type["extension"]);
    if ($type == 'xlsx') {
        $type = 'Excel2007';
    } elseif ($type == 'xls') {
        $type = 'Excel5';
    }
    Vendor('PHPExcel.PHPExcel');
    // 判断使用哪种格式
    $objReader = \PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file);
    $sheet = $objPHPExcel->getSheet(0);
    // 取得总行数
    $highestRow = $sheet->getHighestRow();
    // 取得总列数
    $highestColumn = $sheet->getHighestColumn();
    //循环读取excel文件,读取一条,插入一条
    $data = array();
    $j = 0;
    //从第i行开始读取数据
    for ($i = 2; $i <= $highestRow; $i++) {
        $data['username'] = $objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
        $password = $objPHPExcel->getActiveSheet()->getCell("B" . $i)->getValue();
        $data['password'] = getMd5Password($password);
        $data['realname'] = $objPHPExcel->getActiveSheet()->getCell("C" . $i)->getValue();
        $data['college'] = $objPHPExcel->getActiveSheet()->getCell("D" . $i)->getValue();
        $data['qq'] = $objPHPExcel->getActiveSheet()->getCell("E" . $i)->getValue();
        if (D('Teacher')->getTeacherByUsername($data['username'])||!$data) {
            continue;
        } else {
            D('Teacher')->insert($data);
            $j++;
        }
    }
    unlink($file);
    return $j;
}
function import_student($file)
{
    $type = pathinfo($file);
    $type = strtolower($type["extension"]);
    if ($type == 'xlsx') {
        $type = 'Excel2007';
    } elseif ($type == 'xls') {
        $type = 'Excel5';
    }
    Vendor('PHPExcel.PHPExcel');
    // 判断使用哪种格式
    $objReader = \PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file);
    $sheet = $objPHPExcel->getSheet(0);
    // 取得总行数
    $highestRow = $sheet->getHighestRow();
    // 取得总列数
    $highestColumn = $sheet->getHighestColumn();
    //循环读取excel文件,读取一条,插入一条
    $data = array();
    $j = 0;
    //从第i行开始读取数据
    for ($i = 2; $i <= $highestRow; $i++) {
        $data['sno'] = $objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
        $password = $objPHPExcel->getActiveSheet()->getCell("B" . $i)->getValue();
        $data['password'] = getMd5Password($password);
        $data['realname'] = $objPHPExcel->getActiveSheet()->getCell("C" . $i)->getValue();
        if (D('Student')->getStudentBySno($data['sno'])||!$data) {
            continue;
        } else {
            D('Student')->insert($data);
            $j++;
        }
    }
    unlink($file);
    return $j;
}
function import_course($file)
{
    $type = pathinfo($file);
    $type = strtolower($type["extension"]);
    if ($type == 'xlsx') {
        $type = 'Excel2007';
    } elseif ($type == 'xls') {
        $type = 'Excel5';
    }
    Vendor('PHPExcel.PHPExcel');
    // 判断使用哪种格式
    $objReader = \PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file);
    $sheet = $objPHPExcel->getSheet(0);
    // 取得总行数
    $highestRow = $sheet->getHighestRow();
    // 取得总列数
    $highestColumn = $sheet->getHighestColumn();
    //循环读取excel文件,读取一条,插入一条
    $data = array();
    $j = 0;
    //从第i行开始读取数据
    for ($i = 2; $i <= $highestRow; $i++) {
        $data['cno'] = $objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
        $data['name'] = $objPHPExcel->getActiveSheet()->getCell("B" . $i)->getValue();
        $teachername = $objPHPExcel->getActiveSheet()->getCell("C" . $i)->getValue();
        $teacher = D('Teacher')->getTeacherByRealname($teachername);
        if(!$teacher){
            $data['t_id'] = 0;
        }else{
            $data['t_id'] = $teacher['t_id'];
        }
        if (D('Course')->isCno($data['cno'])||!$data) {
            continue;
        } else {
            D('Course')->insert($data);
            $j++;
        }
    }
    unlink($file);
    return $j;
}
