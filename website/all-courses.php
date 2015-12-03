<!DOCTYPE html>
<html>
<head>

<?php
require_once 'config.php';
//TODO $_GET["teacherID"]
$teacherID =1;
?>
    <link type="text/css" rel="stylesheet" href="stylesheet2.css" /> 
    <title> All Courses</title>
</head>
<body>
    <!-- NAVIGATION BAR BEGINS -->
    <div class="navibar">
        <ul>
            <ul style="float: left; list-style-type:none">
                <li> <a href="#about">My Better Concordia</a></li>
            </ul>
          <li class="first"><a class="active" href="#home">Courses </a></li>
          <li><a href="#news">Research</a></li>
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
    
     <h1>  All Courses taught so far: </h1>
        <p> 
            These are the courses you have taught since the beginning of your time here. 
         
        </p>
        
        <table>
            <tr id="Headings">
                <td> Course Name </td>
                <td> Course Code</td>
                <td> Course Credit</td>
                <td> Semester</td>
                <td> Year</td>
                <td> enrolled</td>
                <td> capacity</td>
            </tr>
            <?php
            $sql = "select  
Course.courseID as CourseID, Course.name as courseName, Course.code as courseCode, Course.credits as courseCredits, 
Section.sectionID as sectionID, Section.semester as sectionSemester, Section.year as sectionYear,  Section.capacity as sectionCapacity,
(select count(*) from enrolledin where enrolledin.courseID = Course.courseID and enrolledin.sectionID = Section.sectionID) as enrolled 
from  Course, Section where (Course.courseID , Section.sectionID) IN (select courseID, sectionID from Teaches where teacherID = ".$teacherID.");
";
           mysql_select_db($database);
           $result = mysql_query($sql, $link);
           
           if(! $result)
           {
               die('Could not get data:  ' . mysql_error());
           }
           
           while($row = mysql_fetch_array($result,MYSQL_ASSOC))
           {
               echo "<tr>";
               echo '<td><a href="viewclass.php?courseID='.$row["CourseID"].'&sectionID='.$row["sectionID"].'">'. $row["courseName"]. '</a></td>';
               echo '<td>' .$row["courseCode"] .'</td>';
               echo '<td>' .$row["courseCredits"] . '</td>';
               echo '<td>' .$row["sectionSemester"] .'</td>';
               echo '<td>' .$row["sectionYear"] .'</td>';
               echo '<td>' .$row["enrolled"] .'</td>';
               echo '<td>' .$row["sectionCapacity"] . '</td>';
               echo '</tr>';
           }
           ?>
        </table>
           
        
        <p id="clickers">
            <a href="Current-term-courses.html"> View only Current Term courses</a>
            <a href="javascript:history.back()">Go Back</a>
            

        </p>
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 

</body>
</html>
