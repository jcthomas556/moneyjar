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
                            "SELECT UJ.user_id, J.jar_id, J.jar_total, J.jar_name, J.jar_active FROM users_jars AS UJ LEFT JOIN jars AS J ON (UJ.jar_id = J.jar_id) WHERE user_id = '$userID'", PDO::FETCH_ASSOC) as $holder)
                            {
                                if($holder['jar_active'] == 't'){
                                    
                                }
                        ?>
                        <option value="<?php echo $holder['jar_total']; ?>"><?php echo $holder['jar_name']; ?></option>
                            
                        <?php } ?> </select>
                        <!-- This allows the php to end after the subject is inserted, so this subject of the jar names is inside the php loop -->
                </form>
            </td>
        </tr>
<br><br>

        <?php
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $newJarName = $_GET["jarName"];
            
            insertNewJar($newJarName, $userID);
                
            $jarTotal = $_GET["jarSelector"];
            echo "<p>";
            echo $jarTotal;
            echo "</p>";
            }

            function insertNewJar($newJarName, $userID){
                echo "made it into the function";
                echo $newJarName;
                echo $userID;
                $db->query(
                    "INSERT into jars (jar_owner_id, jar_total, jar_active, jar_name)
                    VALUES (
                            '$userID,
                            0,
                            true,
                            '$newJarName'
                    )");
                
                    // INSERT INTO users_jars(user_id, jar_id)
                    // VALUES(
                    //     '$userID,
                    //     (SELECT jar_id FROM jars WHERE jar_owner_id = '$userID' AND jar_name = '$newJarName)
                    // )");
                    echo "finished the query";
               //insert statement for jar
               //might need to pass the session variables into this function for proper user
            }   
        ?>

            
 
    </div>


    
    
    <div class="container">
        <div class="text-center">   

          

            <img src="https://images.collectivesupply.com/wp-content/uploads/2017/11/12140507/10-oz-glass-jar.png" alt="Trulli" width="500" height="433">
              
            
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
            

   
 


    <script src="MoneyJar.js"></script>
    
    
</body>

</html>