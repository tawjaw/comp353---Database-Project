<?php
    require_once 'session.php';
   require_once 'config.php';

?>
<!DOCTYPE html>
<html>
<head>

    <link type="text/css" rel="stylesheet" href="stylesheet2.css" /> 
    <title> Journal Information</title>
</head>
<body>
    <!-- NAVIGATION BAR BEGINS -->
    <div class="navibar">
        <ul>
            <ul style="float: left; list-style-type:none">
                <li> <a href="index.php">My Better Concordia</a></li>
            </ul>
          <li class="first"><a  href="all-courses.php">Courses </a></li>
          <li><a href="research.php">Research</a></li>
          <li><a class="active" href="">Journals</a></li>
            <ul style="float: right; padding-right: 15px; list-style-type:none"> 
                <li> <a  href="personal-information.php"><?php echo $_SESSION['name']; ?></a></li>
                <li> <a href="index.php?logOut=true"> Log Out</a>  </li>
            </ul>
        </ul>
        
    </div>
    
    <!--- NAVIGATION BAR ENDS --->
    
    <br> <br> <br>
    
    
    <!--- MAIN CONTENT BOX BEGINS --->
    
    <div class="jai-prakash">
    
     <h1>  Journals </h1>
        <p> 
            These are the journals you are associated with: 
         
        </p>
        
          
            <table>
           <tr id ="Headings" >
                <td> 
                    Journal
                </td>
               
                
                <td> 
                    Association 
                </td>
             
            </tr>
                
                <tr>
                    <td> <a href="journals.html" style = "text-decoration: none;"> Southern North-west Philadelphia Computers digest </a> </td>
                    <td> Editorial Board</td>
                    
                </tr>
               
            
        </table>
        
        <p id="clickers">
          


           

        </p>
        
      
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 

</body>
</html>
