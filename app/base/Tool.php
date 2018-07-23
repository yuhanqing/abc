<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/20
 * Time: 14:36
 */

namespace app\base;

class Tool
{
    //弹窗跳转
    public static function alertLocation($info, $url)
    {
        echo "<script type='text/javascript'>alert('$info');location.href='$url';</script>";
        exit();
    }

    //弹窗返回
    public static function alertBack($info)
    {
        echo "<script type='text/javascript'>alert('$info');history.back();</script>";
        exit();
    }
}
