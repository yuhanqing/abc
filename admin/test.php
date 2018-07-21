<?php

    use \app\base\DB;

    require '../config/kernel.php';

    $assign = array('name' => 'IFTY');
    $tpl->run($assign, 'index.php');

    $manage = DB::getDB();

    $sql = 'SELECT * FROM cms_users';
    $result = $manage->query($sql);

    print_r($result->fetch_row());
