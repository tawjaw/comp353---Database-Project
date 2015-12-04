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
          <li><a href="#contact">Journals</a></li>
            <ul style="float: right; padding-right: 15px; list-style-type:none"> 
                <li> <a href="personal-information.php"><?php echo $_SESSION['name']; ?></a></li>
                <li> <a href="all-courses.php?logOut=true"> Log Out</a>  </li>
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
                    <form class="filter3">
                       
                        <span style="font-weight: bold"> From Semester: </span>  
                        <select>
                            <option value="Fall"> Fall</option>
                            <option value="Winter"> WInter</option>
                            <option value="Summer1"> Summer 1</option>
                            <option value="Summer2"> Summer 2</option>
                        </select> 
                        <span style="font-weight: bold">  Year: </span> 
                            <input type="text" name="Year">  <br> <br>

                        

                        <span style="font-weight: bold"> To Semester:     </span>        
                        <select style="margin-left: 5px;">
                            <option value="toFall"> Fall</option>
                            <option value="toWinter"> WInter</option>
                            <option value="toSummer1"> Summer 1</option>
                            <option value="toSummer2"> Summer 2</option>
                        </select>
                        
                        <span style="font-weight: bold">    Year: </span> 
                        <input type="text" name="toYear">  <br> <br>

                        <span style="font-weight: bold"> Student Name: </span>                    
                        <input type ="text" name = "Student Name">
                        
                        <input id="button" type="submit" name="submit"> </input>		
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
                <td> enrolled</td>
                <td> capacity</td>
            </tr>
            <?php

            $sql = "SELECT Course.courseID as courseID, Course.name as courseName,
                    Course.code as courseCode, Course.credits as courseCredits, 
                    Section.sectionID as sectionID, Section.semester as sectionSemester, 
                    Section.year as sectionYear,  Section.capacity as sectionCapacity,
                    (select count(*) 
                        FROM enrolledin 
                        WHERE enrolledin.courseID = Course.courseID and enrolledin.sectionID = Section.sectionID) 
                        as enrolled 
                        FROM  Course, Section 
                        WHERE Section.courseID = Course.courseID AND (Course.courseID , Section.sectionID) 
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
