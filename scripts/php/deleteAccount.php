<?php
  session_start();
  //Routes the an unauthenticated user back to the login page.
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header("location: ../../templates/login.php");
    exit;
  }
  //Scrpit to delete a user record based on the primary key.
  include "../../resources/database.php";
  include "../../resources/deleteQuery.php";
  $user_id = $_SESSION['user_id'];
  $conn = connect();
  $result = deleteUser($conn, $user_id);
  if($result == true){
    disconnect($conn);
    header("location: logout.php");
    exit;
  }else{
    disconnect($conn);
    header("location: ../../templates/account.php");
    exit;
  }
?>