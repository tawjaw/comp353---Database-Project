<?php
	ini_set('session.save_path','tmp');
	session_start();

if(!isset($_SESSION["teacherID"])){
        header("Location: login.php");
}

if(isset($_GET['logOut'])){
	session_destroy();
    header("Location: login.php");

}
 

?>