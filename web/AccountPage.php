<?php 
include('database_connection.php');
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
        <button type="button" class="btn btn-success pull-right" aria-label="right Align">
            <span class="glyphicon glyphicon-cog btn-success btn-lg btn-block" aria-hidden="true"></span>
        </button>
        <button onclick="window.location='https://intense-fjord-38137.herokuapp.com/web/Landing.php'" type="button" class="btn btn-success pull-left" aria-label="right Align">
            <span class="glyphicon glyphicon-home btn-success btn-lg btn-block" aria-hidden="true"></span>
        </button>
        <br><br><br>
        
    </div>
    <div class="text-center">
        <h1>Account Page</h1>

    </div>

    <div class="container text-center" id="cupboard">
        <p >Looks like you don't have any jars yet. Click below to make one!</p>
        <br>
        <button type="button" class="btn btn-success " aria-label="right Align">
            <span class="glyphicon glyphicon-plus btn-success btn-lg " aria-hidden="true"></span>
        </button>
    </div>


    <br><br>








    <script src="MoneyJar.js"></script>


</body>

</html>