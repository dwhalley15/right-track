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
    <h3>Tasks To Complete</h3>
    <div class='content'>
        <ul>
          <?php
            //Retireves and displays task details assigned to course based on primary key from the get request.
            //Creates or updates a course session array with taks ids as the key and false as the value, used to track completed tasks.
            if(!empty($_GET) && isset($_GET)){
                $course_id = $_GET['course_id'];
                $conn = connect();
                $taskResult = selectCourseTasks($conn, $course_id);
                disconnect($conn);
                $task_types = array("Text", "Video", "Quiz", "Image", "Seminar");
                while($row = mysqli_fetch_assoc($taskResult)){
                  if(isset($_SESSION['course' . $course_id]) && is_array($_SESSION['course' . $course_id])){
                    if(array_key_exists($row['task_id'], $_SESSION['course' . $course_id])){
                     //Does nothing so that existing course session arrays remain consistant. 
                    }
                    else{
                      $_SESSION['course' . $course_id][$row['task_id']] = "false";
                    }
                  }
                  else{
                    $_SESSION['course' . $course_id] = array($row['task_id'] => "false");
                  }
                        echo "<li class='taskView'>
                          <span>Task Name: ".$row['task_name']."</span>
                          <span>Type: ".$task_types[$row['task_type']]."</span>
                          <span>Length: ".$row['task_length']." minutes</span>";
                          if($_SESSION['course' . $course_id][$row['task_id']] != "false"){
                            echo "<span><strong>Completed</strong></span>";
                          }
                          else{
                            echo "<a class='linkBtn' href='startTask.php?task_id=".$row['task_id']."&course_id=".$course_id."'>Start</a>";
                          } 
                  echo "</li>";
                }
             }
             else{
              echo "<p>No course selected!</p>";
             }
          ?>
        </ul>
    </div> 
  </body>
</html>