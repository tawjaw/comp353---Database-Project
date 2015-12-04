<?php
    require_once('session.php');
    
?>
<html>
<head>

    <link type="text/css" rel="stylesheet" href="stylesheet2.css" /> 
    <title> Home Page</title>
</head>
<body>
    <!-- NAVIGATION BAR BEGINS -->
    <div class="navibar">
        <ul>
            <ul style="float: left; list-style-type:none">
                <li> <a href="">My Better Concordia</a></li>
            </ul>
          <li class="first"><a href="all-courses.php">Courses </a></li>
          <li><a href="research.php">Research</a></li>
          <li><a href="journal-landing-page.php">Journals</a></li>
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
    
     <h1>  Welcome !</h1>
        <p> 
            Please choose an option from the following list:
         
        </p>
        
        <p id="clickers"> 
            <a href="all-courses.php" > View All Courses </a>
           
        </p>
        
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 
    
    
    
    
</body>
</html>
