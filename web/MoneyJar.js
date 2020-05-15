var login = document.getElementById('id01');
var signup = document.getElementById('id02');


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == login) {
    login.style.display = "none";
  }
  else if (event.target == signup){
    signup.style.display = "none";
  }
}



/////////////////////////////////Logon class

function checkCredentials(){
  $.ajax({
    url:"Landing.php", //the page containing php script
    type: "POST", //request type
    success:function(result){
     alert(result);
   }
 });
}





//////////////////////////////// New Account Class

function createNewAccount(){

}

////////////////////////////////