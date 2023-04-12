<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] != 'administrator'){
    header("location: login.php");
    exit;
  }
  //Calls required classes.
  include '../resources/database.php';
  include '../resources/updateQuery.php';
  //Update the user role based on the user_id then refreshes the page. Shows error message if unsuccsesful. 
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $user_id = $_POST['user_id'];
    $role = $_POST['selectedRole'];
    if(!empty($role)){
      $conn = connect();
      $roleUpdate = updateRole($conn, $user_id, $role);
      if($roleUpdate == true){
        disconnect($conn);
        header("Refresh: 0");
      }
      else{
        disconnect($conn);
        $msg = "Update failed please try again.";
      }
    }
    else{
      $msg = "Please select a role!";
    }
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
    <h3>Edit User Roles</h3>
    <div class='content'>
      <form name='editRole' id='editRole' method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
        <input type="hidden" value="" name="user_id" id="user_id">
        <input type="hidden" value="" name="selectedRole" id="selectedRole">
        </form>
        <ul>
          <?php 
            //Selects all users from the database and displays them onscreen. 
            include '../resources/selectQuery.php';
            $conn = connect();
            $result = selectAllUsers($conn);
            while($row = mysqli_fetch_assoc($result)){
              echo "<li><strong>".$row['name']."</strong> current role:<strong> ".$row['role']."</strong> change role to: <select class='listItem' id='r".$row['user_id']."'>
                <option class='options' value=''>Pick a Role</option>
                <option class='options' value='trainee'>trainee</option>
                <option class='options' value='manager'>manager</option>
                <option class='options' value='administrator'>administrator</option>
              </select>
              <button class='changeBtn' id='".$row['user_id']."'>Edit</button></li>";
            }
            disconnect($conn);
          ?>
        </ul>
      <p class='errorShown'><?php if(!empty($msg)) echo $msg;?></p>
    </div> 
    <script src="../scripts/js/editRole.js" defer></script> 
  </body>
</html>