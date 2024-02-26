<?php
require "getPiece.php";
require "getVisualPiece.php";

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

$moveAmount = getTotalMoves($game);
function getTotalMoves($game){
  for ($i = 1; $i < 100; $i++) {
      if(str_contains($game, ($i . '.'))) {
      }
      else{
       return ($i - 1);         
      }
  }
}
echo $moveAmount;
$toRemove = array("#","+");
$cleanGames = str_replace($toRemove, "", $game);
$parts = explode(" ", $cleanGames);
$rawparts = explode(" ", $game);

$currentmove = 0;
$actions = [];
for($i = 1; $i <= ($moveAmount * 3) ; $i++){
  if($i % 3 == 1){
    $currentmove = str_replace(".","",$parts[($i-1)]);
    $move = [$currentmove];
    //array_push($actions, $currentmove);
  }
  elseif($i % 3 == 2){
    $moves = explode("-", $parts[($i-1)]);
    array_push($moves, getPiece($moves[0][0] , true));
    $rawMoves = explode("-", $rawparts[($i-1)]);
    array_push($moves, $rawMoves[1]);
    array_push($move,$moves);
  }
  else{
    $moves = explode("-", $parts[($i-1)]);
    array_push($moves, getPiece($moves[0][0] , false));
    $rawMoves = explode("-", $rawparts[($i-1)]);
    array_push($moves, $rawMoves[1]);
    array_push($move,$moves);
    array_push($actions,$move);  
  }
  
  

  if(!empty($parts[$i-1])) {
    //echo $parts[($i-1)] . "<br>";
  }
}

echo "<pre>";
  print_r($actions);
echo "</pre>";
//print_r($parts);
echo "<table>";
  echo "<tr>";
    echo "<th>Move</th>";
    echo "<th>White</th>";
    echo "<th>Black</th>";
  echo "</tr>";
  for($i = 1; $i <= count($actions) ; $i++){
    echo "<tr>";
      echo "<td>" . $i;
      echo "<td><button onclick='goToMove". $i . "'>" . $actions[($i-1)][1][3] . "</button>";
      echo "<td><button onclick='goToMove". ($i + 0.5) . "'>". $actions[($i-1)][2][3] . "</button>";
    echo "</tr>";
  }
echo "</table>";
echo "<script>";
?>
var currentMove = 0.5;
console.log(currentMove);
function nextMove() {
    currentMove = currentMove + 0.5;    
    document.getElementById("moveNr").innerHTML=currentMove;
    console.log(currentMove);
    applyMove(currentMove);
    
  }
  function applyMove(newMove){
    <?php
      for($i = 0; $i < count($actions) ; $i++){
        echo "if (newMove == ". $actions[$i][0] . "){";
          echo 'document.getElementById("' . substr($actions[$i][1][0] , -2) . '").innerHTML= " ";';
          echo 'document.getElementById("' . substr($actions[$i][1][1] , -2) . '").innerHTML= "'. getVisualPiece($actions[$i][1][2]) . '"';
        echo "}";
        echo "if (newMove == ". ($actions[$i][0] + 0.5) . "){";
          echo 'document.getElementById("' . substr($actions[$i][2][0] , -2) . '").innerHTML= " ";';
          echo 'document.getElementById("' . substr($actions[$i][2][1] , -2) . '").innerHTML= "'. getVisualPiece($actions[$i][2][2]) . '"';
        echo "}";
      } 
     
      ?>
  }
<?php
echo "</script>";
?>