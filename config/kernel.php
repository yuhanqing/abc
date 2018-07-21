<?php

    header('Content-Type:text/html;charset=utf-8');

    require '../config/config.php';
    require ROOT_PATH . '/app/base/Template.php';

    $tpl = new \app\base\Template();
    $assign = array();
