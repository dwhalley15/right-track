<?php
  //A link to log out a user clears any and all session values and routes user back to the log in page.
  session_start();
  $_SESSION = array();
  session_destroy();
  header("location: ../../templates/login.php");
  exit;
?>