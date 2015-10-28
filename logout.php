<!-- ---------------------------------------------------------------
User logout:
  Explanation of the code:
  	session_destroy() simply remove's all session's meaning, 
  	the value of $_SESSION[''] will be removed and header() will 
  	simply redirect it to the home page.
------------------------------------------------------------------ -->

<?php
    session_start();
    session_destroy();
    header("location:index.php");
?>