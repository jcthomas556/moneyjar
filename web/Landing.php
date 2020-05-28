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

</head>

<body class="background">

    <?php 
    //Log In Code
    

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "test";
        

         $email = $_POST["email"];
         $passwords = $_POST["password"];

         $name = $_POST["name"];
         $email2 = $_POST["email2"];
         $passwords2 = $_POST["password2"];

         echo $email;
         echo $passwords;

         echo $email2;
         echo $passwords2;
         echo $name;

   
    }


    function login(){
        foreach($db->query(
            "SELECT user_id, user_name FROM accounts WHERE email=crypt('$email', email) AND passwords=crypt('$passwords', passwords)", PDO::FETCH_ASSOC) as $holder)
            {
                if($holder['user_id'] > 0){
                    echo 'Successfully logged in, welcome, ' . $holder['user_name'];
                }
            }
        }


    function signUp(){    
        $db->query(
            "INSERT INTO accounts (passwords, email, user_name, created_on)
            VALUES(
                crypt('$passwords2', gen_salt('bf')),
                crypt('$email2', gen_salt('bf')),
                '$name',
                CURRENT_DATE)"
                
            ); 

        }

        

    ?>
    <div class="text-center">
        <h1>Money Jar</h1>
        <p>Sign in or sign up below</p>
       
    </div>

    <div class="container">
        <div class="text-center">
            <h2>Sign in</h2>
                <button onclick="document.getElementById('id01').style.display='block'">Login</button>

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
                                <br>
                                <button type="submit" onclick=checkCredentials();>Login</button>
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

                <button onclick="document.getElementById('id02').style.display='block'">Sign Up</button>
                <div id="id02" class="modal">
                    <span onclick="document.getElementById('id02').style.display='none'" class="close"
                        title="Close Modal">&times;</span>

                    <!-- Modal Content -->
                    <form class="modal-content animate" method="POST" action="Landing.php">

                        <div class="sign-in-background">
                            <div class="container">
                                <br>
                                <label for="name"><b>Name</b></label>
                                <input type="text" placeholder="Enter Name" name="name" required>
                                <br>
                                <label for="email"><b>Email Address</b></label>
                                <input type="text" placeholder="Enter Email" name="email2" required>
                                <br>
                                <label for="password"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="password2" required>
                                <br>
                                <button type="submit" onclick=checkCredentials();>Sign Up</button>
                                
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
            

    <?php
     


// $statement = $db->query('SELECT * FROM accounts');
//         while ($row = $statement->fetch(PDO::FETCH_ASSOC))
//         {
//             echo $row['email'] . ' password: ' . $row['password'] . '<br/>';
//         }
    ?>

 


    <script src="MoneyJar.js"></script>
    
    
</body>

</html>