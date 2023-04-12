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
    <?php include "head.php";
          include "header.php";   
    ?>
  <body>
    <div class="content">

      <form name="signup" method="post" action="signupScript.php">

        <div class="shown" id="tabZero">
              <fieldset class="fieldset">
                <legend>Sign Up</legend>
                  <label for="email">Email Address:</label><span class="errorHidden">*</span>
                  <input type="email" id="email" name="email" placeholder="Email Address" maxlength="255" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required>
                  <label for="name">Full Name:</label><span class="errorHidden">*</span>
                  <input type="text" id="name" name="name" placeholder="Full Name" maxlength="255" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" required>
              </fieldset>
              <p class="errorHidden" id="formValidation">Fields marked with * must be completed!</p>
              <p>Already have an account? <a class="linkBtn" href="login.php">Login</a></p>
          </div>
        <div class="hidden" id="tabOne">
              <fieldset class="fieldset">
                <legend>Sign Up</legend>
                  <label for="company">Company Name:</label><span class="errorHidden">*</span>
                  <input type="text" id="company" name="company" placeholder="Company Name" maxlength="255" value="<?php if(isset($_POST['company'])) echo $_POST['company']; ?>" required>
                  <label for="pNumb">Phone Number:</label><span class="errorHidden">*</span>
                  <input type="tel" id="pNumb" name="pNumb" placeholder="Phone Number" pattern="[0-9]{5}-[0-9]{6}" value="<?php if(isset($_POST['pNumb'])) echo $_POST['pNumb']; ?>" required>
                  <label for="dob">Date of Birth:</label><span class="errorHidden">*</span>
                  <input type="date" id="dob" name="dob" value="<?php if(isset($_POST['dob'])) echo $_POST['dob']; else echo date("d/m/Y"); ?>" required>
                <p class="errorHidden" id="formValidation">Fields marked with * must be completed!</p>
              </fieldset>    
        </div>
        <div class="hidden" id="tabTwo">
              <fieldset class="fieldset">
                <legend>Sign Up</legend>
                  <label for="sAddress">Street Address:</label><span class="errorHidden">*</span>
                  <input type="text" id="sAddress" name="sAddress" placeholder="Street Address" maxlength="255" value="<?php if(isset($_POST['sAddress'])) echo $_POST['sAddress']; ?>" required>
                  <label for="tAddress">Town/City:</label><span class="errorHidden">*</span>
                  <input type="text" id="tAddress" name="tAddress" placeholder="Town or City" maxlength="255" value="<?php if(isset($_POST['tAddress'])) echo $_POST['tAddress']; ?>" required>
                  <label for="cAddress">County:</label><span class="errorHidden">*</span>
                  <input type="text" id="cAddress" name="cAddress" placeholder="County" maxlength="255" value="<?php if(isset($_POST['cAddress'])) echo $_POST['cAddress']; ?>" required>
                  <label for="sAddress">Post Code:</label><span class="errorHidden">*</span>
                  <input type="text" id="pAddress" name="pAddress" placeholder="Post Code" maxlength="8" value="<?php if(isset($_POST['pAddress'])) echo $_POST['pAddress']; ?>" required>
                <p class="errorHidden" id="formValidation">Fields marked with * must be completed!</p>
              </fieldset>
        </div>
        <div class="hidden" id="tabThree">
              <fieldset class="fieldset">
                <legend>Sign Up</legend>
                  <label for="password">Password:</label><span class="errorHidden">*</span>
                  <input type="password" id="password" name="password" placeholder="Password" maxlength="255" value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>" required>
                  <label for="cPassword">Confirm Password:</label><span class="errorHidden">*</span>
                  <input type="password" id="cPassword" name="cPassword" placeholder="Confrim Password" maxlength="255" value="<?php if(isset($_POST['cPassword'])) echo $_POST['cPassword']; ?>" required>
                <p class="errorHidden" id="formValidation">Fields marked with * must be completed!</p>
              </fieldset>
        </div>
        <div>
          <input type="button" id="prevBtn" name="prevBtn" class="submitBtn" value="Previous">
          <input type="button" id="nextBtn" name="nextBtn" class="submitBtn" value="Next">
          <input type="button" id="submitBtn" name="submitBtn" class="submitBtn" value="Submit">
        </div>
        </form>
        <div style="text-align:center;margin-top:40px;">
          <span class="step" id="stepOne"></span>
          <span class="step" id="stepTwo"></span>
          <span class="step" id="stepThree"></span>
          <span class="step" id="stepFour"></span>
      </div> 
    </div>
    <script src="../scripts/js/signup.js"></script> 
  </body>
</html>