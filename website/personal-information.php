<?php
    require_once 'session.php';
   require_once 'config.php';

?>
<!DOCTYPE html>
<html>
<head>

    <link type="text/css" rel="stylesheet" href="stylesheet2.css" /> 
    <title> View Class Information</title>
</head>
<body>
    <!-- NAVIGATION BAR BEGINS -->
    <div class="navibar">
        <ul>
            <ul style="float: left; list-style-type:none">
                <li> <a href="sans-bootstrap.php">My Better Concordia</a></li>
            </ul>
          <li class="first"><a  href="all-courses.php">Courses </a></li>
          <li><a href="#news">Research</a></li>
          <li><a href="#contact">Journals</a></li>
            <ul style="float: right; padding-right: 15px; list-style-type:none"> 
                <li> <a class="active" href="personal-information.php"><?php echo $_SESSION['name']; ?></a></li>
                <li> <a href="sans-bootstrap.php?logOut=true"> Log Out</a>  </li>
            </ul>
        </ul>
        
    </div>
    
    <!--- NAVIGATION BAR ENDS --->
    
    <br> <br> <br>
    
    
    <!--- MAIN CONTENT BOX BEGINS --->
    
    <div class="jai-prakash">
    <?php
        $sql  = "SELECT * FROM Teacher WHERE teacherID='".$_SESSION['teacherID']."';";

        $result = mysql_query($sql, $link);

        if (! $result) {
         die('Could not get data: ' . mysql_error());
        } 
    
        else{
        $value=mysql_fetch_assoc($result);
        }
    ?>
     <h1>  Personal Information : </h1>
        <p> 
             Name:
           <span style="font-weight: bold"> 
              <?php echo $value['name'] ?></span> <br>
            Teacher ID: <span style="font-weight: bold"> <?php echo $value['teacherID'] ?> </span><br>
          
            Years : <span style="font-weight: bold"> <?php echo $value['yearsOfService'] ?> </span><br>
            Rank :<span style="font-weight: bold"> <?php echo $value['rank'] ?> </span><br>
           <!-- Joined on :<span style="font-weight: bold">  September 2013 </span> <br>-->
            <br>
            
        
         
        </p>
        
        
        
        
        
        <table>
            <tr id="Headings">
                <td> Classes Taught</td>
            
            </tr>
            <?php 
                    $sql  = "SELECT c.code,c.name FROM Teaches t, Course c WHERE t.courseID=c.courseID AND t.teacherID='".$_SESSION['teacherID']."';";

                     $result = mysql_query($sql, $link);

                 if (! $result) {
                     die('Could not get data: ' . mysql_error());
                } 
    
                else{
                    while($row = mysql_fetch_array($result,MYSQL_ASSOC))
                    {
                    echo "<tr><td>".$row["code"]."</td><td>".$row["name"]."</td></tr>";
                    
                    }
                }
            ?>
            
            
        </table>
        
        <br>
        <br>
        
        
        <table>
        
            <tr id="Headings">
                <td> Committee Associations</td>
                <td> Role</td>
                
            </tr>
            
            <?php 
                    $sql  = "SELECT j.name FROM OnBoardOf o, Journal j WHERE o.journalID=j.journalID AND o.teacherID='".$_SESSION['teacherID']."';";

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
                    echo "<tr><td>".$row["name"]."</td><td>Committee Member</td></tr>";
                    
                    }
                }
            ?>
            
        </table>
        
         <table>
        
            <tr id="Headings">
                <td> Workshops </td>
                <td> Dates Attended</td>
                
            </tr>
            

                <?php 
                    $sql  = "SELECT s.name,p.startDate,p.endDate FROM Performs p, Service s WHERE s.serviceID=p.serviceID AND s.type='Workshop' AND p.teacherID='".$_SESSION['teacherID']."';";

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
                    echo "<tr><td>".$row["name"]."</td><td>".$row["startDate"]." - ".$row["endDate"]."</td></tr>";
                    
                    }
                }
            ?>
                

             
             
            
        </table>
        
        
        <table>
        
            <tr id="Headings">
                <td> Conferences </td>
                <td> Dates Attended</td>
                
            </tr>
            
           <?php 
                    $sql  = "SELECT s.name,p.startDate,p.endDate FROM Performs p, Service s WHERE s.serviceID=p.serviceID AND s.type='Conference' AND p.teacherID='".$_SESSION['teacherID']."';";

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
                    echo "<tr><td>".$row["name"]."</td><td>".$row["startDate"]." - ".$row["endDate"]."</td></tr>";
                    
                    }
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
