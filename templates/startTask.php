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
    <div class='content'>
         <?php 
            //Displays the task content based on primary key from the get request. 
            //Content displayed is based on the task type.
            if(!empty($_GET) && isset($_GET)){
              $task_id = $_GET['task_id'];
              $course_id = $_GET['course_id'];
              $conn = connect();
              $result = selectTask($conn, $task_id);
              disconnect($conn);
              echo "<h3>".$result['task_name']."</h3>
                <p>".$result['task_description']."</p>";
              if($result['task_type'] == 3){
                echo "<img src='../images/".$result['task_source']."' alt='".$result['task_name']."' style='width:800px;'>";
              }
              else if($result['task_type'] == 0){
                echo "<embed type='text/html' src='../files/".$result['task_source']."' width='800' height='1475'>";
              }
              else if($result['task_type'] == 1){
                echo "<iframe width='640' height='564' src='".$result['task_source']."' title='Video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
              }
              else if($result['task_type'] == 2){
                echo "<iframe src='".$result['task_source']."' width='640' height='1475' frameorder='0' marginnheight='0' marginwidth='0'>Loading</iframe>";
              }
              else if($result['task_type'] == 4){
                echo "<img src='../maps/".$result['task_source']."' alt='".$result['task_name']."' style='width:300px;'>";
              }
            }
            else{
              echo "<p>No task selected!</p>";
            }
        ?>
        <input id='taskLength' type='hidden' value='<?php echo intval($result['task_length']); ?>'>
        <p id='timer'></p>
        <br><br><a id='completeTaskBtn' class='submitBtn' href='../scripts/php/completeTask.php?task_id=<?php echo $task_id;?>&course_id=<?php echo $course_id;?>'>Complete</a> 
    </div>
    <script src="../scripts/js/startTask.js"></script> 
  </body>
</html>