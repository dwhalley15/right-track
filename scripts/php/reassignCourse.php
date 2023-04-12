<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: ../../templates/login.php");
    exit;
  }
  //Script to change a course links complete attribute back to no. Used to reassign a course to a user.
  include '../../resources/database.php';
  include '../../resources/updateQuery.php';
  if(!empty($_GET) && isset($_GET)){
    $course_id = $_GET['course_id'];
    $user_id = $_GET['user_id'];
    $conn = connect();
    updateCourseReassigned($conn, $course_id, $user_id);
    disconnect($conn);
    header("location: ../../templates/viewCompletedCourses.php");
    exit;
  }
  else{
    header("location: ../../templates/viewCompletedCourses.php");
    exit;
  }
?>