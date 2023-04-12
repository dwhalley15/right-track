<?php
    //Function to return the attributes from a user needed for log in.
    function logIn($conn, $email, $pass){
      $result = mysqli_query($conn, "SELECT user_id, email, name, password, role FROM userSE WHERE email = '$email'");
      $row = mysqli_fetch_array($result);
      return $row;
    }
    //Function to return all details of an account based on primary key.
    function selectAccount($conn, $user_id){
      $result = mysqli_query($conn, "SELECT * FROM userSE WHERE user_id = '$user_id'");
      $row = mysqli_fetch_assoc($result);
      return $row;
    }
    //Function to return the primary keys of all user entries.
    function selectAllUsers($conn){
      $result = mysqli_query($conn, "SELECT user_id, name, role FROM userSE");
      return $result;
    }
    //Function to return all details of all existing tasks.
    function selectAllTasks($conn){
      $result = mysqli_query($conn, "SELECT * from task");
      return $result;
    }
    //Function to return the details of a single task based on primary key.
    function selectTask($conn, $task_id){
      $result = mysqli_query($conn, "SELECT * FROM task WHERE task_id=$task_id");
      $row = mysqli_fetch_array($result);
      return $row;
    }
    //Function to return all the details of all existing courses.
    function selectAllCourses($conn){
      $result = mysqli_query($conn, "SELECT * FROM course");
      return $result;
    }
    //Function to return all task details relative to the course they have been added to based on the course primary key.
    function selectCourseTasks($conn, $course_id){
      $result = mysqli_query($conn, "SELECT * FROM course_task_link INNER JOIN task ON course_task_link.task_id=task.task_id WHERE course_id=$course_id");
      return $result;
    }
   //Function to return details of tasks based on one or more primary keys.
    function selectTasks($conn, $task_ids){
      $result = mysqli_query($conn, "SELECT * FROM task WHERE task_id IN ($task_ids)");
      return $result;
    }
    //Function to return the details of a course based on its primary key.
    function selectCourse($conn, $course_id){
      $result = mysqli_query($conn, "SELECT * FROM course WHERE course_id=$course_id");
      $row = mysqli_fetch_array($result);
      return $row;
    }
    //Function to return the details of all trainee users that are not in a list of primary keys.
    function selectTrainees($conn, $user_ids){
      $result = mysqli_query($conn, "SELECT * FROM userSE WHERE role='trainee' AND user_id NOT IN ($user_ids)");
      return $result;
    }
    //Function to return the details of all trainee users.
    function allTrainees($conn){
        $result = mysqli_query($conn, "SELECT * FROM userSE WHERE role='trainee'");
        return $result;
      }
    //Function to return all the courses related to a user based on the user primary key.
    function selectUserCourses($conn, $user_id){
      $result = mysqli_query($conn, "SELECT * FROM course_user_link INNER JOIN course ON course_user_link.course_id=course.course_id WHERE user_id=$user_id");
      return $result;
    }
    //Function to return the details of courses assigned to a user based on both primary keys.
    function selectCourseComplete($conn, $course_id, $user_id){
      $result = mysqli_query($conn, "SELECT * FROM course_user_link WHERE course_id=$course_id AND user_id=$user_id");
      $row = mysqli_fetch_array($result);
      return $row;
    }
    //Function to return all courses that have been completed.
    function selectCompletedCourses($conn){
      $result = mysqli_query($conn, "SELECT * FROM course_user_link INNER JOIN userSE ON course_user_link.user_id=userSE.user_id INNER JOIN course ON course_user_link.course_id=course.course_id WHERE complete='yes'");
      return $result;
    }
    //Function to return all courses that are currently assigned to a user.
    function selectCourseUsers($conn, $course_id){
      $result = mysqli_query($conn, "SELECT * FROM course_user_link INNER JOIN course ON course_user_link.course_id=course.course_id WHERE course_user_link.course_id=$course_id");
      return $result;
    }
?>