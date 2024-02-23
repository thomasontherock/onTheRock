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
  array_push($move,$moves);
  }
  else{
  $moves = explode("-", $parts[($i-1)]);
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
echo "<script>";
?>
var currentMove = 1.0;
function nextMove() {
    currentMove += .5;    
    document.getElementById("moveNr").innerHTML=currentMove;
    applyMove(currentMove);
  }
  function applyMove(newMove){
    <?php
      for($i = 0; $i < count($actions) ; $i++){
        echo "if (newMove == ". $actions[$i][0] . "){";
          echo 'document.getElementById("' . $actions[$i][1][0] . '").innerHTML= " ";';
          echo 'document.getElementById("' . $actions[$i][1][1] . '").innerHTML= "&#9817";';
        echo "}";
      }   
      ?>
  }
<?php
echo "</script>";
?>