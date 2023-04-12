<?php
  session_start();
  //Routes the an unauthenticated user back to the login page.
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: ../../templates/login.php");
    exit;
  }
  //Script to add a task based on primary key to a session array for use in creating courses.
  if(!empty($_GET) && isset($_GET)){
    $task_id = $_GET['task_id'];
    if(isset($_SESSION) && is_array($_SESSION['task'])){
      array_push($_SESSION['task'], intval($task_id));
      header("location: ../../templates/createCourse.php");
      exit;
    }
    else{
      $_SESSION['task'] = array(intval($task_id));
      header("location: ../../templates/createCourse.php");
      exit;
    }
  }
?>