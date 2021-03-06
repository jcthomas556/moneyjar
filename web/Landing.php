<?php
include('database_connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <link rel="stylesheet" type="text/css" href="MoneyJar.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Money Jar Landing Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@600&display=swap" rel="stylesheet">

</head>

<body class="background">



    <?php 
    //Log In Code
   

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $userSignedIn = false;
        $signInAttempted = false;
        $accountCreationAttempted = false;
        $accountCreated = false;

         $email = $_POST["email"];
         $passwords = $_POST["password"];

         $name = $_POST["name"];
         $email2 = $_POST["email2"];
         $passwords2 = $_POST["password2"];

   

         //if there is no name, they must be logging in, run the login code
         if($name == ""){          
         $signInAttempted = true;
            foreach($db->query(
                "SELECT user_id, user_name FROM accounts WHERE email=crypt('$email', email) AND passwords=crypt('$passwords', passwords)", PDO::FETCH_ASSOC) as $holder)
                {
                    if($holder['user_id'] > 0){
                        $userSignedIn = true;
                        session_start();
                        $userName = $holder['user_name'];
                        $userID = $holder['user_id'];
                        $_SESSION['username'] = $userName;
                        $_SESSION['user_id'] = $userID;

                        $successMessage = "<button onclick='goToAccountPage()' class='btn btn-success' aria-label='right Align'> <span class='glyphicon glyphicon-user btn-success  btn-lg' aria-hidden='true'></span> </button>";
          
                        displaySignedIn();
                        
                    }
                }
        }
        else{//otherwise, they are signing up, run the sign up code.
            $accountCreationAttempted = true;
            $db->query(
                "INSERT INTO accounts (passwords, email, user_name, created_on)
                VALUES(
                    crypt('$passwords2', gen_salt('bf')),
                    crypt('$email2', gen_salt('bf')),
                    '$name',
                    CURRENT_DATE)"
                ); 
                foreach($db->query(
                    "SELECT user_id, user_name FROM accounts WHERE email=crypt('$email2', email) AND passwords=crypt('$passwords2', passwords)", PDO::FETCH_ASSOC) as $holder)
                    {
                        if($holder['user_id'] > 0){
                            $userSignedIn = true;
                            session_start();
                            $userName = $holder['user_name'];
                            $userID = $holder['user_id'];
                            $_SESSION['username'] = $userName;
                            $_SESSION['user_id'] = $userID;
                            displaySignedIn();
                        }
                    }

                
            }
                    
                
            
        if($userSignedIn == false && $signInAttempted == true){
            echo 'Log in failed';
        }
        if($accountCreationAttempted == true && $accountCreated == true){
            echo 'Account Creation Failed';
        }
    }   
    ?>

    <br><br> 

    <div class="text-center">
        <h1>Money Jar</h1>
        <?php 
            function displaySignedIn(){
                echo "<button onclick='signOut()' class='btn btn-success pull-right' aria-label='right Align'> <span class='glyphicon glyphicon-log-out btn-success  btn-lg' aria-hidden='true'></span> </button>";
                echo "<button onclick='goToJars()' class='btn btn-success pull-right' aria-label='right Align'> <span class='glyphicon glyphicon-oil btn-success  btn-lg' aria-hidden='true'></span> </button>";

                echo "<button onclick='goToAccountPage()' class='btn btn-success' aria-label='right Align'> <span class='glyphicon glyphicon-user btn-success  btn-lg' aria-hidden='true'></span> </button>";
                echo "</p>";
               
            }
        ?>
       
    </div>

    <div class="container">
        <div class="text-center">
            <h2>Sign in</h2>
                <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-light">Login</button>

                <!-- The Modal -->
                <div id="id01" class="modal">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close"
                        title="Close Modal">&times;</span>

                    <!-- Modal Content -->
                    <form class="modal-content animate" method="POST" action="Landing.php">

                        <div class="sign-in-background">
                            <div class="container">
                                <br>
                                <label for="uname"><b>Username</b></label>
                                <input type="text" placeholder="Enter Email" name="email" required>
                                <br>
                                <label for="psw"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="password" required>
                                <br><br>
                                <button type="submit" onclick=checkCredentials(); class="btn btn-light">Login</button>
                                <label>
                                    <input type="checkbox" checked="checked" name="remember"> Remember me
                                </label>
                            </div>
                            <div class="container">
                                <span class="psw">Forgot <a href="#">password?</a></span>
                            </div>
                        </div>
                    </form>
                </div>
                
                
                <br><br>

                <button onclick="document.getElementById('id02').style.display='block'" class="btn btn-light">Sign Up</button>
                <div id="id02" class="modal">
                    <span onclick="document.getElementById('id02').style.display='none'" class="close"
                        title="Close Modal">&times;</span>

                    <!-- Modal Content -->
                    <form class="modal-content animate" method="POST" action="Landing.php">

                        <div class="sign-in-background">
                            <div class="container">
                                <br>
                                <label for="name"><b>Name</b></label>
                                <br>
                                <input type="text" placeholder="Enter Name" name="name" required>
                                <br>
                                <label for="email"><b>Email Address</b></label>
                                <input type="text" placeholder="Enter Email" name="email2" required>
                                <br>
                                <label for="password"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="password2" required>
                                <br><br>
                                <button type="submit" onclick=checkCredentials(); class="btn btn-light">Sign Up</button>
                                
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    
    <script src="MoneyJar.js"></script>
    
    
</body>

</html>