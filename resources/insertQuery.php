<?php
    //Function to add a new account to database. If succesful returns the new primary key.
    function insertAccount($conn, $array){
      $query = "INSERT INTO userSE (email, name, company, phone_number, dob, address, town, county, post_code, password, role) VALUES ('".$array['email']."', '".$array['name']."', '".$array['company']."', '".$array['phone_number']."', '".$array['dob']."', '".$array['address']."', '".$array['town']."', '".$array['county']."', '".$array['post_code']."', '".$array['password']."', '".$array['role']."')";
      if(mysqli_query($conn, $query)){
        $user_id = mysqli_insert_id($conn);
        return $user_id;
      }
   }
  //Function to add a new task to the database. If succesful returns the new primary key.
  function insertTask($conn, $array){
    $query = "INSERT INTO task (task_name, task_description, task_length, task_reference, task_type, task_source) VALUES ('".$array['task_name']."', '".$array['task_description']."', '".$array['task_length']."', '".$array['task_reference']."', '".$array['task_type']."', '".$array['task_source']."')";
    if(mysqli_query($conn, $query)){
      $task_id = mysqli_insert_id($conn);
      return $task_id;
    }
  }
  //Function to add a new course to the database. If succesful returns the new primary key.
  function insertCourse($conn, $array){
    $query = "INSERT INTO course (course_name, course_description) VALUES ('".$array['course_name']."', '".$array['course_description']."')";
    if(mysqli_query($conn, $query)){
      $course_id = mysqli_insert_id($conn);
      return $course_id;
    }
  }
  //Function to add a new relation between a course and a task based on thier primary keys.
  function insertCourseTaskLink($conn, $course_id, $task_id){
    $query = "INSERT INTO course_task_link (course_id, task_id) VALUES ('$course_id', '$task_id')";
    if(mysqli_query($conn, $query)){
      return true;
    }
  }
  //Function to add a new relation between a course and a user based on thier primary keys.
  function insertCourseUserLink($conn, $course_id, $user_id){
    $query = "INSERT INTO course_user_link (course_id, user_id, complete) VALUES ('$course_id', '$user_id', 'no')";
    if(mysqli_query($conn, $query)){
      return true;
    }
  }
?>