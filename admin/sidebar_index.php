<?php

    require '../config/kernel.php';

    $assign = array('name' => 'IFTY');

    $tpl->run($assign, 'sidebar_index.php');
