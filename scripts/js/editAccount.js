//Define event listeners. 
document.getElementById("editBtn").addEventListener("click", submit);

//Function to validate the user inputs before submission.
function submit(){
  let name = document.forms["editForm"]["name"].value;
  let company = document.forms["editForm"]["company"].value;
  let pNumb = document.forms["editForm"]["pNumb"].value;
  let dob = document.forms["editForm"]["dob"].value;
  let sAddress = document.forms["editForm"]["sAddress"].value;
  let tAddress = document.forms["editForm"]["tAddress"].value;
  let cAddress = document.forms["editForm"]["cAddress"].value;
  let pAddress = document.forms["editForm"]["pAddress"].value;
  let nameFormat = /^[A-Za-z\s]+$/;
  var phoneFormat = /^\d{11}$/;
  var pCodeFormat = /[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}/i;
  if(name == "" || company == "" || sAddress == "" || tAddress == "" || cAddress == ""){
    showError();
  }
  else if(!company.match(nameFormat)){
    alert("You have entered an invalid company name!");
    document.forms["editForm"]["company"].value = "";
  }
  else if(!name.match(nameFormat)){
    alert("You have entered an invalid name!");
    document.forms["editForm"]["name"].value = "";
  }
  else if(!tAddress.match(nameFormat) || !cAddress.match(nameFormat)){
    alert("You have entered an invalid address!");
    document.forms["editForm"]["tAddress"].value = "";
    document.forms["editForm"]["cAddress"].value = "";
  }
  else if(!pNumb.match(phoneFormat)){
    alert("You have entered an invalid Phone Number!");
    document.forms["editForm"]["pNumb"].value = 0;
  }
  else if(!pAddress.match(pCodeFormat)){
    alert("You have entered an invalid Post Code!");
    document.forms["editForm"]["pAddress"].value = "";
  }
  else{
    if(confirm("Are you sure?") == true){
      document.forms["editForm"].submit();
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