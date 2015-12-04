<?php
    require_once('session.php');
   require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>

    <link type="text/css" rel="stylesheet" href="stylesheet2.css" /> 
    <title> Current Term Courses</title>
</head>
<body>
    <!-- NAVIGATION BAR BEGINS -->
   
    <div class="navibar">
        <ul>
            <ul style="float: left; list-style-type:none">
                <li> <a href="#about">My Better Concordia</a></li>
            </ul>
          <li li class="first"><a href="all-courses.php">Courses </a></li>
          <li><a href="research.php">Research</a></li>
          <li><a class ="active" href="">Journals</a></li>
            <ul style="float: right; padding-right: 15px; list-style-type:none"> 
                <li> <a href="personal-information.php"><?php echo $_SESSION['name']; ?></a></li>
                <li> <a href="index.php?logOut=true"> Log Out</a>  </li>
            </ul>
        </ul>
        
    </div>
    
    <!--- NAVIGATION BAR ENDS --->
    
    <br> <br> <br>
    
    
    <!--- MAIN CONTENT BOX BEGINS --->
    
    <?php
    
     $sql_journal_info = "SELECT journalID, name FROM Journal where journalID 
                            IN (select journalID FROM OnBoardOf WHERE teacherID = ".$_SESSION['teacherID'].");";
    
    $result_journal_info = mysql_query($sql_journal_info, $link);
    if(!$result_journal_info)
    {
        die('Could not get data:  ' . mysql_error());
    }
    
    ?>
    <div class="jai-prakash">
        <h1>You are on board of:</h1>
    <?php
    
    while($row_journal_info = mysql_fetch_array($result_journal_info, MYSQL_ASSOC))
    {
     
        echo'<p align= "center"><a href="journal-articles.php?journal='. $row_journal_info["journalID"].'">'. $row_journal_info["name"]."</p>";
    }
     ?>   
           <p id="clickers">
           
            <a href="reviewed-articles.php" >View articles you have reviewed </a>


            <a href="javascript:history.back()">Go Back</a>

        </p>
        
      
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 

</body>
</html>
