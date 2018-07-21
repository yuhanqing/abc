<?php
/**
 * Created by PhpStorm.
 * User: yuhanqing
 * Date: 2018/7/21
 * Time: 下午10:49
 */

namespace app\controllers;

use \app\models\Manage;
use \app\base\Tool;

class ManageController extends Controller
{

    public function __construct(&$tpl)
    {
        parent::__construct($tpl, new Manage());
        $this->action();
        $this->tpl->run($this->assign, 'manage.php');
    }

    //业务流程控制器
    private function action()
    {
        switch ($_GET['action']) {
            case 'list':
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
        $this->assign['list']       = true;
        $this->assign['title']      = '管理员列表';
        $this->assign['allManages'] = $this->model->getManage();
    }

    private function add()
    {
        if (isset($_POST['send'])) {
            $this->model->username  = $_POST['username'];
            $this->model->password  = sha1($_POST['userPass']);
            $this->model->email     = $_POST['userEmail'];
            $this->model->userLevel = $_POST['roleId'];
            if ($this->model->addManage()) {
                Tool::alertLocation('恭喜你，新增管理员成功！', 'manage.php?action=list');
            } else {
                Tool::alertBack('很遗憾，新增管理员失败！');
            }
        }
        $this->assign['add']   = true;
        $this->assign['title'] = '新增管理员';
    }

    private function update()
    {
        if (isset($_POST['send'])) {
            $this->model->id        = $_POST['userId'];
            $this->model->password  = sha1($_POST['adminPass']);
            $this->model->email     = $_POST['userEmail'];
            $this->model->userLevel = $_POST['roleId'];
            $this->model->updateManage() ? Tool::alertLocation('恭喜你，修改管理员成功！', 'manage.php?action=list') :
                Tool::alertBack('很遗憾，修改管理员失败！');
        }
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            is_array($this->model->getOneManage()) ? true : Tool::alertBack('管理员参数有误！');
            $this->assign['userId']   = $this->model->getOneManage()['user_id'];
            $this->assign['username'] = $this->model->getOneManage()['user_name'];
            $this->assign['roleId']   = $this->model->getOneManage()['role_id'];
            $this->assign['email']    = $this->model->getOneManage()['email'];
            $this->assign['update']   = true;
            $this->assign['title']    = '修改管理员';
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    private function delete()
    {
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            $this->model->deleteManage() ?
                Tool::alertLocation('恭喜你，删除管理员成功！', 'manage.php?action=list') :
                Tool::alertBack('很遗憾，删除管理员失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
        $this->assign['title'] = '删除管理员';
    }

}
