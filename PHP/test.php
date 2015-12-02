<?php

$server_name = 'localhost::3306';
$user = 'root';
$pass = 'tawjaw39';

$link = mysql_connect($server_name, $user, $pass);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo "Connected successfully" . "<br>";



$sql  = "SELECT * FROM teacher";
mysql_select_db('comp353_db');

$result = mysql_query($sql, $link);

if (! $result) {
   die('Could not get data: ' . mysql_error());
} 

$HomePageLink =  "localhost:1024/home.php";
 // output data of each row
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
 {
     echo "id: " . $row["teacherID"]. " - Name: " . '<a href="' . $HomePageLink.'">'. $row["name"].'</a>' .  " " . "<br>";
 }
mysql_close($link);
?>