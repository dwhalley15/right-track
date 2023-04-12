<?php     
  session_start(); 
  //Routes authenticated user to account page if logged in.
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header("location: account.php");
    exit;
  }
  //Verifies a users email address and password before creating session variables which facilitate log in.
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '../resources/database.php';
    include '../resources/selectQuery.php';
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $login_error = "";
    $conn = connect();
    $account = logIn($conn, $email, $pass);
    $verified = password_verify($pass, $account['password']);
    disconnect($conn);
    if(empty($account)){
      $login_error = "This account does not exist";
    }
    else if(!$verified){
      $login_error = "Password is incorrect!";
    }
    else{
      $_SESSION['loggedin'] = true;
      $_SESSION['user_id'] = $account['user_id'];
      $_SESSION['name'] = $account['name'];
      $_SESSION['role'] = $account['role'];
      header("location: account.php");
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
    <div class="content">
      <div class="form">
        <form name="login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <fieldset class="fieldset">
            <legend>Log In</legend>
              <label for="email">Email Address:</label><span class="errorShown"><?php if(!empty($login_error)) echo "*";?></span>
              <input type="email" id="email" name="email" placeholder="Email Address" maxlength="255" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required>
              <label for="password">Password:</label><span class="errorShown"><?php if(!empty($login_error)) echo "*";?></span>
              <input type="password" id="password" name="password" placeholder="Password" maxlength="255" value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>" required>
          <a class="linkBtn" href="#newPass">Forgot password?</a>
          </fieldset>
          <input type="submit" class="submitBtn" value="Log In">
          <p class='errorShown'><?php if(!empty($login_error)) echo $login_error;?></p>
          <p>New Customer? <a class="linkBtn" href="signup.php">Create an account</a></p>
        </form>
      </div>
    </div> 
  </body>
</html>