//Define event listeners. 
document.getElementById("createTaskBtn").addEventListener("click", createTask);
document.getElementById("task_type").addEventListener("change", changeType);

//Function that changes the input type of the source based on the tpype of task.
function changeType(){
  let type = document.getElementById('task_type').value;
  if(type == 2){
    document.getElementById('task_source').type = "text";
  }
  else if(type == 1){
    document.getElementById('task_source').type = "text";
  }
  else{
    document.getElementById('task_source').type = "file";
  }
}

//Function to validate the task details before submitting.
function createTask(){
  let taskName = document.forms["create_task"]["task_name"].value;
  let taskLength = document.forms["create_task"]["task_length"].value;
  let taskSource = document.forms["create_task"]["task_source"].value;
  let taskReference = document.forms["create_task"]["task_ref"].value;
  let taskDescription = document.getElementById("task_desc").value;
  let nameFormat = /^[A-Za-z\s]+$/;
  if(taskName == "" || taskSource == "" || taskReference == 0 || taskDescription == "" || taskLength == 0){
    showError();
  }
  else if(!taskName.match(nameFormat)){
    alert("Task Name is invalid!");
  }
  else if(isNaN(taskLength) || isNaN(taskReference)){
    alert("Task Length and Task Reference must be numbers!");
  }
  else{
    document.forms["create_task"].submit();
  }
}

//Function to show page error messages.
function showError(){
  let error = document.getElementsByClassName("errorHidden");
  for(let i = 0; i < error.length; i++){
      error[i].style.display = "inline";
  }
}
