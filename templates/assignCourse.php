<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: login.php");
    exit;
  }
  //Retreives all course data from the database based on the course id from the get request.
  include '../resources/database.php';
  include '../resources/selectQuery.php';
  include '../resources/countQuery.php';
  if(!empty($_GET) && isset($_GET)){
    $course_id = $_GET['course_id'];
    $conn = connect();
    $courseResult = selectCourse($conn, $course_id);
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
    <h3> Assign <?php echo $courseResult['course_name']; ?> to:</h3>
    <div class="content">
      <ul class='allTasks'>
      <?php
        //Retreives and displays all users with the trainee role that do not have the retreived course already assigned to them.
        //Gives each trainee record an assign button linking to the assign course script.
        $conn = connect();
        $count = countCourseLinks($conn, $course_id);
        if($count == 0){
          $result = allTrainees($conn);
        }
        else{
          $users = selectCourseUsers($conn, $course_id);
          $user_ids = array();
          while($user = mysqli_fetch_assoc($users)){
            array_push($user_ids, $user['user_id']);
          }
          $user_ids_string = implode(', ', $user_ids);
          $result = selectTrainees($conn, $user_ids_string);
        }
          while($row = mysqli_fetch_assoc($result)){
            echo "<li class='taskView'>
                    <span>Name: ".$row['name']."</span>
                    <span>Company: ".$row['company']."</span>
                    <span><a class='linkBtn' href='../scripts/php/assignCourseScript.php?course_id=".$course_id."&user_id=".$row['user_id']."'>Assign</a></span>
                  </li>";
          }
       ?> 
      </ul>
    </div>
  </body>
</html>