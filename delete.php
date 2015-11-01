<!-- -----------------------------------------------------------------------------
Explanation of the code:
  Deleting Data:  
    
------------------------------------------------------------------------------- -->

<?php
	session_start(); //starts the session
	if($_SESSION['user']){ //checks if user is logged in
	}
	else{
		header("location:index.php"); // redirects if user is not logged in
	}
	if($_SERVER['REQUEST_METHOD'] == "GET")
	{
		mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
		mysql_select_db("first_db") or die ("Cannot connect to database"); //Connect to database
		$id = $_GET['requirement_id'];
		mysql_query("DELETE FROM compliance_table WHERE requirement_id='$id'");
		header("location: home.php");
	}
?>