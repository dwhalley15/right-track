<?php
  session_start();
  //Routes the an unauthenticated user back to the login page
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header("location: login.php");
    exit;
  }
  //Calls required classes.
  include '../resources/database.php';
  include '../resources/selectQuery.php';
  include '../resources/updateQuery.php';
  $user_id = $_SESSION['user_id'];
  //Connect to the database.
  $conn = connect();
  //Selects all the authenticated user details based on thier user_id.
  $account = selectAccount($conn, $user_id);
  disconnect($conn);
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Define all variables from POST request.
    $name = $_POST['name'];
    $company = $_POST['company'];
    $phone_number = $_POST['pNumb'];
    $dob = $_POST['dob'];
    $address = $_POST['sAddress'];
    $town = $_POST['tAddress'];
    $county = $_POST['cAddress'];
    $post_code = $_POST['pAddress'];
    //Put all variables into a multidimensional array.
    $editAccount = array(
            "user_id"=>$user_id,
            "name"=>$name,
            "company"=>$company,
            "phone_number"=>$phone_number,
            "dob"=>$dob,
            "address"=>$address,
            "town"=>$town,
            "county"=>$county,
            "post_code"=>$post_code
          );
    $conn = connect();
    //Updates all the user details on ther database based on thier user_id then refreshed the page. Shows error message if unsuccsesful. 
    $result = updateAccount($conn, $editAccount);
    if($result == true){
      disconnect($conn);
      header("Refresh: 0");
    }
    else{
      disconnect($conn);
      $msg = "Update failed please try again.";
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
    <h3>Account Details</h3>
    <div class='content'>
      <form name='editForm' method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
        <div class='editForm'>
          <table>
            <tr>
              <td>Name:<span class="errorHidden">*</span></td>
              <td><input type="text" id="name" name="name" maxlength="255" value="<?php echo $account['name']?>" required></td>
            </tr>
            <tr>
              <td>Company:<span class="errorHidden">*</span></td>
              <td><input type="text" id="company" name="company" maxlength="255" value="<?php echo $account['company']?>" required></td>
            </tr>
            <tr>
              <td>Number:<span class="errorHidden">*</span></td>
              <td><input type="tel" id="pNumb" name="pNumb" pattern="[0-9]{5}-[0-9]{6}" value="<?php echo $account['phone_number']?>" required></td>
            </tr>
            <tr>
              <td>DoB:<span class="errorHidden">*</span></td>
              <td><input type="date" id="dob" name="dob" value="<?php echo $account['dob']?>" required></td>
            </tr>
            <tr>
              <td>Address:</label><span class="errorHidden">*</span></td>
              <td><input type="text" id="sAddress" name="sAddress" maxlength="255" value="<?php echo $account['address']?>" required></td>
            </tr>
            <tr>
              <td>Town:</label><span class="errorHidden">*</span></td>
              <td><input type="text" id="tAddress" name="tAddress" maxlength="255" value="<?php echo $account['town']?>" required></td>
            </tr>
            <tr>
              <td>County:</label><span class="errorHidden">*</span></td>
              <td><input type="text" id="cAddress" name="cAddress" maxlength="255" value="<?php echo $account['county']?>" required></td>
            </tr>
            <tr>
              <td>Post Code:</label><span class="errorHidden">*</span></td>
              <td><input type="text" id="pAddress" name="pAddress" maxlength="8" value="<?php echo $account['post_code']?>" required></td>
            </tr>
          </table>
          <p class="errorHidden" id="formValidation">Fields marked with * must be completed!</p>
          <p><?php if(!empty($msg)) echo $msg;?></p><p><?php if(!empty($msg)) echo $msg;?></p>
          <input type="button" name="editBtn" id="editBtn" class="submitBtn" value="Edit Details">
        </div>
      </form>
    </div>
    <script src="../scripts/js/editAccount.js" defer></script> 
  </body>
</html>