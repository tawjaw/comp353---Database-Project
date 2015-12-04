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
    
    <div class="jai-prakash">
    
     <h1>  All entries You reviewed  : </h1>
        
        
        <table>
            <tr id="Heading">
                <td> Journal </td>
                <td> Name of Article</td>
                <td> Name of Writer</td>
                <td> Date of Publication</td>
            </tr>
             <?php
    
     $sql_journal_info = "
                        SELECT JournalArticle.journalID,
                        Journal.name as journalName, JournalArticle.name as articleName, 
                        JournalArticle.authorName as author, Reviewed.date as date  
                        FROM Journal, JournalArticle, Reviewed 
                        WHERE
                        JournalArticle.articleID = Reviewed.articleID
                        AND JournalArticle.journalID = Journal.journalID = Reviewed.journalID
                        AND  Reviewed.teacherID = ".$_SESSION['teacherID'].";";
    
    $result_journal_info = mysql_query($sql_journal_info, $link);
    if(!$result_journal_info)
    {
        die('Could not get data:  ' . mysql_error());
    }
    
    ?>
    
    <?php
    
    while($row_journal_info = mysql_fetch_array($result_journal_info, MYSQL_ASSOC))
    {
        echo" <tr>";
        echo'<td><a href="journal-articles.php?journal='. $row_journal_info["journalID"].'">'. $row_journal_info["journalName"]."</td>";
        echo"<td>".$row_journal_info["articleName"]."</td>";
        echo"<td>".$row_journal_info["author"]."</td>";
        echo"<td>".$row_journal_info["date"]."</td>";   
        echo"</tr>";
          
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
