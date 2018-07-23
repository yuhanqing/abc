<?php

use \app\base\DB;

include './config/config.php';
include './config/kernel.php';

$tpl = new \app\base\Template();

$mysqli = DB::getDB();
$sql = 'SELECT * FROM cms_users';

$result = $mysqli->query($sql);

print_r($result);

DB::unDB($result, $mysqli);

echo '换行';
print_r($result); //没了
