<div class='accountNav'>
      <?php
        //Creates a dynamic navigati0n bar based on the users role.
        if($_SESSION['role'] == "trainee"){
          echo "<a href='assignedCourses.php?user_id=".$_SESSION['user_id']."'>Assigned Courses</a><br><br>";
        }
        if($_SESSION['role']!== "trainee"){
          echo "<a href='viewTasks.php'>Task Management</a><br><br>";
          echo "<a href='viewCourses.php'>Course Management</a><br><br>";
          echo "<a href='viewCompletedCourses.php'>Completed Courses</a><br><br>";
        }
        if($_SESSION['role'] == "administrator"){
          echo "<a href='editRoles.php'>Edit Account Roles</a><br><br>";
        }    
      ?>
      <a href='editAccount.php'>Edit Account Details</a><br><br>
      <a href='passwordReset.php'>Password Reset</a><br><br>
      <a href='../scripts/php/deleteAccount.php'>Delete Account</a><br><br>
  <a href="../scripts/php/logout.php" class="linkBtn">Sign out</a>
</div>
    