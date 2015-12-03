<?php
    require_once('session.php');
    
?>
<html>
<head>

    <link type="text/css" rel="stylesheet" href="stylesheet2.css" /> 
    <title> My Concordia Home Page</title>
</head>
<body>
    <!-- NAVIGATION BAR BEGINS -->
    <div class="navibar">
        <ul>
            <ul style="float: left; list-style-type:none">
                <li> <a href="#about">My Better Concordia</a></li>
            </ul>
          <li class="first"><a class="active" href="all-courses.php">Courses </a></li>
          <li><a href="#news">Research</a></li>
          <li><a href="#contact">Journals</a></li>
            <ul style="float: right; padding-right: 15px; list-style-type:none"> 
                <li> <a href=""><?php echo $_SESSION['name']; ?></a></li>
                <li> <a href="sans-bootstrap.php?logOut=true"> Log Out</a>  </li>
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
            <a href="Current-term-courses.html" > View current term courses</a>
            <a href="all-courses.php" > View All Courses </a>
           
        </p>
        
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 
    
    
    
    
</body>
</html>
