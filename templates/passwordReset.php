<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header("location: login.php");
    exit;
  }
  //Validates and updates a users password based on primary key.
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '../resources/database.php';
    include '../resources/updateQuery.php';
    $user_id = $_SESSION['user_id'];
    $pass = $_POST['password'];
    $cPass = $_POST['cPassword'];
    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $number = preg_match('@[0-9]@', $pass);
    $login_error = "";
    if($pass == "" || $cPass == ""){
      $login_error = "Password not filled in!";
    }
    else if(!$uppercase || !$lowercase || !$number || strlen($pass) < 8){
      $login_error = "Your password must have 8 characters, have upper and lower case letters and have a number!!";
    }
    else if($pass != $cPass){
      $login_error = "Passwords do not match!";
    }
    else{
      $hash = password_hash($pass, PASSWORD_DEFAULT);
      $editAccount = array(
        "user_id"=>$user_id,
        "password"=>$hash
      );  
      $conn = connect();
      $result = updatePass($conn, $editAccount);
      disconnect($conn);
      if($result == true){
        $login_error = "Password updated!.";
      }
      else{
        $login_error = "Failed to update password!.";
      }
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
    <div class="content">
      <h3>Password Reset</h3>
      <div class="form">
        <form name="passwordReset" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <fieldset class="fieldset">
            <legend>Change Password</legend>
              <label for="password">Password:</label><span class="errorShown"><?php if(!empty($login_error)) echo "*";?></span>
              <input type="password" id="password" name="password" placeholder="Password" maxlength="255" value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>" required>
            <label for="cPassword">Confirm Password:</label><span class="errorShown"><?php if(!empty($login_error)) echo "*";?></span>
              <input type="password" id="cPassword" name="cPassword" placeholder="Confirm Password" maxlength="255" value="<?php if(isset($_POST['cPassword'])) echo $_POST['cPassword']; ?>" required>
          </fieldset>
          <input type="submit" class="submitBtn" value="Reset Password">
          <p class='errorShown'><?php if(!empty($login_error)) echo $login_error;?></p>
        </form>
      </div>
    </div>
  </body>
</html>