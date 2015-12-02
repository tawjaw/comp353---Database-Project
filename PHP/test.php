<?php

$server_name = 'localhost::3306';
$user = 'username';
$pass = 'pass';

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
//$id = 5 ;

 // output data of each row
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
 {
     $HomePageLink =  "home.php?id=" . $row["teacherID"];
     echo "id: " . $row["teacherID"]. " - Name: " . '<a href="' . $HomePageLink.'">'. $row["name"].'</a>' .  " " . "<br>";
 }
mysql_close($link);
?>