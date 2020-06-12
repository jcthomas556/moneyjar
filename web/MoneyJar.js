var login = document.getElementById('id01');
var signup = document.getElementById('id02');
var newJar = document.getElementById('newJar');


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == login) {
    login.style.display = "none";
  }
  else if (event.target == signup){
    signup.style.display = "none";
  }
  else if (event.target == newJar){
    newJar.style.display = "none";
  }
}



/////////////////////////////////Logon class

function checkCredentials(){
  $.ajax({
    url:"Landing.php", //the page containing php script
    type: "POST", //request type
    success:function(result){
     
   }
 });
}





//////////////////////////////// Check user account Class

function checkUserAccount(){
    var checker = document.getElementById('signedInMessage');
    //TODO fix this bad system. Checking for something on the page is not a good way to tell if I'm signed in. look at the session variables.
    if(checker === null){
      alert("Please sign in or sign up");
    }
    else{
      window.location='https://intense-fjord-38137.herokuapp.com/web/AccountPage.php';
    }
}

////////////////////////////////

function goPlaces(){
  window.location='https://intense-fjord-38137.herokuapp.com/web/Jars.php';
}

function signOut(){
   sessionStorage.clear();
   window.location='https://intense-fjord-38137.herokuapp.com/web/Landing.php';
}

function createJar(){

}