<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== "manager" && $_SESSION['role'] !== "administrator"){
    header("location: login.php");
    exit;
  }
  //Retreives and displays all task details based on primary key from a get request.
  include '../resources/database.php';
  include '../resources/selectQuery.php';
  include '../resources/updateQuery.php';
  if(!empty($_GET) && isset($_GET)){
    $task_id = $_GET['task_id'];
    $conn = connect();
    $task = selectTask($conn, $task_id);
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
    <h3>Edit Task Details</h3>
    <div class='content'>
       <form name='editTaskForm' id='editTaskForm' method="post" action='../scripts/php/updateTaskScript.php?task_id=<?php echo $task['task_id']?>'>
        <div class='editForm'>
          <table>
            <tr>
              <td><label for="task_name">Task Name:</label><span class="errorHidden">*</span></td>
              <td><input type="text" id="task_name" name="task_name" maxlength="255" value="<?php echo $task['task_name']?>" required></td>
            </tr>
            <tr>
              <td>Task Description:<span class="errorHidden">*</span></td>
              <td><textarea form='editTaskForm' id="task_desc" name="task_desc"><?php echo $task['task_description']?></textarea></td>
            </tr>
            <tr>
              <td>Task Length:<span class="errorHidden">*</span></td>
              <td><input type="number" id="task_length" name="task_length" value="<?php echo $task['task_length']?>" required></td>
            </tr>
            <tr>
              <td>Task Type:<span class="errorHidden">*</span></td>
              <td><select id='task_type' name='task_type' form='editTaskForm'>
                    <option class='options' value='0' <?php if($task['task_type'] == 0) echo "selected"; ?>>Text</option>
                    <option class='options' value='1' <?php if($task['task_type'] == 1) echo "selected"; ?>>Video</option>
                    <option class='options' value='2'<?php if($task['task_type'] == 2) echo "selected"; ?>>Quiz</option>
                    <option class='options' value='3'<?php if($task['task_type'] == 3) echo "selected"; ?>>Image</option>
                    <option class='options' value='4'<?php if($task['task_type'] == 4) echo "selected"; ?>>Seminar</option>
                  </select><br></td>
            </tr>
            <tr>
              <td>Task Source:</label><span class="errorHidden">*</span></td>
              <td><input type="text" id="task_source" name="task_source" maxlength="255" value="<?php echo $task['task_source']?>" required></td>
            </tr>
          </table>
          <p class="errorHidden" id="formValidation">Fields marked with * must be completed!</p>
          <p><?php if(!empty($msg)) echo $msg;?></p><p><?php if(!empty($msg)) echo $msg;?></p>
          <input type="button" name="editBtn" id="editBtn" class="submitBtn" value="Edit Details">
        </div>
      </form>
    </div>
    <script src="../scripts/js/editTask.js" defer></script> 
  </body>
</html>