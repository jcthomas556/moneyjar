<?php 
include('database_connection.php');
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    // redirect to your login page
    exit();
}

$username = $_SESSION['username'];
$userID = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" type="text/css" href="MoneyJar.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Account Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</head>

<body class="background">

    <div >
        <button onclick='signOut()' class='btn btn-success pull-right' aria-label='right Align'> <span class='glyphicon glyphicon-log-out btn-success btn-lg btn-block' aria-hidden='true'></span> </button>
        <button onclick="location.href='https://intense-fjord-38137.herokuapp.com/web/AccountSettings.php';" type="button" class="btn btn-success pull-right" aria-label="right Align">
            <span class="glyphicon glyphicon-cog btn-success btn-lg btn-block" aria-hidden="true"></span>
        </button>
        <br><br><br>
        
    </div>

    <!-- DB query for user details -->
    <?php
         if($_SERVER['REQUEST_METHOD'] == 'POST'){

            echo '<h3 class="text-center"> Welcome to your account page, ';
            echo $username;
            echo "!</h3>";

            foreach($db->query(
                        "SELECT user_id, user_name FROM accounts WHERE email=crypt('$email', email) AND passwords=crypt('$passwords', passwords)", PDO::FETCH_ASSOC) as $holder)
                        {
                            if($holder['user_id'] > 0){
                                echo 'Account created! Successfully logged in, welcome, ' . $holder['user_name'];
                                header('Location: web/Jars.php');
                            }
                        }
        }

        
    ?>
    
    
    <div class="text-center">
      

    </div>


    <div class="container text-center" id="cupboard">
        <h1>Go to Jars!</h1>
        <br>
        <button onclick='goToJars()' class='btn btn-success' aria-label='right Align'> 
            <span class='glyphicon glyphicon-oil btn-success btn-lg' aria-hidden='true'></span> 
        </button>
    </div>

    <div class="container text-center" id="cupboard">
        <h1>Create or join a Jar!</h1>
        <br>
       <button onclick="document.getElementById('newJar').style.display='block'" type="button" class="btn btn-success " aria-label="right Align">
            <span class="glyphicon glyphicon-plus btn-success btn-lg " aria-hidden="true"></span>
        </button> 
                <!-- The Modal -->
                <div id="newJar" class="modal">
                    <span onclick="document.getElementById('newJar').style.display='none'" class="close"
                        title="Close Modal">&times;</span>

                  
                        <div class="sign-in-background">
                            <div class="container">
                            <br><br>


                            <button onclick="document.getElementById('joinJar').style.display='block'">Join A Jar</button>
                        
                            <!-- The Modal -->
                            <div id="joinJar" class="modal">
                                <span onclick="document.getElementById('joinJar').style.display='none'" class="close"
                                    title="Close Modal">&times;</span>

                                <!-- Modal Content -->
                                <form class="modal-content animate" action="Jars.php" method="GET" action="AccountPage.php">
                                    <div class="sign-in-background">
                                        <div class="container">
                                            <br>
                                            <label for="jarCode"><b>Jar Code</b></label>
                                            <input type="text" placeholder="Enter Code" name="jarCode" required>
                                            <br><br>                                            
                                            <button type="submit">Join Jar</button>
                                            
                                        </div>
                                </form>
                                    </div>
                                </div>
                             <!-- The Modal END-->


                            <button onclick="document.getElementById('createJar').style.display='block'">Create New Jar</button>    
                            <br><br><br>
                                <!-- The Modal -->
                                <div id="createJar" class="modal">
                                <span onclick="document.getElementById('createJar').style.display='none'" class="close"
                                    title="Close Modal">&times;</span>

                                <!-- Modal Content -->
                                <form class="modal-content animate" action="Jars.php" method="GET" action="AccountPage.php">
                                    <div class="sign-in-background">
                                        <div class="container">
                                            <br>
                                            <label for="jarName"><b>Jar Name</b></label>
                                            <input type="text" placeholder="Enter Name" name="jarName" required>
                                            <br><br>
                                            
                                            <button type="submit">Create Jar</button>
                                            
                                        </div>
                                </form>
                                    </div>
                                </div>
                        <!-- The Modal END-->

                            </div>
                    
                </div>

    </div>    

    <br><br>

    <script src="MoneyJar.js"></script>


</body>

</html>