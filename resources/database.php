<?php
    //Connects to the database.
    function connect(){
      $username = "s5416741";
      $password = "UwzgJi9mJAKXYNpeFqukwCpuRfpLrJT4";
      $host = "db.bucomputing.uk";
      $port = 6612;
      $database = $username;
      $conn = new mysqli();
      $conn->init();
      if(!$conn){
        return "";
      }
      else{
        $conn->ssl_set(NULL, NULL, NULL, '/public_html/sys_tests', NULL);
        $conn->real_connect($host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
        return $conn;    
      }
    }
    //Disconnects from the database.
    function disconnect($conn){
        $conn->close();
    }
?>