<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/13
 * Time: 19:20
 */

namespace Think;


class Slb
{
    private static $_weightArray = array();

    private static $_i = -1;//代表上一次选择的服务器
    private static $_gcd;//表示集合S中所有服务器权值的最大公约数
    private static $_cw = 0;//当前调度的权值
    private static $_max;
    private static $_n;//agent个数

    public function __construct(array $weightArray)
    {
        self::$_weightArray = $weightArray;
        self::$_gcd = self::getGcd(self::$_weightArray);
        self::$_max = self::getMaxWeight(self::$_weightArray);
        self::$_n = count($weightArray);
    }

    private static function getGcd(array $weightArray)
    {
        $temp = array_shift($weightArray);
        $min = $temp['weight'];
        $status = false;
        foreach ($weightArray as $val) {
            $min = min($val['weight'],$min);
        }

        if($min == 1){
            return 1;
        }else{

            for ($i = $min; $i>1; $i--) {

                foreach ($weightArray as $val) {
                    if (is_int($val['weight']/$i)) {
                        $status = true;
                    }else{
                        $status = false;
                        break;
                    }
                }
                if ($status) {
                    return $i;
                }else {
                    return 1;
                }

            }
        }

    }

    private static  function getMaxWeight(array $weightArray)
    {
        if(empty($weightArray)){
            return false;
        }
        $temp = array_shift($weightArray);
        $max = $temp['weight'];
        foreach ($weightArray as $val) {
            $max = max($val['weight'],$max);
        }
        return $max;
    }

    public function getWeight()
    {

        while (true){

            self::$_i = ((int)self::$_i+1) % (int)self::$_n;

            if (self::$_i == 0) {

                self::$_cw = (int)self::$_cw - (int)self::$_gcd;
                if (self::$_cw <= 0) {
                    self::$_cw = (int)self::$_max;

                    if (self::$_cw == 0) {
                        return null;
                    }
                }
            }

            if ((int)(self::$_weightArray[self::$_i]['weight']) >= self::$_cw) {
                var_dump(self::$_cw);
                return self::$_weightArray[self::$_i];
            }
        }
    }

}