<?php
    require_once 'session.php';
   require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>

    <link type="text/css" rel="stylesheet" href="stylesheet2.css" /> 
    <title> Research </title>
</head>
<body>
    <!-- NAVIGATION BAR BEGINS -->
    <div class="navibar">
        <ul>
            <ul style="float: left; list-style-type:none">
                <li> <a href="index.php">My Better Concordia</a></li>
            </ul>
          <li class="first"><a href="all-courses.php">Courses </a></li>
          <li><a class ="active" href="">Research</a></li>
          <li><a href="#contact">Journals</a></li>
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
    
     <h1>  Research Grants !</h1>
        <p> 
            Total Grant Money Remaining : ???? <br>
            Total Amount of Grant Money Spent this year : ????
            
            
        </p>
        
        <p> </p>
        
        <p id="clickers"> 
            <a href="" > View list of all grants received  </a>
            <a href="" > View List of grants you have dispersed </a>
           <a href ="" > View research you're involved in</a>
            < a href ="" > View list of students under your supervision</a>
        </p>
        
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 

</body>
</html>
