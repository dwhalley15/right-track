<?php
  session_start();
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
    <h3>Task List</h3>
    <div class="content">
      <a class='submitBtn' href='createTask.php'>Add Task +</a>
      <ul class='allTasks'>
      <?php
        //Retrieves and displays all current tasks from the database.
        $task_types = array("Text", "Video", "Quiz", "Image", "Seminar");
        include '../resources/database.php';
        include '../resources/selectQuery.php';
        $conn = connect();
        $result = selectAllTasks($conn);
         while($row = mysqli_fetch_assoc($result)){
           echo "<li class='taskView'>
                  <span>Task Reference: ".$row['task_reference']."</span>
                  <span>Task Name: ".$row['task_name']."</span>
                  <span>Task Type: ".$task_types[$row['task_type']]."</span>
                  <span>Task Length: ".$row['task_length']." minutes</span>
                  <span><a class='linkBtn' href='editTask.php?task_id=".$row['task_id']."'>Edit</a></span>
                  <span><a class='linkBtn' href='../scripts/php/deleteTask.php?task_id=".$row['task_id']."'>Delete</a></span>
                </li>";
         }
      ?>
      </ul>
    </div>
  </body>
</html>
