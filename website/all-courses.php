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
    
     <h1>  All Courses </h1>
        <p> 
            These are the courses you have taught since the beginning of your time here. 
         
        </p>
         <!--- FILTER BEGINS ---> 
       <div class="filter2">
                <div id="divD">
                   <center> <a id= "filterD" href=""> Filters</a> </center>   </div>
                   <center>
                    <form class="filter3" id='FilterForm' name='FilterForm' method='post' action='all-course.php'>
                       
                        
                        <span style="font-weight: bold">  From Year: </span> 
                           <form name="yearFROM" action = "" method ="get">
                                <input type="text" name="formal" id ='yearFROM' onchange='javascript:handle_fy(this)'>  <br> <br>
                            </from>
                        
                   
                        
                        

                      
                        
                        <span style="font-weight: bold">    To Year: </span> 
                        <input type="text" name="toYear" onchange = 'javascript:handle_ty(this)'>  <br> <br>

                        <span style="font-weight: bold"> Course Name: </span>                    
                        <input type ="text" name = "Course Name" onchange='javascript:handle_cn(this)'>
                        
                        <input id="button" type="submit" class="button" name="submit" onclick ='javascript:clickButton()'> </input>	
                        
                              <script type="text/javascript">
                            
                            var fy = null
                           
                            var ty = null
                            var cn = null
	                       
                               
                               function handle_fy(elm)
	                          {
	                           fy = 'fy='+elm.value;
	                           }
                               function handle_ty(elm)
	                          {
	                           ty = 'ty='+elm.value;
	                           }
                               function handle_cn(elm)
	                          {
	                           cn = 'cn='+elm.value;
	                           }
                           function clickButton()
                           {
                                    var link ="";
                                   if(!(ty == null) || !(fy == null) || !(cn == null))
                                   {
                                       if(!(ty == null))
                                            link = link +ty;
                                       if(!(fy == null))
                                            link = link + '&'+fy;
                                       if(!(cn == null))
                                            link = link + '&'+cn;
                                       window.location = 'all-courses.php?'+link;
                                   }
                                   
                               
                               
                           }
	                           </script>  	
</form> 
           </center> 
            <br> 
                
        </div>
        
    
    <!-- FILTER ENDS --> 
        
        <table style='margin:auto;'>
            <tr id="Headings">
                <td> Course Name </td>
                <td> Course Code</td>
                <td> Course Credit</td>
                <td> Semester</td>
                <td> Year</td>
                <td> Enrolled</td>
                <td> Capacity</td>
                <td> Average Grade</td>
            </tr>
            <?php
            
            $sqlMaxAverage = "SELECT  MAX(Section.averageGrade) as max
                      
                        FROM  Course, Section 
                        WHERE Section.courseID = Course.courseID"; 
                          if(isset($_GET['fy']) ? (int) $_GET['fy'] : null)
                            {
                                
                                    {$sqlMaxAverage = $sqlMaxAverage. " AND section.year >= ".$_GET['fy'];}
                                }
                       
                            if(isset($_GET['ty']) ? (int) $_GET['ty'] : null)
                            {$sqlMaxAverage = $sqlMaxAverage. " AND section.year <= ".$_GET['ty'];}
                       
                        if(isset($_GET["cn"]))
                            {$sqlMaxAverage = $sqlMaxAverage. " AND Course.code = '".$_GET['cn']."'";}
                                    
                        $sqlMaxAverage = $sqlMaxAverage .
                        " AND (Course.courseID , Section.sectionID) 
                            IN (SELECT courseID, sectionID 
                            FROM Teaches 
                            WHERE teacherID = ".$_SESSION['teacherID'].");";
                $resultMaxAverage = mysql_query($sqlMaxAverage, $link);
           
           if(! $resultMaxAverage)
           {
               die('Could not get data:  ' . mysql_error());
           }
           
           while($rowMaxAverage = mysql_fetch_array($resultMaxAverage,MYSQL_ASSOC))
           {
               $MaxAverage = $rowMaxAverage["max"];
           }
            $sql = "SELECT Course.courseID as courseID, Course.name as courseName,
                    Course.code as courseCode, Course.credits as courseCredits, 
                    Section.sectionID as sectionID, Section.semester as sectionSemester, 
                    Section.year as sectionYear,  Section.capacity as sectionCapacity,
                    Section.averageGrade as AverageGrade,
                    (select count(*) 
                        FROM enrolledin 
                        WHERE enrolledin.courseID = Course.courseID and enrolledin.sectionID = Section.sectionID) 
                        as enrolled 
                        FROM  Course, Section 
                        WHERE Section.courseID = Course.courseID";
                        if(isset($_GET['fy']) ? (int) $_GET['fy'] : null)
                            {
                                
                                    {$sql = $sql. " AND section.year >= ".$_GET['fy'];}
                                }
                       
                            if(isset($_GET['ty']) ? (int) $_GET['ty'] : null)
                            {$sql = $sql. " AND section.year <= ".$_GET['ty'];}
                       
                        if(isset($_GET["cn"]))
                            {$sql = $sql. " AND Course.code = '".$_GET['cn']."'";}
                                    
                        $sql = $sql ." AND (Course.courseID , Section.sectionID) 
                        IN (SELECT courseID, sectionID 
                            FROM Teaches 
                            WHERE teacherID = ".$_SESSION['teacherID'].");
                     ";
          
         
           $result = mysql_query($sql, $link);
           
           if(! $result)
           {
               die('Could not get data:  ' . mysql_error());
           }
           
           while($row = mysql_fetch_array($result,MYSQL_ASSOC))
           {
               echo "<tr>";
               echo '<td><a href="viewclass.php?courseID='.$row["courseID"].'&sectionID='.$row["sectionID"].'">'. $row["courseName"]. '</a></td>';
               echo '<td>' .$row["courseCode"] .'</td>';
               echo '<td>' .$row["courseCredits"] . '</td>';
               echo '<td>' .$row["sectionSemester"] .'</td>';
               echo '<td>' .$row["sectionYear"] .'</td>';
               echo '<td>' .$row["enrolled"] .'</td>';
               echo '<td>' .$row["sectionCapacity"] . '</td>';
               echo '<td>' .$row["AverageGrade"]. '</td>';
               if((int)$row["AverageGrade"] == (int)$MaxAverage)
                    {echo"<td> <font color = 'red'>Maximum Average</td>";}
               echo '</tr>';
           }
           ?>
        </table>
           
        
        <p id="clickers">
            
            <a href="javascript:history.back()">Go Back</a>
            

        </p>
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 

</body>
</html>
