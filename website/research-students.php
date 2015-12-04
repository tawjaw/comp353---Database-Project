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
	
	 //  <!--- MAIN CONTENT BOX BEGINS --->
     <div class="jai-prakash">
 <?php  
       	
require_once('config.php');


		
	if(isset($_GET['edit']))
		{
			$nb=mysql_real_escape_string($_GET['admno']);
			  $sql= mysql_query("(SELECT (Select name from student where SupervisedResearch.studentID=student.studentID) as Name, startDate, endDate, amount
									FROM SupervisedResearch
									WHERE SupervisedResearch.researchID=$nb)
								");
								
			  $grantmoney= mysql_query("Select amount from ResearchGrant where
												(SELECT grantID FROM SupervisedResearch where SupervisedResearch.researchID=$nb ORDER BY grantID LIMIT 1)=ResearchGrant.grantID");
								
	
    

    while($row2 = mysql_fetch_array($grantmoney,MYSQL_ASSOC)){
    echo"<h1>  Students enrolled in this research:</h1>";
    echo"<p>"."Project ID#: $nb ". "<br>";
    echo"Total Amount of Grant Money attributed to this entire project: ".$row2['amount']."$";}
            
            
    echo"</p><p></p>";
								
								
			echo "<b><center>";
			echo mysql_num_rows($sql);
			echo "<b>"." students actually have grants for this research";
			echo "<center>";
			echo "<table border='20' height='100' width='900' cellspacing='3' cellpadding='3'>
			<tr>
			<th>Name</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Grant Amount Attributed ($)</th>
			</tr>";
		//And we display the results
		while($row = mysql_fetch_array($sql,MYSQL_ASSOC))
		{
			echo "<tr bgcolor='#E5F4F4'>";
			//$admno=$row['student_id'];
			echo "<td>"."<center>".$row['Name']."</td>";
			echo "<td>"."<center>".$row['startDate']."</td>";
			echo "<td>"."<center>".$row['endDate']."</td>";
			echo "<td>"."<center>".$row['amount']."</td>";
			//echo "<td>";
			//echo "<center><a href='edit_user_by_id.php?admno=$admno&edit=Search'>Edit details</a>";
			//echo "</td>";
			echo "</tr>";
		}
		echo "</table></center>";
	}
		
	?>	
		
		
        <p id="clickers"> 
            <a href="" > View list of all grants received  </a>
            <a href="" > View List of grants you have dispersed </a>
           <a href ="" > View research you're involved in</a>
            < a href ="" > View list of students under your supervision</a>
        </p>
        
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 

</body>
</html>
