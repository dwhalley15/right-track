//Define event listeners. 
document.getElementById("createCourseBtn").addEventListener("click", createCourse);

//Function to validate the course inputs, also checks the course has atleast one task added before creating.
function createCourse(){
  let courseName = document.forms["create_course"]["course_name"].value;
  let courseDesc = document.getElementById("course_desc").value;
  let taskList = document.querySelector('.task_on_course');
  if(courseName == "" || courseDesc == ""){
    showError();
  }
  else if(taskList == null){
    alert("Must add tasks");
  }
  else{
    document.forms["create_course"].submit();
  }
}

//Function that adds the add task buttons to the tasks and links them to the addTaskToCourse script.
var btns = document.querySelectorAll('.addTaskBtn');
btns.forEach(function(btn) {
  btn.addEventListener('click', function(){
    let taskId = event.target.id;
    if(confirm("Add this task?") == true){
      window.location.href="../scripts/php/addTaskToCourse.php?task_id="+taskId;
    }
  });
});

//Function that adds the remove task buttons to the tasks removeTaskFromCourse script.
var rems = document.querySelectorAll('.removeTaskBtn');
rems.forEach(function(rem) {
  rem.addEventListener('click', function(){
    let taskId = event.target.id;
    if(confirm("Remove this task?") == true){
      window.location.href="../scripts/php/removeTaskFromCourse.php?task_id="+taskId;
    }
  });
});

//Function to show page error messages.
function showError(){
  let error = document.getElementsByClassName("errorHidden");
  for(let i = 0; i < error.length; i++){
      error[i].style.display = "inline";
  }
}

