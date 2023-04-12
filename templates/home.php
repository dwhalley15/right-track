<?php
  session_start();
  //Routes authenticated user to account page if logged in.
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header("location: account.php");
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
    <div class="content">
      <img class='rtLogo' src='../images/righttracklogo.png' alt='right-tracklogo'>
      <h3>Welcome</h3>
      <p>Please <a class='linkBtn' href='login.php'>log in</a> or <a class='linkBtn' href='signup.php'>sign up</a>.</p>
    </div>
  </body>
</html>