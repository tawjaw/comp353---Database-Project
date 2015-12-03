<?php

$server_name = '';

$user = '';
$pass = '';
$database = '';
$link = mysql_connect($server_name, $user, $pass);
mysql_select_db($database);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

?>