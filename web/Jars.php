<?php
include('database_connection.php');

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
    <title>Jar Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</head>

<body class="background">


    <!-- My account page button -->
    <form action = "AccountPage.php", method = 'post'>
        <button onclick="checkUserAccount()" type="submit" name="accountPageButton" class="btn btn-success pull-right" aria-label="right Align">
            <span class="glyphicon glyphicon-user btn-success btn-block" aria-hidden="true"></span>
        </button>
    </form>
    <br><br>


    <div class="text-center">
        <h1>Your Jar</h1>
        
       
    </div>

    <div class="container">
        <div class="text-center">
            


                
                                
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
            

   
 


    <script src="MoneyJar.js"></script>
    
    
</body>

</html>