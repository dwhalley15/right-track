<?php
    //Function to delete a user based on user_id.
    function deleteUser($conn, $user_id){
      $query = "DELETE FROM userSE WHERE user_id=$user_id";
      if(mysqli_query($conn, $query)){
        return true;
      }
      else{
        return false;
      }
    }
    //Function to delete a task based on task_id.
    function deleteTask($conn, $task_id){
      $query = "DELETE FROM task WHERE task_id=$task_id";
      if(mysqli_query($conn, $query)){
        return true;
      }
      else{
        return false;
      }
    }
    //Function to delete a relation between task and course based on course_id.
    function deleteTaskLink($conn, $course_id){
      $query = "DELETE FROM course_task_link WHERE course_id=$course_id";
      if(mysqli_query($conn, $query)){
        return true;
      }
    }
    //Function to deletes a course based on course_id.
    function deleteCourse($conn, $course_id){
      $query = "DELETE FROM course WHERE course_id=$course_id";
      if(mysqli_query($conn, $query)){
        return true;
      }
    }
?>