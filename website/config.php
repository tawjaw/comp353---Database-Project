<?php

$server_name = '';
	$user = '';
	$pass = '';
	$database = '';
	$link = mysql_connect($server_name, $user, $pass);
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}

	mysql_select_db($database);

?>