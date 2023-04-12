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
    <h3>Course List</h3>
    <div class="content">
      <a class='submitBtn' href='createCourse.php'>Add Course +</a>
      <ul class='allTasks'>
      <?php
        //Retrieves and displays all current courses in the database, with tasks the course currently includes.
        $task_types = array("Text", "Video", "Quiz", "Image", "Seminar");
        include '../resources/database.php';
        include '../resources/selectQuery.php';
        $conn = connect();
        $courseResult = selectAllCourses($conn);
         while($row = mysqli_fetch_assoc($courseResult)){
           echo "<li class='taskView'>
                  <span>Course Name: ".$row['course_name']."</span>
                  <span>Course Tasks: ";
                  $taskResult = selectCourseTasks($conn, $row['course_id']);
                  while($taskRow = mysqli_fetch_assoc($taskResult)){
                    echo " - " . $taskRow['task_name'];
                  }
            echo "</span>
                  <span><a class='linkBtn' href='assignCourse.php?course_id=".$row['course_id']."'>Assign</a></span>
                  <span><a class='linkBtn' href='editCourse.php?course_id=".$row['course_id']."'>Edit</a></span>
                  <span><a class='linkBtn' href='../scripts/php/deleteCourse.php?course_id=".$row['course_id']."'>Delete</a></span>
                </li>";
         }
          disconnect($conn);
      ?>
      </ul>
    </div>
  </body>
</html>
