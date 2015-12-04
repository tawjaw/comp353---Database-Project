<?php
 	ini_set('session.save_path','tmp');
	session_start();
   $failedLogin=false;

  if(isset($_SESSION["teacherID"])){
        header("Location: index.php");

   }



   function userCheck(){

   	require_once('config.php');
   	

	 $email=$_POST["email"];
   	 $password=$_POST["password"];

	$sql  = "SELECT teacherID, name FROM Teacher WHERE email='".$email."' AND password='".$password."';";

	$result = mysql_query($sql, $link);
	global $failedLogin;

	if (! $result) {
	   die('Could not get data: ' . mysql_error());
	} 
	else if(mysql_num_rows($result)==0)
	{
		$failedLogin=true;
	}
	else{
		$value=mysql_fetch_assoc($result);
        $_SESSION['teacherID']=$value["teacherID"];
        $_SESSION['name']=$value["name"];
        $failedLogin=false;
        mysql_close($link);
        header("Location: index.php");
    }

   }
   if(isset($_POST["submit"]))
   {
   userCheck();
   }

?>

<html>

    <head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" /> 
    </head>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,500' rel='stylesheet' type='text/css'>
    
<body>




	<section id="login">
	<h2> Welcome:</h2>
	<form id=" form1" method="post" class="classA" action="login.php">
		<label for="username">
			Email: <br>
			<input type="text" name="email" id ="username" placeholder= "Enter your Username"/>
			</label>

		<label for= "password">
			Password: <br>
			<input type="password" name="password" id ="password" placeholder= "Enter your Password"	/>
			</label>
		<input id="button" type="submit" name="submit"> </input>		
		<?php
			if($failedLogin)
				echo "<div id='failedLogin'><p>*Error. Please Enter Valid Credentials.</p></div>"
		?>
		</form>
		</section>
		



    </body>
</html>





