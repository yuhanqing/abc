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
    private $tpl;
    private $id;
    private $username;
    private $password;
    private $email;
    private $userLevel;

    public function __construct(&$tpl)
    {
        $this->tpl = $tpl;
        $this->action();
    }

    //业务流程控制器
    private function action()
    {
        switch ($_GET['action']) {
            case 'list':
                $assign['list']       = true;
                $assign['title']      = '管理员列表';
                $assign['allManages'] = $this->getManage();
                break;
            case 'add':
                if (isset($_POST['send'])) {
                    $this->username  = $_POST['username'];
                    $this->password  = sha1($_POST['userPass']);
                    $this->email     = $_POST['userEmail'];
                    $this->userLevel = $_POST['roleId'];
                    if ($this->addManage()) {
                        Tool::alertLocation('恭喜你，新增管理员成功！', 'manage.php?action=list');
                    } else {
                        Tool::alertBack('很遗憾，新增管理员失败！');
                    }
                }
                $assign['add']   = true;
                $assign['title'] = '新增管理员';
                break;
            case 'update':
                if (isset($_POST['send'])) {
                    $this->id        = $_POST['userId'];
                    $this->password  = sha1($_POST['adminPass']);
                    $this->email     = $_POST['userEmail'];
                    $this->userLevel = $_POST['roleId'];
                    $this->updateManage() ? Tool::alertLocation('恭喜你，修改管理员成功！', 'manage.php?action=list') :
                                            Tool::alertBack('很遗憾，修改管理员失败！');
                }
                if (isset($_GET['id'])) {
                    $this->id = $_GET['id'];
                    is_array($this->getOneManage()) ? true : Tool::alertBack('管理员参数有误！');
                    $assign['userId']   = $this->getOneManage()['user_id'];
                    $assign['username'] = $this->getOneManage()['user_name'];
                    $assign['roleId']   = $this->getOneManage()['role_id'];
                    $assign['email']    = $this->getOneManage()['email'];
                    $assign['update']   = true;
                    $assign['title']    = '修改管理员';
                } else {
                    Tool::alertBack('非法操作！');
                }

                break;
            case 'delete':
                if (isset($_GET['id'])) {
                    $this->id = $_GET['id'];
                    $this->deleteManage() ?
                            Tool::alertLocation('恭喜你，删除管理员成功！', 'manage.php?action=list') :
                            Tool::alertBack('很遗憾，删除管理员失败！');
                } else {
                    Tool::alertBack('非法操作！');
                }
                $assign['title'] = '删除管理员';
                break;
            default:
                $assign['title'] = '非法操作';
        }
        $this->tpl->run($assign, 'manage.php');
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
