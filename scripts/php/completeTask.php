<?php
  session_start();
  //Routes the an unauthenticated user back to the login page.
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] != 'trainee'){
    header("location: ../../templates/login.php");
    exit;
  }
  //Script to mark a task as complete. 
  //If the session for the tasks course does not yet exist as an array, creates it with the task id as the key and value as true.
  //If the courses session array and task key already exist change the value to true.
  if(!empty($_GET) && isset($_GET)){
    $task_id = $_GET['task_id'];
    $course_id = $_GET['course_id'];
    if(isset($_SESSION['course' . $course_id]) && is_array($_SESSION['course' . $course_id])){
      $_SESSION['course' . $course_id][$task_id] = "true";                    
    }
    else{
      $_SESSION['course' . $course_id] = array($task_id => "true");
    }
    header("location: ../../templates/startCourse.php?course_id=$course_id");
    exit;
  }
  else{
    header("location: ../../templates/account.php");
    exit;
  }
?>