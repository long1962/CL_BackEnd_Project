<!-- ---------------------------------------------------------------
Explanation of the code:
    Adding Data:
      foreach() - gets the value of the checkbox.
    
------------------------------------------------------------------ -->

<?php
    session_start();
    if ($_SESSION['user']) {
    }
    else {
        header("location:index.php");
    }
    
    if ($_SERVER['REQUEST_METHOD'] = "POST") //Added an if to keep the page secured
    {
        $requirement = mysql_real_escape_string($_POST['requirement']);
        $decision ="no";
        
        mysql_connect("localhost", "root","") or die (mysql_error()); //Connect to server
        mysql_select_db("first_db") or die ("Cannot connect to database"); //Connect to database
        
        foreach ($_POST['public'] as $each_check) //gets the data from the checkbox
        {
            if($each_check !=null ) { //checks if the checkbox is checked
                $decision = "yes"; //sets the value
            }
        }
        
        mysql_query("INSERT INTO compliance_table (requirement, public) 
        VALUES ('$requirement', '$decision')"); //SQL query

        header("location: home.php");
    } else {
        header("location:home.php"); //redirects back to home
    }
?>