<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/19
 * Time: 9:58
 */

namespace app\base;

use mysqli;

class DB
{
    //获取对象句柄
    public static function getDB()
    {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (mysqli_connect_errno()) {
            echo '数据库连接错误！错误代码：'.mysqli_connect_error();
            exit();
        }
        $mysqli->set_charset('utf8');
        return $mysqli;
    }

    public static function query($sql)
    {
        self::getDB()->query($sql);
    }

    public static function affectRows()
    {
        self::getDB()->affected_rows;
    }

    //清理
    public static function unDB(&$result, &$db)
    {
        if (is_object($result)) {
            $result->free();
            $result = null;
        }
        if (is_object($db)) {
            $db->close();
            $db = null;
        }
    }
}
