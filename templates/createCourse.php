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
    <div class="content">
      <h3>Create New Course</h3>
      <div class="form">
        <form name='create_course' id='create_course' action='../scripts/php/createCourseScript.php' method="post">
          <div class='tabs'>
            <div class='tabOne'>
              <fieldset class="fieldset">
                <legend>Course Details</legend>
                  <label for='course_name'>Course Name: </label><span class="errorHidden">*</span>
                  <input type='text' name='course_name' placeholder='Course Name' maxlength="255" required>
                  <label for='course_desc'>Course Description: </label><span class="errorHidden">*</span>
                  <textarea id='course_desc' name='course_desc' placeholder='Course Description' form='create_course'></textarea>
                  <p class="errorHidden" id="formValidation">Fields marked with * must be completed!</p>
                </fieldset>
                <input type="button" id='createCourseBtn' class="submitBtn" value="Create Course">
            </div>
            <div class='tabTwo'>
              <fieldset class="fieldset">
                <legend>All Tasks</legend>
                <ul class='task_to_course_list'>
                <?php
                  //Retireves and displays all current tasks from the database.
                  $task_types = array("Video", "Text", "Quiz", "Image", "Seminar");
                  include '../resources/database.php';
                  include '../resources/selectQuery.php';
                  $conn = connect();
                  $result = selectAllTasks($conn);
                  disconnect($conn);
                   while($row = mysqli_fetch_assoc($result)){
                     echo "<li class='task_to_course'>
                              <span>Task Name: ".$row['task_name']."</span>
                              <span>Task Type: ".$task_types[$row['task_type']]."</span>
                              <a class='addTaskBtn' id='".$row['task_id']."'>Add</a>
                            </form>
                          </li>";
                   }
                ?>
                </ul>
              </fieldset>
            </div>
            <div class='tabThree'>
              <fieldset class="fieldset">
                <legend>Added Tasks</legend>
                <ul>
                <?php
                  //Retrieves and displays all current tasks added to this courses session array.
                  $tasks = $_SESSION['task'];
                  if(!empty($tasks)){
                    $task_ids_string = implode(", ", $tasks); 
                    $conn = connect();
                    $results = selectTasks($conn, $task_ids_string);
                    disconnect($conn);
                    while($row = mysqli_fetch_assoc($results)){    
                       echo "<li class='task_on_course'>
                                <span>Task Name: ".$row['task_name']."</span>
                                <span>Task Type: ".$task_types[$row['task_type']]."</span>
                                <a class='removeTaskBtn' id='".$row['task_id']."'>Remove</a>
                                <input type='hidden' name='task[val][]' value='".$row['task_id']."'>
                            </li>";
                     }
                }
                ?>
                </ul>
              </fieldset>
            </div>
            </div>
          </form>
    </div>
  </div>
  <script src="../scripts/js/createCourse.js"></script> 
  </body>
</html>