<?php
/**
 * Created by PhpStorm.
 * User: yuhanqing
 * Date: 2018/7/21
 * Time: 下午10:58
 */

namespace app\controllers;

class Controller
{
    protected $tpl;
    protected $model;
    protected $assign = array();

    protected function __construct(&$tpl)
    {
        $this->tpl   = $tpl;
    }
}