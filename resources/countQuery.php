<?php
    //Function which returns a count of all existing accounts with a given parameter email. Used to check an account with a duplicate email does not already exist.
    function duplicate($conn, $email){
      $result = mysqli_query($conn, "SELECT count(*) AS count_all FROM userSE WHERE email='$email'");
      $row = mysqli_fetch_array($result);
      $count = $row['count_all'];
      return $count;
    }
    //Function which returns a count of all existing tasks with a parameter reference. Used to check a task with the same reference does not already exist.
    function dupTask($conn, $task_reference){
      $result = mysqli_query($conn, "SELECT count(*) AS count_all FROM task WHERE task_reference='$task_reference'");
      $row = mysqli_fetch_array($result);
      $count = $row['count_all'];
      return $count;
    }
    //Function which returns a count of the relations between a user and a course based on thier primary keys. Used to check a course has not already been assigned to a user.
    function dupAssignCourse($conn, $course_id, $user_id){
      $result = mysqli_query($conn, "SELECT count(*) AS count_all FROM course_user_link WHERE course_id='$course_id' AND user_id='$user_id'");
      $row = mysqli_fetch_array($result);
      $count = $row['count_all'];
      return $count;
    }
    //Function which returns a count of the current course relations. Used to check if a course has not yet been assigned to a user.
    function countCourseLinks($conn, $course_id){
      $result = mysqli_query($conn, "SELECT count(*) AS count_all FROM course_user_link INNER JOIN course ON course_user_link.course_id=course.course_id WHERE course_user_link.course_id=$course_id");
      $row = mysqli_fetch_array($result);
      $count = $row['count_all'];
      return $count;
    }
?>