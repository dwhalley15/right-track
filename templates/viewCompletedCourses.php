<?php
  session_start();
  unset($_SESSION['task']);
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: login.php");
    exit;
  }
?>
<!DOCTYPE html>
<html>
  <?php
      include "head.php";
      include "header.php";
    ?>
  <body>
    <?php include "accountNav.php"; ?>
    <h3>Completed Courses</h3>
    <div class="content">
      <ul class='allTasks'>
      <?php
        //Retreives and displays all course and user data from courses that have been completed.
        include '../resources/database.php';
        include '../resources/selectQuery.php';
        $conn = connect();
        $courseResult = selectCompletedCourses($conn);
        disconnect($conn);
         while($row = mysqli_fetch_assoc($courseResult)){
           echo "<li class='taskView'>
                  <span>Course Name: ".$row['course_name']."</span>
                  <span>Trainee Name: ".$row['name']."</span>
                  <span><a class='linkBtn' href='../scripts/php/reassignCourse.php?course_id=".$row['course_id']."&user_id=".$row['user_id']."'>Reassign</a></span>
                </li>";
         }
        ?>
      </ul>
    </div>
  </body>
</html>