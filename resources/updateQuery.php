<?php
    //Function to update all details (exluduing role) of an existing user account record based on the primary key.
    function updateAccount($conn, $array){
      $query = "UPDATE userSE SET
                name='".$array['name']."',
                company='".$array['company']."',
                phone_number='".$array['phone_number']."',
                dob='".$array['dob']."',
                address='".$array['address']."',
                town='".$array['town']."',
                county='".$array['county']."',
                post_code='".$array['post_code']."'
                WHERE user_id='".$array['user_id']."'";
      if(mysqli_query($conn, $query)){
        return true;
      }
      else{
        return false;
      }
    }
    //Function to updates the role attribute of an existing user based on the primary key.
    function updateRole($conn, $user_id, $role){
      $query = "UPDATE userSE SET role='$role' WHERE user_id='$user_id'";
      if(mysqli_query($conn, $query)){
        return true;
      }
      else{
        return false;
      }
    }
    //Function to update the password attribute of a user based on the primary key.
    function updatePass($conn, $array){
      $query = "UPDATE userSE SET
                password='".$array['password']."'
                WHERE user_id='".$array['user_id']."'";
      if(mysqli_query($conn, $query)){
        return true;
      }
      else{
        return false;
      }
    }
    //Function to update all details of a task based on the primary key.
    function updateTask($conn, $array){
      $query = "UPDATE task SET 
                task_name='".$array['task_name']."',
                task_description='".$array['task_description']."',
                task_length='".$array['task_length']."',
                task_type='".$array['task_type']."',
                task_source='".$array['task_source']."'
                WHERE task_id='".$array['task_id']."'";
      if(mysqli_query($conn, $query)){
        return true;
      }
      else{
        return false;
      }
    }
    //Function to update all the details of a course based on the primary key.
    function updateCourse($conn, $course_id, $array){
      $query = "UPDATE course SET
                course_name ='".$array['course_name']."',
                course_description = '".$array['course_description']."'
                WHERE course_id = '".$array['course_id']."'";
      if(mysqli_query($conn, $query)){
        return true;
      }
    }
  //Function to update the complete attribute to yes based on the composite primary key.
  function updateCourseCompleted($conn, $course_id, $user_id){
      $query = "UPDATE course_user_link SET
                complete ='yes'
                WHERE course_id='$course_id' AND user_id='$user_id'";
      if(mysqli_query($conn, $query)){
        return true;
      }
  }
  //Function to update the complete attribute to no based on the composite primary key.
  function updateCourseReassigned($conn, $course_id, $user_id){
      $query = "UPDATE course_user_link SET
                complete ='no'
                WHERE course_id='$course_id' AND user_id='$user_id'";
      if(mysqli_query($conn, $query)){
        return true;
      }
  }
?>