<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] != 'trainee'){
    header("location: ../../templates/login.php");
    exit;
  }
  //Script to set a single user course link attribute complete to yes used to mark a course as completed.
  //Also unsets any related sessions.
  include '../../resources/database.php';
  include '../../resources/updateQuery.php';
  if(!empty($_GET) && isset($_GET)){
    $course_id = $_GET['course_id'];
    $user_id = $_SESSION['user_id'];
    $conn = connect();
    updateCourseCompleted($conn, $course_id, $user_id);
    unset($_SESSION['course' . $course_id]);
    disconnect($conn);
    header("location: ../../templates/assignedCourses.php?user_id=$user_id");
    exit;
  }
?>