<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: ../../templates/login.php");
    exit;
  }
  //Script to update a task based on primary key.
  include '../../resources/database.php';
  include '../../resources/updateQuery.php';
   if(!empty($_POST) && !empty($_GET)){
      $task_id = $_GET['task_id'];
      $task_name = $_POST['task_name'];
      $task_description = $_POST['task_desc'];
      $task_length = $_POST['task_length'];
      $task_type = $_POST['task_type'];
      $task_source = $_POST['task_source'];
      $updateTask = array(
        "task_id"=>$task_id,
        "task_name"=>$task_name,
        "task_description"=>$task_description,
        "task_length"=>$task_length,
        "task_type"=>$task_type,
        "task_source"=>$task_source
      );
      $conn = connect();
      $update = updateTask($conn, $updateTask);
      disconnect($conn);
      header("location: ../../templates/viewTasks.php");
      exit;  
   }
?>