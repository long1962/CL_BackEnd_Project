<!-- -----------------------------------------------------------------------------
Explanation of the code:
  Editing Data:  
    !empty() - a method that checks if the value is not empty. 
    $_GET[''] - Used to get the value from the parameter. 
    $id_exists - the variable that checks whether the given id exists.
    $_SESSION['id'] - place the value of id into session to use it on another file.  
------------------------------------------------------------------------------- -->

<html>
  <head>
    <title>My first PHP website</title>
  </head>
  <?php
  session_start(); //starts the session
  
  if($_SESSION['user']){ //checks if user is logged in
  } else {
      header("location:index.php"); // redirects if user is not logged in
  }

  $user = $_SESSION['user']; //assigns user value
  $id_exists = false;
  ?>
  
  <body>
    <h2>Home Page</h2>
    <p>Hello <?php Print "$user"?>!</p> <!--Displays user's name-->
    <a href="logout.php">Click here to logout</a><br/><br/>
    <a href="home.php">Return to Home page</a>
    <h2 align="center">Currently Selected</h2>
    
    <table border="1px" width="100%">
      <tr>
        <th>Id</th>
        <th>Requirement</th>
        <th>Frequency</th>
        <th>Due Date</th>
        <th>Assigned To</th>
        <th>Completed Date</th>
        <th>Remarks</th>
      </tr>
      
      <?php
            if(!empty($_GET['id'])) {
                $id = $_GET['id'];
                $_SESSION['id'] = $id;
                $id_exists = true;
                mysql_connect("localhost", "root","") or die (mysql_error()); //Connect to server
                mysql_select_db("first_db") or die ("Cannot connect to database"); //connect to database
                $query = mysql_query("SELECT * FROM compliance_table WHERE requirement_id='$id'"); // SQL Query
                $count = mysql_num_rows($query);

                  if($count > 0) {
                      while($row = mysql_fetch_array($query))
                      {
                        Print "<tr>";
                          Print '<td align="center">'. $row['requirement_id'] . "</td>";
                          Print '<td align="center">'. $row['requirement'] . "</td>";
                          Print '<td align="center">'. $row['frequency'] . "</td>";
                          Print '<td align="center">'. $row['due_date'] . "</td>";
                          Print '<td align="center">'. $row['assigned_to'] . "</td>";
                          Print '<td align="center">'. $row['completed_on'] . "</td>";
                          Print '<td align="center">'. $row['remarks'] . "</td>";
                        Print "</tr>";
                      }
                  } else {
                      $id_exists = false;
                  }
            }
      ?>
    </table>
    <br/>
    
    <?php
          if($id_exists) {
              Print'
              <form action="edit.php" method="POST">
                    Enter Completion Date: <input type="date" name="completed_on"/><br/>
                    Enter Remarks: <input type="varchar(250)" name="remarks"/><br/>
                    <input type="submit" value="Update List"/>
              </form>';
          } else {
            Print '<h2 align="center">There is no data to be edited.</h2>';
          }
    ?>
  
  </body>
</html>

<?php
      if($_SERVER['REQUEST_METHOD'] == "POST") {
            mysql_connect("localhost", "root","") or die (mysql_error()); //Connect to server
            mysql_select_db("first_db") or die ("Cannot connect to database"); //Connect to database
           
            $completed_on = mysql_real_escape_string($_POST['completed_on']);
            $remarks = mysql_real_escape_string($_POST['remarks']);
            $id = $_SESSION['id'];

            mysql_query("UPDATE compliance_table SET 
                        completed_on='$completed_on',
                        remarks = '$remarks'
                        WHERE requirement_id='$id'");
            header("location: home.php");
      }
?>