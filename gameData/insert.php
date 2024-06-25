<?php
include('../databaseconnection.php');
$games = $_REQUEST['games'];
$seperated = explode('"url":', $games);
echo count($seperated);
echo '<br>';
echo $seperated[2];
foreach($seperated as $str){
    $sql = "INSERT INTO inserted_games (game) VALUES ('$str')";
    if($conn->query($sql) === TRUE){
        echo "success. <br>";
    } else{
        echo "ERROR: Hush! Sorry $sql. " 
            . mysqli_error($conn);
    }
}
