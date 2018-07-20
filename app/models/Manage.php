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
                $assign['list'] = true;
                $assign['title'] = '管理员列表';
                $assign['AllManages'] = Manage::getManage();
                break;
            case 'add':
                if (isset($_POST['send'])) {
                    $this->username  = $_POST['user_name'];
                    $this->password  = sha1($_POST['user_pass']);
                    $this->email     = $_POST['user_email'];
                    $this->userLevel = $_POST['role_id'];
                    if ($this->addManage()) {
                        Tool::alertLocation('恭喜你，新增管理员成功！', 'manage.php?action=list');
                    } else {
                        Tool::alertBack('很遗憾，新增管理员失败！');
                    }
                }
                $assign['add'] = true;
                $assign['title'] = '新增管理员';
                break;
            case 'update':
                $assign['update'] = true;
                $assign['title'] = '修改管理员';
                break;
            case 'delete':
                $assign['delete'] = true;
                $assign['title'] = '删除管理员';
                break;
            default:
                $assign['title'] = '非法操作';
        }
        $this->tpl->run($assign, 'manage.php');
    }

    public static function getManage()
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

    public function updateManage()
    {
    }

    public function deleteManage()
    {
    }
}
