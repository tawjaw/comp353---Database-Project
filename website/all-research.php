<?php
    require_once 'session.php';
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

     <h1><center>  All the research from school:</h1>
	 
	 

  <?php     
  require_once('config.php');
  $sql= mysql_query("SELECT researchID,name,details FROM Research ORDER BY researchID");
  
  if($sql)
	{
		echo "<b><center>";
		echo "<b>"." There exists ".mysql_num_rows($sql)." research records.";
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
	?>	
		
        
        <p id="clickers"> 
            <a href="research.php" > Back </a>
        </p>
        
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 

</body>
</html>
