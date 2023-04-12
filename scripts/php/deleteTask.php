<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: ../../templates/login.php");
    exit;
  }
  //Script to delete a task based on primary key.
  include "../../resources/database.php";
  include "../../resources/deleteQuery.php";
  if(!empty($_GET) && isset($_GET)){
    $task_id = $_GET['task_id'];
    $conn = connect();
    deleteTask($conn, $task_id);
    disconnect($conn);
    header("location: ../../templates/viewTasks.php");
    exit;
  }
  else{
    header("location: ../../templates/viewTasks.php");
    exit;
  }
?>