<?php
    require_once 'session.php';
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
    <?php
    if(isset($_GET['journal']))
    {
     $sql_journal_info = "SELECT name FROM Journal WHERE journalID = ".$_GET['journal'].";";
    
    $result_journal_info = mysql_query($sql_journal_info, $link);
    if(!$result_journal_info)
    {
        die('Could not get data:  ' . mysql_error());
    }
    $row_journal_info = mysql_fetch_array($result_journal_info, MYSQL_ASSOC);
    ?>
     <h1>  <?php echo $row_journal_info["name"];?> </h1>
        <p> 
            This is a list of all entries the Journal has published:         
        </p>
        
        <table>
            <?php
    
     $sql_journal_articles = "SELECT * FROM JournalArticle where journalID = ".$_GET["journal"].";";
    
    $result_journal_articles = mysql_query($sql_journal_articles, $link);
    if(!$result_journal_articles)
    {
        die('Could not get data:  ' . mysql_error());
    }
    }
    ?>
    <tr id="Headings">
                <td> Name of Article</td>
                <td> Name of Writer</td>
                <td> Date of Publication</td>
            </tr>
    <?php
    if(isset($_GET['journal']))
    {
    while($row_journal_articles = mysql_fetch_array($result_journal_articles, MYSQL_ASSOC))
    {
         echo"<tr>"; 
            echo"<td>".$row_journal_articles["name"]."</td>";
            echo"<td>".$row_journal_articles["authorName"]."</td>";
            echo"<td>".$row_journal_articles["date"]."</td>";
            echo"</tr>";
    }
    }
    ?>
            
    </table>
        
        
        <p id = "clickers">
            <a href="reviewed-articles.php" >View articles you have reviewed </a>


            <a href="javascript:history.back()">Go Back</a>

        </p>
        
      
        
    
    </div>
  
    
    <!--- MAIN CONTENT BOX ENDS ---> 

</body>
</html>
