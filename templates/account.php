<?php
  session_start();
  //Routes the an unauthenticated user back to the login page.
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
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
    <h3>Welcome <?php echo htmlspecialchars($_SESSION['role']) . " " . htmlspecialchars($_SESSION['name']); ?></h3>  
  <div class="content">
    <img class='rtLogo' src='../images/righttracklogo.png' alt='right-tracklogo'>
  </div>
  </body>
</html>