<!-- ----------------------------------------------------------------
User log-in: Authentication
  Explanation of the code: 
    mysql_connect("Server name","Server Username","Server Password") - 
    mysql_select_db("database name") - Selects the database to be used.
    or die('Message') - Displays the error message if the condition wasn't met.
    mysql_query('sql query') - does the SQL queries. 
    mysql_fetch_array('query') - fetches all queries in the table to display or manipulate data. 
      It is placed in a while loop so that it would query all rows. 
      Take note that only 1 row is queried per loop that's why a while loop is necessary.
    $row['row name'] - the value of the column in the current query. It is represented as an array. 
    session_start() - Starts the session. 
    mysql_num_rows() - This returns an integer. This counts all the rows depending on the query.
    _SESSION['name'] - Serves as the session name for the entire session. 
------------------------------------------------------------------ -->
<?php
    session_start();
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $bool = true;

    mysql_connect("localhost", "root", "") or die (mysql_error()); //Connect to server
    mysql_select_db("first_db") or die ("Cannot connect to database"); //Connect to database
    $query = mysql_query("SELECT * FROM users WHERE username='$username'"); // Query the users table
    $exists = mysql_num_rows($query); //Checks if username exists
    $table_users = "";
    $table_password = "";
    
    if ($exists > 0) //If there are no returning rows or no existing username
    {
      while($row = mysql_fetch_assoc($query)) // display all rows from query
      {
        $table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
        $table_password = $row['password']; // the first password row is passed on to $table_password, and so on until the query is finished
      }
        
      if (($username == $table_users) && ($password == $table_password))// checks if there are any matching fields
      {
        
        if ($password == $table_password) 
        {
          $_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
          header("location: home.php"); // redirects the user to the authenticated home page
        }
         
      } else {
          Print '<script>alert("Incorrect Password!");</script>'; // Prompts the user
          Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
      }

    } else {
      Print '<script>alert("Incorrect username!");</script>'; // Prompts the user
      Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
    }
?>