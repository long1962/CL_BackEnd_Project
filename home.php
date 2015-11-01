<!-- ------------------------------------------------------------------------
Explanation to the code:
  session_start() - Basically starts the session. Required for $_SESSION[''].
  header() - redirects the user.
  
  Displaying Data:
    Displays the data coming from the while loop. 
------------------------------------------------------------------------- -->

<html>
  <head>
    <title>My first PHP website</title>
  </head>
  <?php
  session_start(); //starts the session
  if($_SESSION['user']){ //checks if user is logged in
  }
  else{
    header("location:index.php"); // redirects if user is not logged in
  }
  $user = $_SESSION['user']; //assigns user value
  ?>
  <body>
    <h2>Home Page</h2>
    <p>Hello <?php Print "$user"?>!</p> <!--Displays user's name-->
    <a href="logout.php">Click here to logout</a><br/><br/>
    
   <!-- <form action="add.php" method="POST">
      Add more to list: <input type="text" name="requirement"/><br/>
      public post? <input type="checkbox" name="public[]" value="yes"/><br/>
      <input type="submit" value="Add to list"/>
    </form> -->

    <h2 align="center">EHS Compliance List</h2>
    <table border="1px" width="100%">
    
      <tr>
        <th>Id</th>
        <th>Requirement</th>
        <th>Frequency</th>
        <th>Due Date</th>
        <th>Assigned To</th>
        <th>Completed Date</th>
        <th>Remarks</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>

      <?php
        mysql_connect("localhost", "root","") or die (mysql_error()); //Connect to server
        mysql_select_db("first_db") or die ("Cannot connect to database"); //connect to database
        
        $query = mysql_query("SELECT * FROM compliance_table"); // SQL Query 

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
              Print '<td align="center"><a href="edit.php?id='. $row['requirement_id'] .'">edit</a> </td>';
              Print '<td align="center"><a href="#" onclick="myFunction('.$row['requirement_id'].')">delete</a> </td>';
            Print "</tr>";
          }
      ?>
    </table>
    
    <script>
      function myFunction(id) {
      var r=confirm("Are you sure you want to delete this record?");
        if (r==true) {
          window.location.assign("delete.php?requirement_id=" + id);
        }
      }
    </script>

    <?php include('inc/footer.php'); ?>
    
  </body>
</html>