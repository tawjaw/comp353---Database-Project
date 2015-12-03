<!DOCTYPE html>
<html>
<head>

    <link type="text/css" rel="stylesheet" href="stylesheet2.css" /> 
    <title> View Class Information</title>
</head>
<?php
require_once 'config.php';
$courseID = $_GET["courseID"];
$sectionID = $_GET["sectionID"];
?>
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
    <?php
    $sql_section_info = "SELECT Course.courseID as courseID, 
    Course.name as courseName, Course.code as courseCode, 
    Course.credits as courseCredits, 
    Section.sectionID as sectionID, Section.semester as sectionSemester,
    Section.year as sectionYear,  Section.capacity as sectionCapacity,
    (select count(*) 
            FROM enrolledin 
            WHERE enrolledin.courseID = ".$courseID." AND enrolledin.sectionID =" .$sectionID.") 
            AS enrolled 
    FROM Course, Section
    WHERE Course.courseID = " .$courseID. " AND Section.sectionID = " .$sectionID." AND Section.courseID = Course.courseID;";
    
    $result_section_info = mysql_query($sql_section_info, $link);
    if(!$result_section_info)
    {
        die('Could not get data:  ' . mysql_error());
    }
    $row_section_info = mysql_fetch_array($result_section_info, MYSQL_ASSOC);
    echo '<div class="jai-prakash">';
    
     echo '<h1>' .$row_section_info["courseCode"]."  ".$row_section_info["courseName"]. "</h1>";
        echo"<p>"; 
            echo "Section: ".$row_section_info["sectionID"]. 
            " ".$row_section_info["sectionSemester"]." ".
            $row_section_info["sectionYear"]."<br>";
            
            echo "Capacity: " .$row_section_info["sectionCapacity"]. "<br>";
            echo "Enrolled: ".$row_section_info["enrolled"]."<br>";
            
         
        echo "</p>";
        $sql_student_info ="SELECT
                E.studentID AS sID, E.FinalGrade as sFinalGrade, S.name AS sName, 
                S.status AS sStatus, S.position AS sPosition, 
                S.internationality AS sInternationality, S.email as sEmail
                FROM Enrolledin AS E, Student AS S
                WHERE E.CourseID =".$courseID." AND E.SectionID = ".$sectionID." AND E.studentID = S.StudentID;";
        $result_student_info = mysql_query($sql_student_info, $link);
        if(!$result_student_info){die('Could not get data:  ' . mysql_error());}
        echo "<table>";
            echo'<tr id="Headings">';
                echo"<td> ID</td>";
                echo"<td> Name</td>";
                echo"<td> Status</td>";
                echo"<td> Position</td>";
                echo"<td> Internationality</td>";
                echo"<td> Email</td>";
                echo"<td> Final Letter Grade</td>";
            echo"</tr>";  
            while($row_student_info = mysql_fetch_array($result_student_info,MYSQL_ASSOC))
            {
            echo"<tr>";
            //TODO 
            //add hyperlink to student name to student page with passing ID
            //add hyperlink to view grades to grade page with student course and section ID
                echo"<td>" .$row_student_info["sID"]."</td>";
                echo"<td>" .$row_student_info["sName"]."</td>";
                echo"<td>" .$row_student_info["sStatus"]."</td>";
                echo"<td>" .$row_student_info["sPosition"]."</td>";
                echo"<td>" .$row_student_info["sInternationality"]."</td>";
                echo'<td><a href="mailto:'.$row_student_info["sEmail"].'">'.$row_student_info["sEmail"]."</td>";
                echo"<td>" .$row_student_info["sFinalGrade"]."</td>";
                echo"<td>Grades</td>";
            }
        echo"</table>";
        
        
      ?>
        
        <p id="clickers">
           
            <a href="javascript:history.back()">Go Back</a>
            

        </p>
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 

</body>
</html>
