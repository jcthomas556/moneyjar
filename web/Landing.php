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
     
        $email = $_POST["email"];
        if($email == "admin@admin.com"){
            echo $email;
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
                                <input type="password" placeholder="Enter Password" name="psw" required>
                                <br>
                                <button type="submit" onclick=checkCredentials()>Login</button>
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
                    <form class="modal-content animate" action="/action_page.php">

                        <div class="sign-in-background">
                            <div class="container">
                                <br>
                                <label for="uname2"><b>Username</b></label>
                                <input type="text" placeholder="Enter Email" name="uname2" required>
                                <br>
                                <label for="psw2"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="psw2" required>
                                <br>
                                <button type="submit" onclick=checkCredentials();createNewAccount()>Sign Up</button>
                                
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