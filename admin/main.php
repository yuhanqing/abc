<?php

    require '../config/kernel.php';

    $assign = array('name' => 'IFTY');

    $tpl->run($assign, 'main.php');
