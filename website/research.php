<?php
    require_once('session.php');
   require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>

    <link type="text/css" rel="stylesheet" href="stylesheet2.css" /> 
    <title> Research </title>
</head>
<body>
    <!-- NAVIGATION BAR BEGINS -->
    <div class="navibar">
        <ul>
            <ul style="float: left; list-style-type:none">
                <li> <a href="#about">My Better Concordia</a></li>
            </ul>
          <li class="first"><a href="sans-bootstrap.html">Courses </a></li>
          <li><a class ="active" href="#">Research</a></li>
          <li><a href="#contact">Journals</a></li>
            <ul style="float: right; padding-right: 15px; list-style-type:none"> 
                <li> <a href=""> Personal Information </a></li>
                <li> <a href=""> Log Out</a>  </li>
            </ul>
        </ul>
        
    </div>
    
    <!--- NAVIGATION BAR ENDS --->
    
    <br> <br> <br>
    
    
    <!--- MAIN CONTENT BOX BEGINS --->
    
    <div class="jai-prakash">
    
     <h1><center>  Here is your research portfolio!</h1>
  <?php  
//RESEARCHES BY TEACHER LOGGED IN  
  require_once('config.php');
  $tid= $_SESSION["teacherID"];
  $sql= mysql_query("SELECT Research.researchID,Research.name,Research.details FROM Research,Teacher WHERE Teacher.teacherID=$tid and Teacher.teacherID=Research.teacherID");
  if($sql)
	{
		echo "<b><center>";
		echo "<b>"." Your name is associated with ".mysql_num_rows($sql)." research.";
		echo "<center>";
		echo "<table border='20' height='100' width='900' cellspacing='3' cellpadding='3' >
		<tr>
		<th>Research ID</th>
		<th>Name</th>
		<th>Details</th>
		</tr>";
		//display the results
		while($row = mysql_fetch_array($sql,MYSQL_ASSOC))
		{
			echo "<tr>";
			$admno=$row['researchID'];
			echo "<td>"."<center>".$row['researchID']."</td>";
			echo "<td>"."<center>".$row['name']."</td>";
			echo "<td>"."<center>".$row['details']."</td>";
			echo "<td>";
			echo "<center><a href='research-students.php?admno=$admno&edit=Search'>Details</a>";
			echo "</td>";
			echo "</tr>";
		}
	}
echo "</table></center>";

//GRANTS FOR TEACHER LOGGED IN
  $tid= $_SESSION["teacherID"];
  $sql= mysql_query("  SELECT grantID, name, amount, RemainingAmount 
						FROM ResearchGrant 
						Where grantID IN  (SELECT grantID from GivenGrant where teacherID=3) ");
						


  if($sql)
	{
		echo "<br>"."<br>"."<b><center>";
		echo "<b>"." Your name is associated with ".mysql_num_rows($sql)." grants.";
		echo "<center>";
		echo "<table border='20' height='100' width='900' cellspacing='3' cellpadding='3' >
		<tr>
		<th>Grant ID</th>
		<th>Name</th>
		<th>Total Amount</th>
		<th>Remaining Amount</th>
		</tr>";
		//display the results
		while($row = mysql_fetch_array($sql,MYSQL_ASSOC))
		{
			echo "<tr>";
			$admno=$row['grantID'];
			echo "<td>"."<center>".$row['grantID']."</td>";
			echo "<td>"."<center>".$row['name']."</td>";
			echo "<td>"."<center>".$row['amount']."</td>";
			echo "<td>"."<center>".$row['RemainingAmount']."</td>";
			echo "<td>";
			echo "<center><a href='research-students.php?admno=$admno&edit=Search'>Details</a>";
			echo "</td>";
			echo "</tr>";
		}
	}
echo "</table></center>";



	?>	
		
		
		
		
		<p> 
            Please choose an option from the following list:
         
        </p>
        
        <p id="clickers"> 
            <a href="all-research.php" > View ALL Research </a>
			<a href="all-grant.php" > View ALL Grant information </a>
        </p>
        
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 

</body>
</html>
