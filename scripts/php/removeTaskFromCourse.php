<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: ../../templates/login.php");
    exit;
  }
  //Script to remove a task based on primary key to a session array for use in creating courses.
  if(!empty($_GET) && isset($_GET)){
    $task_id = $_GET['task_id'];
    if(($key = array_search($task_id, $_SESSION['task'])) !== false){
      unset($_SESSION['task'][$key]);
      header("location: ../../templates/createCourse.php");
      exit;
    }
  }
?>