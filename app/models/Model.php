<?php
/**
 * Created by PhpStorm.
 * User: yuhanqing
 * Date: 2018/7/22
 * Time: 上午12:44
 */

namespace app\models;

use app\base\DB;

class Model
{
    //查找总记录模型
    protected function total($sql)
    {
        $db = DB::getDB();
        $result = $db->query($sql);
        $total = $result->fetch_row();
        DB::unDB($result, $db);
        return $total[0];
    }

    protected function one($sql)
    {
        $db = DB::getDB();
        $result = $db->query($sql);
        $array = $result->fetch_array(MYSQLI_ASSOC);
        DB::unDB($result, $db);
        return $array;
    }

    protected function all($sql)
    {
        $db = DB::getDB();
        $result = $db->query($sql);
        $html = array();
        while (!!$array = $result->fetch_array(MYSQLI_ASSOC)) {
            $html[] = $array;
        }
        DB::unDB($result, $db);
        return $html;
    }

    protected function aud($sql)
    {
        $db = DB::getDB();
        $db->query($sql);
        $affectedRows = $db->affected_rows;
        DB::unDB($result = null, $_db);
        return $affectedRows;
    }
}
