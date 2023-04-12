<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] != 'trainee'){
    header("location: login.php");
    exit;
  }
  include '../resources/database.php';
  include '../resources/selectQuery.php';
?>
<!DOCTYPE html>
<html>
  <?php
      include "head.php";
      include "header.php";
    ?>
  <body>
    <?php include "accountNav.php"; ?>
    <h3>Assigned Courses</h3>
    <div class='content'>
        <ul>
          <?php 
             //Retreives and displays all courses assigned to the current logged in user.
             //For each course displays either a start button complete button or completed message based on the complete attribute from the related course task link table or the current               course session array values.
             if(!empty($_GET) && isset($_GET)){
                $user_id = $_GET['user_id'];
                $conn = connect();
                $courseResult = selectUserCourses($conn, $user_id);
                if(empty($courseResult)){
                  echo "<p>Currently there are no Courses assigned to you!</p>";
                  disconnect($conn);
                }
                else{
                  while($row = mysqli_fetch_assoc($courseResult)){
                    $completeResult = selectCourseComplete($conn, $row['course_id'], $user_id);
                    echo "<li class='taskView' ><span> Course: " . $row['course_name'] . "</span>";                 
                            if($completeResult['complete'] == "yes"){ 
                              echo "<span><strong>Course Completed</strong></span>";
                            }
                            else if($completeResult['complete'] == "no"){
                              if(isset($_SESSION['course' . $row['course_id']]) && is_array($_SESSION['course' . $row['course_id']])){
                                if(in_array("false", $_SESSION['course' . $row['course_id']], true) === false){
                                  echo "<a class='linkBtn' href='../scripts/php/completeCourse.php?course_id=".$row['course_id']."'>Complete</a>";
                                }
                                else{
                                  echo "<a class='linkBtn' href='startCourse.php?course_id=".$row['course_id']."'>Start</a>";
                                }
                              }
                              else{
                                echo "<a class='linkBtn' href='startCourse.php?course_id=".$row['course_id']."'>Start</a>";
                              }
                            }
                          echo" </li>";
                  }
                  disconnect($conn);
                }
              }
           ?>
        </ul>
    </div> 
  </body>
</html>