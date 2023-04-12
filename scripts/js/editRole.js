//Define query selectors.
const listItems = document.querySelectorAll('.listItem');
const listBtns = document.querySelectorAll('.changeBtn');

//Adds the drop down menu to select the role.
listItems.forEach(item => {
  item.addEventListener('change', function role(){
    let id = event.target.id;
    let value = document.getElementById(id).value;
    let selected = document.getElementById("selectedRole").value = value;
  })
});

//Adds the buttons to change the role.
listBtns.forEach(btn =>{
  btn.addEventListener('click', function changeRole(){
    let id = event.target.id;
    document.getElementById("user_id").value = id;
    document.forms["editRole"].submit();
  })
});

