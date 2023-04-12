<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: ../../templates/login.php");
    exit;
  }
  //Script to insert a new course. 
  //Also inserts new course task link from provided task ids and new course id.
  //If completed routes the user to the view courses page,, otherwise routes the user back to the creat course page.
  include '../../resources/database.php';
  include '../../resources/insertQuery.php';
  if(!empty($_POST) && isset($_POST)){
    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_desc'];
    $task_ids = $_POST['task']['val']; 
    $newCourse = array(
      "course_name"=>$course_name,
      "course_description"=>$course_description
    );
    $conn = connect();
    $course_id = insertCourse($conn, $newCourse);
    if(empty($course_id)){
      disconnect($conn);
      header("location: ../../templates/createCourse.php");
      exit;
    }
    else{
      foreach($task_ids as $key=>$task_id){
        insertCourseTaskLink($conn, $course_id, $task_id);
      }
      disconnect($conn);
      unset($_SESSION['task']);
      header("location: ../../templates/viewCourses.php");
      exit;
    }
  }
?>