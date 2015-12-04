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
    

    
    <!--- MAIN CONTENT BOX BEGINS --->
    
    <div class="jai-prakash">

     <h1><center>  Students you supervised:</h1>
	
         <!--- FILTER BEGINS ---> 

       <div class="filter2">
                <div id="divD">
                   <center> <a id= "filterD" href=""> Filters</a> </center>   </div>
                   <center>
                    <form class="filter3">
                       
                        <span style="font-weight: bold">  Filter by Year(yyyy): </span> 
                            <input type="text" name="Year">  <br> <br>
								


                        <span style="font-weight: bold"> Position:     </span>        
                        <select name="Position" style="margin-left: 5px;">
							<option value="allstudents">ALL students</option>
							<option value="Undergraduate"> Undergraduate</option>
                            <option value="Graduate"> Graduate</option>
                            <option value="Masters">Masters</option>
                            <option value="Phd">Phd</option>
							<option value="Other">Other</option>
							
                        </select>
                                           
                        
                        <input id="button" type="submit" name="submit" onSubmit="javascript:handleSelect(this)" > </input>		
</form> 
           </center> 
            <br> 
                
        </div>

	
	 
	<script type="text/javascript">
	function handleSelect(elm)
	{
	window.location = elm.value;
	}
	</script>
  <?php     
  require_once('config.php');
  $tid= $_SESSION["teacherID"];
  
  if(isset($_GET['submit']))
		{
			$pos=mysql_real_escape_string($_GET['Position']);
			$year=mysql_real_escape_string($_GET['Year']);
			if($year!=""){
				$inc_from= $year.'-01-01';
				$inc_to= $year.'-12-31';
				$datefilter= " AND (startdate <= '".$inc_to."' AND enddate >='".$inc_from."') ";//((startdate BETWEEN '".$inc_from."' AND '".$inc_to."') OR (enddate BETWEEN '".$inc_from."' AND '".$inc_to."'))";}
				$year = ' in '.$year;}
			else{$datefilter="";$year='';}
			
			if($pos=="allstudents"){$positionfilter='';$pos='';}
			else{$positionfilter=" AND position = '".$pos."'";}
			
			
		}
  else{$positionfilter='';
		$pos='';
		$datefilter='';
		$year='';}
  
  $sql= mysql_query("SELECT name,position,studentID
						FROM Student
						WHERE studentID IN(SELECT distinct studentID FROM SupervisedResearch WHERE teacherID=$tid $datefilter ORDER BY studentID) $positionfilter ");
  //
  if($sql)
	{
		//echo "<b><center>";
		//echo "<b>"." You supervised ".mysql_num_rows($sql)." $pos students in $year.";
		//echo "<center>";
		echo "
		<table style='margin:auto;padding-top:30px;'>
     	<tr id='Headings'><td colspan=5 style='font-size:20px;padding-bottom:10px;'><center>You supervised ".mysql_num_rows($sql)." $pos students $year.</center></td></tr>
        <tr id='Headings'>
			<th>Name</th>
			<th>Position</th>
		</tr>";
		//display the results
		while($row = mysql_fetch_array($sql,MYSQL_ASSOC))
		{
			echo "<tr>";
			//$admno=$row['studentID'];
			echo "<td>"."<center>".$row['name']."</td>";
			echo "<td>"."<center>".$row['position']."</td>";
	//		$date mysql_query("SELECT startdate, enddate FROM SupervisedResearch WHERE studentID=$row['studentID'] AND researchID= ");
	//		echo "<td>"."<center>".$start=."</td>";
	//		echo "<td>";
			//echo "<center><a href='research-students.php?admno=$admno&edit=Search'>Details</a>";
		//	echo "</td>";
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
