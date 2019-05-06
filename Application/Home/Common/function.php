<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 11:19
 */
function getLoginRealname() {
    $user = $_SESSION['studentUser'];
    if($user){
        return $_SESSION['studentUser']['realname'];
    }
}
function delBrackets($str){
    return preg_replace('/\(.*?\)/', '', $str);
}
