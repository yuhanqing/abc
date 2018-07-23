<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/19
 * Time: 11:34
 */

namespace app\models;

class Manage extends Model
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
        $sql = "SELECT user_id,user_name,user_email,role_id FROM cms_users WHERE user_id='$this->id' LIMIT 1";
        return parent::one($sql);
    }

    //查询所有管理员
    public function getManage()
    {

        $sql    = 'SELECT u.user_id,u.user_name,u.user_email,u.created_at,u.updated_at,r.role_name,r.role_sort
                    FROM cms_users AS u,cms_roles AS r 
                    WHERE u.role_id=r.role_id 
                    ORDER BY r.role_sort ASC';
        return parent::all($sql);
    }

    //添加管理员
    public function addManage()
    {

        $sql = "INSERT INTO cms_users (user_name,user_pass,role_id,user_email,created_at,updated_at) 
				 VALUES ('$this->username', '$this->password','$this->userLevel','$this->email',NOW(),NOW())";
        return parent::aud($sql);
    }

    //修改管理员
    public function updateManage()
    {
        $sql = "UPDATE cms_users 
                  SET user_pass='$this->password',user_email='$this->email',role_id='$this->userLevel',updated_at=NOW()
                  WHERE user_id='$this->id' 
                  LIMIT 1";
        return parent::aud($sql);
    }

    public function deleteManage()
    {
        $sql ="DELETE FROM cms_users WHERE user_id='$this->id' LIMIT 1";
        return parent::aud($sql);
    }

    //查询所有的等级
    public function getAllLevel()
    {
        $_sql = "SELECT role_id,role_name FROM cms_roles ORDER BY role_sort ASC";
        return parent::all($_sql);
    }
}
