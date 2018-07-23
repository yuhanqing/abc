<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/19
 * Time: 11:34
 */

namespace app\models;

class Role extends Model
{
    private $id;
    private $roleName;
    private $roleSort;
    private $roleDescription;

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

    //查询单个
    public function getOneRole()
    {
        $sql = "SELECT role_id,role_name,role_sort,role_description FROM cms_roles 
                 WHERE role_id='$this->id' OR role_name='$this->roleName' OR role_sort='$this->roleSort' LIMIT 1";
        return parent::one($sql);
    }

    //查询所有
    public function getRole()
    {

        $sql = "SELECT * FROM cms_roles ORDER BY role_sort ASC ";
        return parent::all($sql);
    }

    //添加
    public function addRole()
    {

        $sql = "INSERT INTO cms_roles (role_name,role_sort,role_description) 
				 VALUES ('$this->roleName', '$this->roleSort','$this->roleDescription')";
        return parent::aud($sql);
    }

    //修改
    public function updateROle()
    {
        $sql = "UPDATE cms_roles 
                  SET role_name='$this->roleName',role_sort='$this->roleSort',role_description='$this->roleDescription'
                  WHERE role_id='$this->id' 
                  LIMIT 1";
        return parent::aud($sql);
    }

    //删除
    public function deleteRole()
    {
        $sql ="DELETE FROM cms_roles WHERE role_id='$this->id' LIMIT 1";
        return parent::aud($sql);
    }

}
