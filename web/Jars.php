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
    <title>Jar Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@600&display=swap" rel="stylesheet">

</head>

<body class="background">

    <button onclick="sessionStorage.clear(); location.href='https://intense-fjord-38137.herokuapp.com/web/Landing.php';" class='btn btn-success pull-right' aria-label='right Align'> <span class='glyphicon glyphicon-log-out btn-success btn-lg btn-block' aria-hidden='true'></span> </button>
    <!-- My account page button -->
    <form action = "AccountPage.php", method = 'post'>
        <button onclick="checkUserAccount()" type="submit" name="accountPageButton" class="btn btn-success pull-right" aria-label="right Align">
            <span class="glyphicon glyphicon-user btn-success btn-lg" aria-hidden="true"></span>
        </button>
    </form>
    <br><br>


    <div class="text-center">
        <h1>Your Jars</h1>

        <tr>
            <td></td>

            <td>
                <form action="Jars.php" method="GET">
                    <select onchange="this.form.submit()" id="jarSelector" name="jarSelector">
                        <option selected="selected">Select Jar</option>
                        <?php 
                        foreach($db->query(
                            "SELECT UJ.user_id, J.jar_id, J.jar_total, J.jar_name, jar_invite_code, J.jar_active FROM users_jars AS UJ LEFT JOIN jars AS J ON (UJ.jar_id = J.jar_id) WHERE user_id = '$userID'", PDO::FETCH_ASSOC) as $holder)
                            {
                                if($holder['jar_active'] == 't'){

                        ?>
                                <option value="
                        <?php 
                                echo $holder['jar_id']; 
                        ?>
                               ">
                        <?php
                                echo $holder['jar_name'];
                        ?>
                                </option>                            
                        <?php 
                                } }
                        ?> 
                                </select>
                        <!-- This allows the php to end after the subject is inserted, so this subject of the jar names is inside the php loop -->
                </form>
            </td>
        </tr>
    <br><br>

        <?php
      
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                
            
                $jarID = $_GET["jarSelector"];              
                foreach($db->query(
                    "SELECT jar_invite_code, jar_total, jar_name FROM jars WHERE jar_id = '$jarID'", PDO::FETCH_ASSOC) as $holder)
                    {
                        $inviteCode = $holder[jar_invite_code];
                        $jarTotal = $holder[jar_total];
                        $jarName = $holder[jar_name];
                            
                    }
   
                printTotal();
                
                if(array_key_exists('addMoney', $_GET)) { 
                   echo $jarID;
                }    
                
            }
            if(isset($_POST['jarID'], $_POST['emptyRequest'])){
                $temp = $_POST['jarID'];
              
                $db->query(
                "UPDATE jars
                SET jar_Total = 0
                WHERE jar_id = $temp"
                );

                header("Refresh:0");
            }
            if(isset($_POST['jarID'], $_POST['deleteRequest'])){
                $temp = $_POST['jarID'];
              
                $db->query(
                "UPDATE jars
                SET jar_active = false
                WHERE jar_id = $temp"
                );

                header("Refresh:0");
            }
            if(isset($_POST['jarID'], $_POST['incrementRequest'])){

                $temp = $_POST['jarID'];
              
                $db->query(
                "UPDATE jars
                SET jar_Total = jar_Total + 1.00
                WHERE jar_id = $temp"
                );

                header("Refresh:0");
            }
            if(isset($_POST['CreateJarRequest'], $_POST['newJarName'])){
                $newJarName = $_POST["jarName"];
                insertNewJar($newJarName, $userID, $db);
            }
            if(isset($_POST['joinJarRequest'], $_POST['jarCode'])){
                $newJarCode = $_POST["jarCode"];
                joinNewJar($userID, $db, $newJarCode);
            }
            
        ?>

        <?php
            function printTotal(){
                echo "<h3>";
                echo $GLOBALS['jarName']; 
                echo " has <br>$";
                echo $GLOBALS['jarTotal'];
                echo " in it right now </h3>";
                
            }
        ?>

        <?php   

            function insertNewJar($newJarName, $userID, $db){
                echo "USer ID = " . $userID;


                $length = 7;
                $nums = '0123456789';
                for ($p = 0; $p < $length-1; $p++){
                        $randomNumber .= $nums[mt_rand( 0, strlen($nums)-1 )];
                }
        
                $db->query(
                    "INSERT into jars (jar_owner_id, jar_total, jar_active, jar_name, jar_invite_code)
                    VALUES (
                            '$userID',
                            0,
                            true,
                            '$newJarName',
                            '$randomNumber')"
                        );


                foreach($db->query(
                    "SELECT jar_id FROM jars WHERE jar_owner_id = $userID AND jar_name = '$newJarName'", PDO::FETCH_ASSOC) as $holder)
                    {
                        $jarID = $holder['jar_id']; 
                            
                    }   
                $db->query(
                    "INSERT INTO users_jars (user_id, jar_id)
                    VALUES(
                        '$userID',
                        '$jarID'
                    )"
                );  

                header("Refresh:0");

            }
                
        
            
        ?>
        <?php
            function genRandomNumber($length = 7) {
                $nums = '0123456789';
                for ($p = 0; $p < $length-1; $p++)
                    $out .= $nums[mt_rand( 0, strlen($nums)-1 )];
                return $out;
            }
        ?>
        <?php
            function joinNewJar($userID, $db, $newJarCode){
                // echo $newJarCode;
                foreach($db->query(
                    "SELECT jar_id FROM jars WHERE jar_invite_code = $newJarCode", PDO::FETCH_ASSOC) as $holder)
                    {
                        $jarID = $holder['jar_id']; 
                    }   
            
                $db->query(
                    "INSERT INTO users_jars (user_id, jar_id)
                    VALUES(
                        '$userID',
                        '$jarID'
                    )"
                ); 
                
                header("Refresh:0");
            }
        ?>
      
    </div>

    <div class="container">
        <div class="text-center">   

            <img class="img-responsive" src="https://images.collectivesupply.com/wp-content/uploads/2017/11/12140507/10-oz-glass-jar.png" alt="Trulli" width="500" height="433">

            <br>
            <form method="POST">
                <input type="hidden" name="jarID" value="<?php echo $jarID ?>">
                <input type="hidden" name="incrementRequest" value="true">
                <button type="submit" class="btn btn-success"> Add a Dollar!</button>
            </form>

            <br>
            <button onclick="document.getElementById('sharedJar').style.display='block'" class="btn btn-success">Share your Jar with others</button>
            <!-- The Modal -->
                <div id="sharedJar" class="modal">
                    <span onclick="document.getElementById('sharedJar').style.display='none'" class="close"
                        title="Close Modal">&times;</span>

                    <!-- Modal Content -->
                    
                        <div class="sign-in-background">
                            <div class="container">
                                <br>
                                <label for="jarCode"><b><?php echo $inviteCode?></b></label>
                                <h4> Copy that number, and send it to your friend! </h4>
                            </div>
                    
                        </div>
                </div>
            <!-- The Modal END--> 

            <br><br><br>
            <form method="POST">
                <input type="hidden" name="jarID" value="<?php echo $jarID ?>">
                <input type="hidden" name="emptyRequest" value="true">
                <button type="submit" class="btn btn-warning">Empty Jar</button>
            </form>

            <br>
            <form method="POST">
                <input type="hidden" name="jarID" value="<?php echo $jarID ?>">
                <input type="hidden" name="deleteRequest" value="true">
                <button type="submit" class="btn btn-danger">Delete Jar</button>
            </form>
            
            

        </div>
    </div>
            
    <script src="MoneyJar.js"></script>
    
</body>

</html>