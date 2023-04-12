<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: ../../templates/login.php");
    exit;
  }
  //Script to insert a record to the course user link table, takes in the user and course primary key to create a composite key.
  //Also checks a that record link does not already exist.
  include '../../resources/database.php';
  include '../../resources/insertQuery.php';
  include '../../resources/countQuery.php';
  if(!empty($_GET) && isset($_GET)){
    $course_id = $_GET['course_id'];
    $user_id = $_GET['user_id'];
    $conn = connect();
    $count = dupAssignCourse($conn, $course_id, $user_id);
    if($count != 0){
      disconnect($conn);
      header("location: ../../templates/viewCourses.php");
      exit;
    }
    else{
      insertCourseUserLink($conn, $course_id, $user_id);
      disconnect($conn);
      header("location: ../../templates/viewCourses.php");
      exit;
    }
  }

?>