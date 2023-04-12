<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: ../../templates/login.php");
    exit;
  }
  //Script to insert a new task.
  //Uploads the file input into the correct folder based on the task type.
  //Checks a task with the same reference number does not already exist.
  //If completed routes the user to the view task page, otherwise routes the user back create task page.
  include '../../resources/database.php';
  include '../../resources/insertQuery.php';
  include '../../resources/countQuery.php';
  if(!empty($_POST) && isset($_POST)){  
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_desc'];
    $task_length = $_POST['task_length'];
    $task_reference = $_POST['task_ref'];
    $task_type = $_POST['task_type'];
    $task_source = $_POST['task_source'];
    if($task_type != 2 && $task_type != 1){
      if($task_type == 0){
        $path = "../../files/";
      }
      else if($task_type == 3){
        $path = "../../images/";
      }
      else if($task_type == 4){
        $path = "../../maps/";
      }
      $file = $path . basename($_FILES['task_source']['name']);
      $task_source = $_FILES['task_source']['name'];
      move_uploaded_file($_FILES['task_source']['tmp_name'], $file);
    }
    $newTask = array(
      "task_name"=>$task_name,
      "task_description"=>$task_description,
      "task_length"=>$task_length,
      "task_reference"=>$task_reference,
      "task_type"=>$task_type,
      "task_source"=>$task_source
    );
    $conn = connect();
    $count = dupTask($conn, $task_reference);
    if($count != 0){
      disconnect($conn);
      header("location: ../../templates/createTask.php");
      exit;
    }
    else{
      $task_id = insertTask($conn, $newTask);
      if(empty($task_id)){
        disconnect($conn);
        header("location: ../../templates/createTask.php");
        exit;
      }
      else{
        disconnect($conn);
        header("location: ../../templates/viewTasks.php");
        exit;
      }
    }
  }
?>