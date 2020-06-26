<?php
include('database_connection.php');
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    // redirect to your login page
    exit();
}

$username = $_SESSION['username'];
$userID = $_SESSION['user_id'];


//SELECT jar_total, jar_active, user_id FROM jars WHERE user_id = '1';
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
    <button onclick='signOut()' class='btn btn-success pull-right' aria-label='right Align'> <span class='glyphicon glyphicon-log-out btn-success btn-block' aria-hidden='true'></span> </button>
    <br><br>


    <div class="text-center">
        <h1>Your Jars</h1>

        <tr>
            <td>Jars</td>

            <td>
                <form action="Jars.php" method="GET">
                    <select onchange="this.form.submit()" id="jarSelector" name="jarSelector">
                        <option selected="selected">Select Jar</option>
                        <?php 
                        

                        foreach($db->query(
                            "SELECT UJ.user_id, J.jar_id, J.jar_total, J.jar_name, jar_invite_code, J.jar_active FROM users_jars AS UJ LEFT JOIN jars AS J ON (UJ.jar_id = J.jar_id) WHERE user_id = '$userID'", PDO::FETCH_ASSOC) as $holder)
                            {
                                if($holder['jar_active'] == 't'){
                                    
                            }
                            
                        ?>
                        <option value="<?php echo $holder['jar_id']; ?>"><?php echo $holder['jar_name']; $currJarID=$holder['jar_id']; $inviteCode=$holder['jar_invite_code']; echo $holder['jar_invite_code']; echo $inviteCode;?></option>
                        
                            
                        <?php } ?> </select>
                        <!-- This allows the php to end after the subject is inserted, so this subject of the jar names is inside the php loop -->
                </form>
            </td>
        </tr>
<br><br>

        <?php
            if($_SERVER['REQUEST_METHOD'] == 'GET'){

                $newJarName = $_GET["jarName"];
                $newJarCode = $_GET["jarCode"];

                $jarID = $_GET["jarSelector"];
                echo "<p>" . $jarId;
                echo "</p>";

                // foreach($db->query(
                //     "SELECT UJ.user_id, J.jar_id, J.jar_total, J.jar_name, jar_invite_code, J.jar_active FROM users_jars AS UJ LEFT JOIN jars AS J ON (UJ.jar_id = J.jar_id) WHERE user_id = '$userID'", PDO::FETCH_ASSOC) as $holder)
                //     {
                //         if($holder['jar_active'] == 't'){
                            
                //     }
             
                if($newJarName != ""){
                    insertNewJar($newJarName, $userID, $db);
                }
                if($newJarCode != ""){
                    joinNewJar($userID, $db, $newJarCode);
                }                    
                


                    
                
              
                }

                
                // if(isset($_GET['addMoney'])){
                //     $precision = 2;
                //     $jar_total = intval($jar_total * ($p = pow(10, $precision))) / $p;
                //     $value = number_format((float) $jar_total, $precision, '.', '');
                //     $newJar_total = $jar_total + 1;
                //     echo "$";
                //     echo $newJar_total;

                   

                //     $db->query(
                //         "UPDATE jars
                //         SET jar_Total = $newJar_total
                //         WHERE jar_invite_code = $newJarCode"//this is not working. also, it's not getting the current total, its just adding a lot to whichever one. I think the if(isset is different scope?)
                //     );
                // }

        ?>

        <?php   
                function insertNewJar($newJarName, $userID, $db){
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
                // echo "----> Jar ID = ";
                // echo $jarID;
                $db->query(
                    "INSERT INTO users_jars (user_id, jar_id)
                    VALUES(
                        '$userID',
                        '$jarID'
                    )"
                );  
            }
        ?>


            
 
    </div>


    
    
    <div class="container">
        <div class="text-center">   

          

            <img src="https://images.collectivesupply.com/wp-content/uploads/2017/11/12140507/10-oz-glass-jar.png" alt="Trulli" width="500" height="433">

            <br>
            <form action="Jars.php" method="GET">
                <button type="submit" name="addMoney" class="btn btn-success">Put $1 in the Jar</button>
            </form>
            <br>
            <button onclick="document.getElementById('sharedJar').style.display='block'">Share your Jar with others</button>
            <!-- The Modal -->
                <div id="sharedJar" class="modal">
                    <span onclick="document.getElementById('sharedJar').style.display='none'" class="close"
                        title="Close Modal">&times;</span>

                    <!-- Modal Content -->
                    
                        <div class="sign-in-background">
                            <div class="container">
                                <br>
                                <label for="jarCode"><b><?php echo $inviteCode?></b></label>
                                <p> Copy that number, and send it to your friend! </p>
                            </div>
                    
                        </div>
                </div>
            <!-- The Modal END--> 

        </div>
    </div>
            

   
 


    <script src="MoneyJar.js"></script>
    
    
</body>

</html>