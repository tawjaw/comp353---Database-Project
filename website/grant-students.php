<?php
    require_once 'session.php';
   require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>


    <link type="text/css" rel="stylesheet" href="stylesheet2.css" /> 
    <title> All Courses</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="filter.js"></script>
    
    </head>

<body>
    <!-- NAVIGATION BAR BEGINS -->
    <div class="navibar">
        <ul>
            <ul style="float: left; list-style-type:none">
                <li> <a href="index.php">My Better Concordia</a></li>
            </ul>
          <li class="first"><a class="active" href="">Courses </a></li>
          <li><a href="research.php">Research</a></li>
           <li><a href="journals.php">Journals</a></li>
            <ul style="float: right; padding-right: 15px; list-style-type:none"> 
                <li> <a href="personal-information.php"><?php echo $_SESSION['name']; ?></a></li>
                <li> <a href="index.php?logOut=true"> Log Out</a>  </li>
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
			/*  $sql= mysql_query("(SELECT (Select name from student where SupervisedResearch.studentID=student.studentID) as Name, startDate, endDate, amount
									FROM SupervisedResearch
									WHERE SupervisedResearch.researchID=$nb)
								");
								
			  $grantmoney= mysql_query("Select grantID, amount, name, RemainingAmount from ResearchGrant where
												(SELECT grantID FROM SupervisedResearch where SupervisedResearch.researchID=$nb ORDER BY grantID LIMIT 1)=ResearchGrant.grantID");
								
				$research=mysql_query("SELECT name from Research where researchID=$nb");
				$row3 = mysql_fetch_row($research); */

				$nbresearch=mysql_query("SELECT DISTINCT researchID from SupervisedResearch where grantID=$nb");
				//$row4 = mysql_fetch_row($research);
				echo"<center><h1>  Grant details:</h1>";
				echo "<br>".mysql_num_rows($nbresearch)." research are linked to this grant"; 
				
				
				
//$row4 = mysql_query("SELECT DISTINCT researchID from SupervisedResearch where grantID=$nb");
for($i=0; $i<mysql_num_rows($nbresearch);$i++){
while($row4 = mysql_fetch_array($nbresearch,MYSQL_ASSOC))
{
	
	$nb=$row4['researchID'];
	$sql= mysql_query("(SELECT (Select name from student where SupervisedResearch.studentID=student.studentID) as Name, startDate, endDate, amount
									FROM SupervisedResearch
									WHERE SupervisedResearch.researchID=$nb)
								");
								
			  $grantmoney= mysql_query("Select grantID, amount, name, RemainingAmount from ResearchGrant where
												(SELECT grantID FROM SupervisedResearch where SupervisedResearch.researchID=$nb ORDER BY grantID LIMIT 1)=ResearchGrant.grantID");
								
				$research=mysql_query("SELECT name from Research where researchID=$nb");
				$row3 = mysql_fetch_row($research);
	
    while($row2 = mysql_fetch_array($grantmoney,MYSQL_ASSOC)){
    
    echo"<center><p><br><br><br>"."Research ID#:".$row4['researchID']. "<br>";
	echo "Research name: ".$row3['0']. "<br>". "<br>";  
	//echo "Grant ID#: ".$row2['grantID']. "<br>";
	//echo "Grant details: ".$row2['name']. "<br>". "<br>";
	//echo "Grant Money attributed to this entire project: ". "<br>";
   // echo "Total Amount: ".$row2['amount']."$". "<br>";
	//echo "Remaining Amount: ".$row2['RemainingAmount']."$". "<br>";}
	
    echo mysql_num_rows($sql)." students actually have grants for this research";        
            
    echo"</p>";
								
								
			//echo "<b><center>";
			//echo mysql_num_rows($sql);
			//echo "<b>"." students actually have grants for this research";
			//echo "<center>";
			//echo "<table border='20' height='100' width='900' cellspacing='3' cellpadding='3'>
			echo "
			<table style='margin:auto;padding-top:30px;'>
			<tr id='Headings'><td colspan=5 style='font-size:20px;padding-bottom:10px;'><center></center></td></tr>
			<tr id='Headings'>
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
}
}	
}	
	?>	
		
		
        <p id="clickers"> 
            <a href="research.php" > Back  </a>
        </p>
        
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 

</body>
</html>
