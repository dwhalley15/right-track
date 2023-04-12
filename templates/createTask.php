<?php
  session_start();
  //Routes the an unauthenticated user back to the login page.
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
      <h3>Create New Task</h3>
      <div class="form">
        <div class='tabs'>
          <div class='tabOne'>
            <fieldset class="fieldset">
              <form name='create_task' id='create_task' action='../scripts/php/createTaskScript.php' method="post" enctype='multipart/form-data'>
                <label for='task_name'>Task Name: </label><span class="errorHidden">*</span>
                <input type='text' name='task_name' placeholder='Task Name' maxlength="255" required>
                <label for='task_length'>Task Length (Minutes): </label><span class="errorHidden">*</span>
                <input type='number' name='task_length' required>
                <label for='task_type'>Task Type: </label><span class="errorHidden">*</span>
                  <select id='task_type' name='task_type' form='create_task'>
                    <option class='options' value='0'>Text</option>
                    <option class='options' value='1'>Video</option>
                    <option class='options' value='2'>Quiz</option>
                    <option class='options' value='3'>Image</option>
                    <option class='options' value='4'>Seminar</option>
                  </select><br>
                <p class="errorHidden" id="formValidation">Fields marked with * must be completed!</p>
              </fieldset>
                <input type="button" id='createTaskBtn' class="submitBtn" value="Create Task">
          </div>
          <div class='tabTwo'>
            <fieldset class="fieldset">
              <label for='task_source'>Task Source: </label><span class="errorHidden">*</span>
              <input type='file' name='task_source' id='task_source'  required>
              <label for='task_ref'>Task Reference: </label><span class="errorHidden">*</span>
              <input type='text' name='task_ref' placeholder='Task Reference' maxlength="1000" required>
              <label for='task_desc'>Task Description: </label><span class="errorHidden">*</span>
              <textarea id='task_desc' name='task_desc' placeholder='Task Description' form='create_task'></textarea>
            </fieldset>
            </form>
          </div>  
      </div>
    </div>
  </div>
  <script src="../scripts/js/createTask.js"></script> 
  </body>
</html>