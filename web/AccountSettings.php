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
    <title>Account Settings Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</head>

<body class="background">

    <div >
        <form action = "AccountPage.php", method = 'post'>
            <button onclick="checkUserAccount()" type="submit" name="accountPageButton" class="btn btn-success pull-right" aria-label="right Align">
                <span class="glyphicon glyphicon-user btn-success btn-lg" aria-hidden="true"></span>
            </button>
        </form>
            <button onclick='goToJars()' class='btn btn-success' aria-label='right Align'> 
                <span class='glyphicon glyphicon-oil btn-success btn-lg' aria-hidden='true'></span> 
            </button>
            <button onclick='signOut()' class='btn btn-success pull-right' aria-label='right Align'> <span class='glyphicon glyphicon-log-out btn-success btn-lg btn-block' aria-hidden='true'></span> </button>

    </div>

    <div class="container text-center" id="cupboard">
        <?php
            echo "<h3> Hello " . $username . "! </h3> <br> <h3> We want you to feel safe, so we added this section here where you can delete your account completely, with 1 click. </h3>";
        ?>

        <br><br><br>
            <form method="POST">
                <input type="hidden" name="userID" value="<?php echo $userID ?>">
                <input type="hidden" name="deleteAccountRequest" value="true">
                <button type="submit" class="btn btn-warning">Delete My Account</button>
            </form>

    </div>

    <?php
         if(isset($_POST['userID'], $_POST['deleteAccountRequest'])){

            //$temp = $_POST['jarID'];
          echo "Yep";
            // $db->query(
            // "UPDATE jars
            // SET jar_Total = jar_Total + 1.00
            // WHERE jar_id = $temp"
            // );

            // header("Refresh:0");
        }

    ?>

    <script src="MoneyJar.js"></script>


</body>

</html>