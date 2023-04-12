<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: ../../templates/login.php");
    exit;
  }
  //Script to update a course based on primary key. Deletes and reinserts any related task links.
  include '../../resources/database.php';
  include '../../resources/insertQuery.php';
  include '../../resources/updateQuery.php';
  include '../../resources/deleteQuery.php';
  if(!empty($_POST) && isset($_POST)){
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_desc'];
    $task_ids = $_POST['task']['val']; 
    $newCourse = array(
      "course_id"=>$course_id,
      "course_name"=>$course_name,
      "course_description"=>$course_description
    );
    $conn = connect();
    updateCourse($conn, $course_id, $newCourse);
    deleteTaskLink($conn, $course_id);
    foreach($task_ids as $key=>$task_id){
      insertCourseTaskLink($conn, $course_id, $task_id);
    }
    disconnect($conn);
    unset($_SESSION['task']);
    header("location: ../../templates/viewCourses.php");
    exit;
  }
?>