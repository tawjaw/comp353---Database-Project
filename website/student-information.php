<?php
    require_once 'session.php';
   require_once 'config.php';

?>
<!DOCTYPE html>
<html>
<head>

    <link type="text/css" rel="stylesheet" href="stylesheet2.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="support.js"></script>
    <title> Student Information</title>
</head>
<body>
    <!-- NAVIGATION BAR BEGINS -->
    <div class="navibar">
        <ul>
            <ul style="float: left; list-style-type:none">
                <li> <a href="index.php">My Better Concordia</a></li>
            </ul>
          <li class="first"><a href="all-courses.php">Courses </a></li>
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
    <?php
        $sql  = "SELECT * FROM Student WHERE studentID='".$_GET['studentID']."';";

        $result = mysql_query($sql, $link);

        if (! $result) {
         die('Could not get data: ' . mysql_error());
        } 
    
        else{
        $value=mysql_fetch_assoc($result);
        }
    ?>
     <h1>  Student Information : </h1>
        <p> 
            Student Name:
           <span style="font-weight: bold"> 
              <?php echo $value['name']; ?></span> <br>
            Student ID: <span style="font-weight: bold"> <?php echo $value['studentID']; ?></span><br>
            Email: <span style="font-weight: bold"> <?php echo $value['email']; ?></span><br>
            Domicile Status: <span style="font-weight: bold"> <?php if($value['internationality']=="Yes") echo "International"; else echo "Local"; ?></span><br>
            Level : <span style="font-weight: bold"> <?php echo $value['position']; ?> </span><br>
            <?php
                if($value['active']=="Yes")
                    echo "Academic Standing : <span style='font-weight: bold'>".$value['status']."</span><br>";
                else
                {
                    echo "Academic Standing : <span style='font-weight: bold'>Graduated</span><br>";
                    echo "Work : <span style='font-weight: bold'>".$value['work']."</span><br>";

                }

            ?>
            
            
        
         
        </p>
        
        
        
        
        
        <table>
            <tr id="Headings">
                <td> Classes Taken</td>
                <td> Final Grade </td>
            </tr>
             <?php 
                     $sql  = "SELECT c.code,c.name,e.finalGrade,e.sectionID,e.courseID , t.teacherID FROM EnrolledIn e, Course c, Teaches t WHERE e.courseID= t.courseID and e.sectionID = t.sectionID and e.courseID=c.courseID AND e.studentID='".$_GET['studentID']."';";
 
                      $result = mysql_query($sql, $link);
 
                  if (! $result) {
                      die('Could not get data: ' . mysql_error());
                 } 
                 else if(mysql_num_rows($result)==0)
                {
                     echo "<tr><td>None</td></tr>";
                }
                 else{
                     while($row = mysql_fetch_array($result,MYSQL_ASSOC))
                     {
                         echo "<tr><td>";
                         if($row["teacherID"] == $_SESSION['teacherID'])
                            echo"<a href='viewclass.php?courseID=".$row["courseID"]."&sectionID=".$row["sectionID"]."'>";
                     echo $row["code"]."&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;".$row["name"]."</a></td><td>".$row["finalGrade"]."</td></tr>";
                     
                     }
                 }
             ?>
            
        </table>
        
        <br>
        <br>
        
        
        <table id='financialAid'>
        
            <tr id="Headings">
                <td> Financial Aid Recieved</td>
                <td> Research</td>
                <td> Date</td>
            </tr>
            
           <?php 
                     $sql  = "SELECT r.name,s.amount,s.startDate,s.endDate FROM SupervisedResearch s, Research r WHERE s.researchID=r.researchID AND s.studentID='".$_GET['studentID']."';";
 
                      $result = mysql_query($sql, $link);
 
                  if (! $result) {
                      die('Could not get data: ' . mysql_error());
                 } 
                 else if(mysql_num_rows($result)==0)
                {
                     echo "<tr><td>None</td></tr>";
                }
                 else{
                     while($row = mysql_fetch_array($result,MYSQL_ASSOC))
                     {
                     //echo "<tr><td><a href='viewclass.php?courseID=".$row["courseID"]."&sectionID=".$row["sectionID"]."'>".$row["code"]."&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;".$row["name"]."</a></td><td>".$row["finalGrade"]."</td></tr>";
                     echo "<tr><td class='support'>".$row["amount"]."$ </td><td>".$row["name"]."</td><td>".$row["startDate"]." Until ".$row["endDate"]."</td></tr>";
                     }
                 }
             ?>
        </table>
        <div id='supportGiven'><p>Total&nbsp;&nbsp;&nbsp;</p><p id='total'></p></div>
        
        <p id="clickers">
           
            <a href="javascript:history.back()">Go Back</a>
            

        </p>
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 

</body>
</html>
