<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/19
 * Time: 11:34
 */

namespace app\models;

use app\base\DB;
use app\base\Tool;

class Manage
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $userLevel;

    //拦截器(__set)
    public function __set($key, $value)
    {
        $this->$key = $value;
    }

    //拦截器(__get)
    public function __get($key)
    {
        return $this->$key;
    }

    //查询单个管理员
    public function getOneManage()
    {
        $db = DB::getDB();
        $sql = "SELECT user_id,user_name,user_email,role_id FROM cms_users WHERE user_id='$this->id' LIMIT 1";
        $result = $db->query($sql);
        $array = $result->fetch_array(MYSQLI_ASSOC);
        DB::unDB($result, $db);
        return $array;
    }

    //查询所有管理员
    public function getManage()
    {
        $db     = DB::getDB();
        $sql    = 'SELECT u.user_id,u.user_name,u.user_email,u.created_at,u.updated_at,r.role_name,r.role_sort
                    FROM cms_users AS u,cms_roles AS r 
                    WHERE u.role_id=r.role_id 
                    ORDER BY r.role_sort ASC';
        $result = $db->query($sql);
        $html   = array();
        while ($object = $result->fetch_array(MYSQLI_ASSOC)) {
            $html[] = $object;
        }
        DB::unDB($_result, $_db);
        return $html;
    }

    //添加管理员
    public function addManage()
    {
        $db  = DB::getDB();
        $sql = "INSERT INTO cms_users (user_name,user_pass,role_id,user_email,created_at,updated_at) 
				 VALUES ('$this->username', '$this->password','$this->userLevel','$this->email',NOW(),NOW())";
        $db->query($sql);
        $affectedRows = $db->affected_rows;
        DB::unDB($_result = null, $db);
        return $affectedRows;
    }

    //修改管理员
    public function updateManage()
    {
        $db = DB::getDB();
        $sql = "UPDATE cms_users 
                  SET user_pass='$this->password',user_email='$this->email',role_id='$this->userLevel',updated_at=NOW()
                  WHERE user_id='$this->id' 
                  LIMIT 1";
        $db->query($sql);
        $affectedRows = $db->affected_rows;
        DB::unDB($_result = null, $_db);
        return $affectedRows;
    }

    public function deleteManage()
    {
        $db = DB::getDB();
        $sql ="DELETE FROM cms_users WHERE user_id='$this->id' LIMIT 1";
        $db->query($sql);
        $affectedRows = $db->affected_rows;
        DB::unDB($result = null, $db);
        return $affectedRows;
    }
}
