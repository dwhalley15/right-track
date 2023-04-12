//Gets the task length from the input.
let taskLength = document.getElementById("taskLength").value;

//Sets the timer by adding the task length to the current time in miliseconds.
let timer = new Date().getTime() + taskLength * 60000;

//Sets an interval to repeat every second which takes the current time and subtracts it from the timer.
//Also displays the minutes and seconds left on the timer and the complete button when the timer reaches 0.
var interval = setInterval(function(){
  var now = new Date().getTime();
  var elapsed = timer - now;
  var minutes = Math.floor((elapsed % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((elapsed % (1000 * 60)) / 1000);
  document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";
  if(elapsed < 0){
    clearInterval(interval);
    document.getElementById("completeTaskBtn").style.display = "inline-block";
    document.getElementById("timer").style.display = "none";
  }
}, 1000);
