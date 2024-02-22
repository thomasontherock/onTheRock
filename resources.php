<?php
$sql = "SELECT game FROM game WHERE id='2'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "game: " . $row["game"]. "<br>";
    $game = $row["game"];
  }
} else {
  echo "0 results";
}
$moveAmount = 0;
for ($i = 1; $i < 100; $i++) {
    if(str_contains($game, $i)) {
    }
    else{
        $moveAmount = ($i - 1);
        echo $moveAmount;
        return;
    }
}
echo "<script>";
?>
function nextMove() {
    currentMove += .5;    
    document.getElementById("moveNr").innerHTML=currentMove;
    applyMove(true);
  }
  function applyMove(forward){
    if(forward === true){
        document.getElementById("e2").innerHTML=" ";
        document.getElementById("e4").innerHTML="&#9817";
    }
    else{
    }
  }
<?php
echo "</script>";
?>