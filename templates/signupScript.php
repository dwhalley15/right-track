<!DOCTYPE html>
<html>
    <?php 
          include "head.php";
          include "header.php";   
    ?>
  <body>
    <div class="content">
      <?php
        if(!empty($_POST) && isset($_POST)){
          //Define all variables from POST request.
          $email = $_POST['email'];
          $name = $_POST['name'];
          $company = $_POST['company'];
          $phone_number = $_POST['pNumb'];
          $dob = $_POST['dob'];
          $address = $_POST['sAddress'];
          $town = $_POST['tAddress'];
          $county = $_POST['cAddress'];
          $post_code = $_POST['pAddress'];
          $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
          $role = "trainee";
          //Put all vairables into a multidimensional array.
          $newAccount = array(
            "email"=>$email,
            "name"=>$name,
            "company"=>$company,
            "phone_number"=>$phone_number,
            "dob"=>$dob,
            "address"=>$address,
            "town"=>$town,
            "county"=>$county,
            "post_code"=>$post_code,
            "password"=>$password,
            "role"=>$role
          );
          //Calls required classes.
          include '../resources/database.php';
          include '../resources/insertQuery.php';
          include '../resources/countQuery.php';
          //Connect to the database.
          $conn = connect();
          //Checks no other accounts with the same email address exist, show error if they do.
          $count = duplicate($conn, $newAccount['email']);
          if($count == 0){
            //Add account details to the database show error if unsuccsessful.
            $user_id = insertAccount($conn, $newAccount);
            if(empty($user_id)){
              echo "<span class='errorShown'>Failed to create new account please return to <a class='linkBtn' href='signup.php'>sign up</a> page!</span>";
              disconnect($conn);
            }
            else{
              disconnect($conn);
              echo"<h3>Congratulations " . $name . "</h3>
                  <p>Your account has been created!</p>
                  <p>Click <a class-'linkBtn' href='login.php'>here</a> to log in.</p>
                  ";
            }
          }
          else{
            echo "<span class='errorShown'>This account already exists please return to <a class='linkBtn' href='signup.php'>sign up</a> page!</span>";
            disconnect($conn);
          }
        }
        else{
          echo "<span class='errorShown'>Failed to create new account please return to <a class='linkBtn' href='signup.php'>sign up</a> page!</span>";
        }
      ?>
    </div>
  </body>
</html>