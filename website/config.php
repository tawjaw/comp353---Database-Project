<?php

$server_name = 'localhost::3306';
$user = 'root';
$pass = 'tawjaw39';
$database = 'comp353_db';
$link = mysql_connect($server_name, $user, $pass);
mysql_select_db($database);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
?>