<?php include('inc/head.php'); ?>
  
      <div id="container">
        <?php include('inc/header.php'); ?>
    
      <div id="login">
        <h2>Login Page</h2>
        <a href="index.php">Click here to go back</a><br/><br/>
        
        <form action="checklogin.php" method="post">
          <table>
            <tr>
                <th>
                    <label for="username">Enter Username:</label>
                </th>
                <td>
                    <input type="text" name="username" required="required">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="password">Enter Password:</label>
                </th>
                <td>
                    <input type="password" name="password" required="required">
                </td>
            </tr>
        </table>
        <input type="submit" value="Login">
        </form>
      </div>
<?php include('inc/footer.php'); ?>
  
  