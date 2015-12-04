<!DOCTYPE html>
<?php
require_once('session.php');
require_once 'config.php';
$courseID = $_GET["courseID"];
$sectionID = $_GET["sectionID"];
?>
<html>
<head>

    <link type="text/css" rel="stylesheet" href="stylesheet2.css" /> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="grades.js"></script>
    <title> View Class Information</title>
</head>

<body>
    <!-- NAVIGATION BAR BEGINS -->
    <div class="navibar">
        <ul>
            <ul style="float: left; list-style-type:none">
                <li> <a href="index.php">My Better Concordia</a></li>
            </ul>
          <li class="first"><a class="active" href="all-courses.php">Courses </a></li>
          <li><a href="research.php">Research</a></li>
          <li><a href="journal-landing-page.php">Journals</a></li>
            <ul style="float: right; padding-right: 15px; list-style-type:none"> 
                 <li> <a href="personal-information.php"><?php echo $_SESSION['name']; ?></a></li>
                <li> <a href="all-courses.php?logOut=true"> Log Out</a>  </li>
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
                echo"<td><a href='student-information.php?studentID=".$row_student_info['sID']."''>" .$row_student_info["sName"]."</a></td>";
                echo"<td>" .$row_student_info["sStatus"]."</td>";
                echo"<td>" .$row_student_info["sPosition"]."</td>";
                echo"<td>" .$row_student_info["sInternationality"]."</td>";
                echo'<td><a href="mailto:'.$row_student_info["sEmail"].'">'.$row_student_info["sEmail"]."</td>";
                echo"<td>" .$row_student_info["sFinalGrade"]."</td>";
                
                echo"<td class='gradeShow' >
                <a >Grades</a>
                <table class='grades'>
                <tr id='Headings'>
                <td>Component</td>
                <td>Weight</td>
                <td>Mark</td></tr>";
                $sql_grades = "select Grade.grade as grade, CourseComponent.type as type, CourseComponent.weight as weight
                                FROM Grade, CourseComponent 
                                where Grade.studentID =".$row_student_info["sID"].
                                " and Grade.courseID =".$courseID. 
                                " and Grade.sectionID =" .$sectionID.
                                " and Grade.courseComponentID = CourseComponent.courseComponentID 
                                and Grade.coursecomponentID IN 
                                (select courseComponentID FROM CourseComponent 
                                WHERE sectionID =".$sectionID." and courseID =".$courseID." );";
                $result_grades = mysql_query($sql_grades, $link);
                if(!$result_grades){die('Could not get data:  ' . mysql_error());}
                  else if(mysql_num_rows($result_grades)==0)
                {
                     echo "<tr><td>None</td></tr>";
                }
                else
                {
                while($row_grades = mysql_fetch_array($result_grades,MYSQL_ASSOC))
                {
                    echo "<tr><td>".$row_grades["type"]."</td>
                    <td>".$row_grades["weight"]."</td>
                    <td>".$row_grades["grade"]."</td></tr>";
                }
                }
                echo"</table></td>";
                //<tr><td>Assingment 1</td><td>80%</td></tr><tr><td>Final Exam</td><td>100%</td></tr></table></td>";
                echo "";
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
