<?php
/**
 * Created by PhpStorm.
 * User: yuhanqing
 * Date: 2018/7/21
 * Time: 下午10:49
 */

namespace app\controllers;

use app\models\Manage;
use app\models\Role;
use app\base\Tool;
use app\base\Validate;

class RoleController extends Controller
{

    public function __construct(&$tpl)
    {
        parent::__construct($tpl);
        $this->model = new Role();
        $this->action();
        $this->tpl->run($this->assign, 'role.php');
    }

    //业务流程控制器
    private function action()
    {
        switch ($_GET['action']) {
            case 'show':
                $this->show();
                break;
            case 'add':
                $this->add();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                Tool::alertBack('非法操作！');
        }
    }

    private function show()
    {
        $this->assign['show']       = true;
        $this->assign['title']      = '等级列表';
        $this->assign['allRoles'] = $this->model->getRole();
    }

    private function add()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['roleName'])) {
                Tool::alertBack('警告：等级名不得为空！');
            }
            if (Validate::checkLength($_POST['roleName'], 2, 'min')) {
                Tool::alertBack('警告：等级名不得小于两位！');
            }
            if (Validate::checkLength($_POST['roleName'], 20, 'max')) {
                Tool::alertBack('警告：等级名不得大于20位！');
            }
            if (Validate::checkNull($_POST['roleSort'])) {
                Tool::alertBack('警告：排序不得为空！');
            }
            if (Validate::checkNum($_POST['roleSort'])) {
                Tool::alertBack('警告：排序填写错误！');
            }
            $this->model->roleName        = $_POST['roleName'];
            if ($this->model->getOneRole()) {
                Tool::alertBack('警告：此等级名已被占用！');
            }
            $this->model->roleSort        = $_POST['roleSort'];
            if ($this->model->getOneRole()) {
                Tool::alertBack('警告：此排序已被占用！');
            }
            $this->model->roleDescription = $_POST['roleDescription'];
            if ($this->model->addRole()) {
                Tool::alertLocation('恭喜你，新增等级成功！', 'role.php?action=show');
            } else {
                Tool::alertBack('很遗憾，新增等级失败！');
            }
        }
        $this->assign['add']   = true;
        $this->assign['title'] = '新增等级';
    }

    private function update()
    {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['roleName'])) {
                Tool::alertBack('警告：等级名不得为空！');
            }
            if (Validate::checkLength($_POST['roleName'], 2, 'min')) {
                Tool::alertBack('警告：等级名不得小于两位！');
            }
            if (Validate::checkLength($_POST['roleName'], 20, 'max')) {
                Tool::alertBack('警告：等级名不得大于20位！');
            }
            if (Validate::checkNull($_POST['roleSort'])) {
                Tool::alertBack('警告：排序不得为空！');
            }
            if (Validate::checkNum($_POST['roleSort'])) {
                Tool::alertBack('警告：排序填写错误！');
            }
            $this->model->id              = $_POST['roleId'];
            $this->model->roleName        = $_POST['roleName'];
            $this->model->roleSort        = $_POST['roleSort'];
            $this->model->roleDescription = $_POST['roleDescription'];
            $this->model->updateRole() ? Tool::alertLocation('恭喜你，修改管理员成功！', 'role.php?action=show') :
                Tool::alertBack('很遗憾，修改管理员失败！');
        }
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            is_array($this->model->getOneRole()) ? true : Tool::alertBack('等级参数有误！');
            $this->assign['roleId']          = $this->model->getOneRole()['role_id'];
            $this->assign['roleName']        = $this->model->getOneRole()['role_name'];
            $this->assign['roleSort']        = $this->model->getOneRole()['role_sort'];
            $this->assign['roleDescription'] = $this->model->getOneRole()['role_description'];
            $this->assign['update']   = true;
            $this->assign['title']    = '修改等级';
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    private function delete()
    {
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            $manage = new Manage();
            $manage->id = $this->model->id;
            if ($manage->getOneManage()) {
                Tool::alertBack('警告：此等级已有管理员使用！无法删除！请先删除相关用户！');
            }
            $this->model->deleteRole() ?
                Tool::alertLocation('恭喜你，删除等级成功！', 'role.php?action=show') :
                Tool::alertBack('很遗憾，删除等级失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
        $this->assign['title'] = '删除等级';
    }
}
