//Define event listeners. 
document.getElementById("nextBtn").addEventListener("click", nextTab);
document.getElementById("prevBtn").addEventListener("click", prevTab);
document.getElementById("submitBtn").addEventListener("click", passValidation);

//Tab number variable.
var currentTab = 0;

//Function to move the tab forward
function nextTab(){
    currentTab = currentTab + 1;
    showTab(currentTab);
}

//Function to move the tab backward
function prevTab(){
  currentTab = currentTab - 1;
  showTab(currentTab);
}

//Function that moves the tab on providing the inputs pass validation.
function showTab(tab){
  let tabZero = document.getElementById("tabZero");
  let tabOne = document.getElementById("tabOne");
  let tabTwo = document.getElementById("tabTwo");
  let tabThree = document.getElementById("tabThree");
  let nextBtn = document.getElementById("nextBtn");
  let prevBtn = document.getElementById("prevBtn");
  let submitBtn = document.getElementById("submitBtn");
  let stepOne = document.getElementById("stepOne");
  let stepTwo = document.getElementById("stepTwo");
  let stepThree = document.getElementById("stepThree");
  let stepFour = document.getElementById("stepFour");
  
  clearError();
  
  if(tab == 0){
    tabZero.className = "show";
    tabOne.className = "hidden";
    prevBtn.style.visibility  = "hidden";
    stepOne.style.backgroundColor = "#02353C";
    stepOne.style.opacity = "1";
    stepTwo.style.backgroundColor = "#C1F6ED";
    stepTwo.style.opacity = "0.5";
  }
  else if(tab == 1 && nameValidation() == true){
    tabZero.className = "hidden";
    tabOne.className = "show";
    tabTwo.className = "hidden";
    prevBtn.style.visibility = "visible";
    stepOne.style.backgroundColor = "#C1F6ED";
    stepOne.style.opacity = "0.5";
    stepTwo.style.backgroundColor = "#02353C";
    stepTwo.style.opacity = "1";
    stepThree.style.backgroundColor = "#C1F6ED";
    stepThree.style.opacity = "0.5";
  }
  else if(tab == 2 && contactValidation() == true){
    tabOne.className = "hidden";
    tabTwo.className = "show";
    tabThree.className = "hidden";
    nextBtn.style.display = "inline";
    submitBtn.style.display = "none";
    stepTwo.style.backgroundColor = "#C1F6ED";
    stepTwo.style.opacity = "0.5";
    stepThree.style.backgroundColor = "#02353C";
    stepThree.style.opacity = "1";
    stepFour.style.backgroundColor = "#C1F6ED";
    stepFour.style.opacity = "0.5";
  }
  else if(tab == 3 && addValidation() == true){
    tabTwo.className = "hidden";
    tabThree.className = "show";
    nextBtn.style.display = "none";
    submitBtn.style.display = "inline";
    stepThree.style.backgroundColor = "#C1F6ED";
    stepThree.style.opacity = "0.5";
    stepFour.style.backgroundColor = "#02353C";
    stepFour.style.opacity = "1";
  }
  else{
    prevTab();
    showError();
  }
}

//Validates the user name and email. 
function nameValidation(){
  let valid = true;
  let email = document.forms["signup"]["email"].value;
  let name = document.forms["signup"]["name"].value;
  let nameFormat = /^[A-Za-z\s]+$/;
  var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if(name == "" || email == ""){
      valid = false;
  }
  else if(!name.match(nameFormat)){
    alert("You have entered an invalid name!");
    document.forms["signup"]["name"].value = "";
    valid = false;
  }
  else if (!email.match(mailFormat)){
    alert("You have entered an invalid email address!");
    document.forms["signup"]["email"].value = "";
    valid = false;
  }
  return valid;
}

//Validates the user company, phone number and date of birth.
function contactValidation(){
  let valid = true;
  let company = document.forms["signup"]["company"].value;
  let pNumb = document.forms["signup"]["pNumb"].value;
  let dob = document.forms["signup"]["dob"].value;
  let nameFormat = /^[A-Za-z\s]+$/;
  var phoneFormat = /^\d{11}$/;
  if(company == "" || pNumb == "" || dob == ""){
      valid = false;
  }
  else if(!company.match(nameFormat)){
    alert("You have entered an invalid company name!");
    document.forms["signup"]["company"].value = "";
    valid = false;
  }
  else if(!pNumb.match(phoneFormat)){
    alert("You have entered an invalid phone number!");
    document.forms["signup"]["pNumb"].value = 0;
    valid = false;
  }
  return valid;
}

//Validates the user address and post code.
function addValidation(){
  let valid = true;
  let sAdd = document.forms["signup"]["sAddress"].value;
  let tAdd = document.forms["signup"]["tAddress"].value;
  let cAdd = document.forms["signup"]["cAddress"].value;
  let pCode = document.forms["signup"]["pAddress"].value;
  let nameFormat = /^[A-Za-z\s]+$/;
  var pCodeFormat = /[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}/i;
  if(sAdd == "" || tAdd == "" || cAdd == "" || pCode == ""){
      valid = false;
  }
  else if(!tAdd.match(nameFormat)){
    alert("You have entered an invalid town or city!");
    document.forms["signup"]["tAddress"].value = "";
    valid = false;
  }
    else if(!cAdd.match(nameFormat)){
    alert("You have entered an invalid county!");
    document.forms["signup"]["cAddress"].value = "";
    valid = false;
  }
  else if(!pCode.match(pCodeFormat)){
    alert("You have entered an invalid post code!");
    document.forms["signup"]["pAddress"].value = "";
    valid = false;
  }
  
  return valid;
}

//Validates the users password before submission.
function passValidation(){
  let pass = document.forms["signup"]["password"].value;
  let cPass = document.forms["signup"]["cPassword"].value;
  var passFormat = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;
  if(pass == "" || cPass == ""){
    showError();
  }
  else if(pass != cPass){
    alert("Your passwords do not match!");
    document.forms["signup"]["cPassword"].value = "";
  }
  else if(!pass.match(passFormat)){
    alert("Your password must have 8 characters, have upper and lower case letters and have a number!");
    document.forms["signup"]["cPassword"].value = "";
  }
  else{
    document.forms["signup"].submit();
  }
}

//Function to show page error messages.
function showError(){
  let error = document.getElementsByClassName("errorHidden");
  for(let i = 0; i < error.length; i++){
      error[i].style.display = "inline";
  }
}

//Function to remove page error messages.
function clearError(){
  let error = document.getElementsByClassName("errorHidden");
  for(let i = 0; i < error.length; i++){
      error[i].style.display = "none";
  }
}