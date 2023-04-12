<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: ../../templates/login.php");
    exit;
  }
  //Script to delete a course based on the primary key, due to delete on cascade will also delete any related links.
  include "../../resources/database.php";
  include "../../resources/deleteQuery.php";
  if(!empty($_GET) && isset($_GET)){
    $course_id = $_GET['course_id'];
    $conn = connect();
    deleteCourse($conn, $course_id);
    disconnect($conn);
    header("location: ../../templates/viewCourses.php");
    exit;
  }
  else{
    header("location: ../../templates/viewCourses.php");
    exit;
  }
?>