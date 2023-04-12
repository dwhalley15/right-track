<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: login.php");
    exit;
  }
  //Retreives and dispays all details from a course based on the primary key from a get request.
  include '../resources/database.php';
  include '../resources/selectQuery.php';
  include '../resources/updateQuery.php';
  if(!empty($_GET) && isset($_GET)){
    $course_id = $_GET['course_id'];
    $conn = connect();
    $courseResult = selectCourse($conn, $course_id);
    if(empty($_SESSION['task'])){
      $tasksResult = selectCourseTasks($conn, $course_id);
      $_SESSION['task'] = array();
      while($row = mysqli_fetch_assoc($tasksResult)){
        array_push($_SESSION['task'], $row['task_id']);
      }
    }
    disconnect($conn);
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
      <h3>Update Course</h3>
      <div class="form">
        <form name='edit_course' id='edit_course' action='../scripts/php/editCourseScript.php' method="post">
          <div class='tabs'>
            <div class='tabOne'>
              <fieldset class="fieldset">
                <legend>Course Details</legend>
                  <input type="hidden" name="course_id" id="courseId" value="<?php echo $courseResult['course_id']; ?>">
                  <label for='course_name'>Course Name: </label><span class="errorHidden">*</span>
                  <input type='text' name='course_name' placeholder='Course Name' maxlength="255" value="<?php echo $courseResult['course_name']; ?>" required>
                  <label for='course_desc'>Course Description: </label><span class="errorHidden">*</span>
                  <textarea id='course_desc' name='course_desc' placeholder='Course Description' form='edit_course'><?php echo $courseResult['course_description']; ?></textarea>
                  <p class="errorHidden" id="formValidation">Fields marked with * must be completed!</p>
                </fieldset>
                  <input type="button" id='updateCourseBtn' class="submitBtn" value="Update Course">
            </div>
            <div class='tabTwo'>
              <fieldset class="fieldset">
                <legend>All Tasks</legend>
                <ul class='task_to_course_list'>
                <?php
                  //Retireves and displays all current tasks from the database.
                  $task_types = array("Text", "Video", "Quiz", "Image", "Seminar");
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
                  //Retrieves and displays all current tasks added to this course.
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
  <script src="../scripts/js/editCourse.js"></script> 
  </body>
</html>