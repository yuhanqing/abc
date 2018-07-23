<?php
/**
 * Created by PhpStorm.
 * User: yuhanqing
 * Date: 2018/7/23
 * Time: 上午8:23
 */

namespace app\base;

class Validate
{
    public static function checkNull($date)
    {
        if (trim($date) == '') {
            return true;
        } else {
            return false;
        }
    }

    public static function checkLength($date, $length, $flag)
    {
        if ($flag == 'min') {
            if (mb_strlen(trim($date), 'utf-8') < $length) {
                return true;
            } else {
                return false;
            }
        } elseif ($flag == 'max') {
            if (mb_strlen(trim($date), 'utf-8') > $length) {
                return true;
            } else {
                return false;
            }

        } else {
            Tool::alertBack('EROOR：参数传递的错误，必须是min,max！');
        }
    }

    public static function checkEquals($date, $otherDate)
    {
        if (trim($date) != trim($otherDate)) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkEmail($date)
    {
        $mode = '\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}';
        if (preg_match($mode, $date)) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkNum($date)
    {
        if (!is_numeric($date) && !strpos($date, '.')) {
            return true;
        } else {
            return false;
        }
    }
}
