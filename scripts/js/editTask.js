//Define event listeners. 
document.getElementById("editBtn").addEventListener("click", submit);

//Function to validate task details before submission.
function submit(){
  let taskName = document.forms["editTaskForm"]["task_name"].value;
  let taskLength = document.forms["editTaskForm"]["task_length"].value;
  let taskSource = document.forms["editTaskForm"]["task_source"].value;
  let taskDescription = document.getElementById("task_desc").value;
  let nameFormat = /^[A-Za-z\s]+$/;
  if(taskName == "" || taskSource == "" || taskDescription == "" || taskLength == 0){
    showError();
  }
  else if(!taskName.match(nameFormat)){
    alert("Task Name is invalid!");
  }
  else{
    if(confirm("Are you sure?") == true){
      document.forms["editTaskForm"].submit();
    }
  }
}

//Function to show page error messages.
function showError(){
  let error = document.getElementsByClassName("errorHidden");
  for(let i = 0; i < error.length; i++){
      error[i].style.display = "inline";
  }
}