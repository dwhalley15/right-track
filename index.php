<?php
  session_start();
  //Routes a user to the home page.
  header("location: templates/home.php");
  exit;
?>