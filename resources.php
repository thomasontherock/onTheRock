<?php
require "getPiece.php";
require "getVisualPiece.php";
require "getStartPosition.php";
require "showPosition.php";

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
$currentPos = getStartPosition();
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
    array_push($moves, $currentPos);
    unset($currentPos[substr($moves[0], -2)]);
    $currentPos[substr($moves[1], -2)] = getPiece($moves[0][0] , true);
    array_push($moves, $currentPos);
    array_push($move,$moves);
  }
  else{
    $moves = explode("-", $parts[($i-1)]);
    array_push($moves, getPiece($moves[0][0] , false));
    $rawMoves = explode("-", $rawparts[($i-1)]);
    array_push($moves, $rawMoves[1]);
    
    array_push($moves, $currentPos);
    unset($currentPos[substr($moves[0], -2)]);
    $currentPos[substr($moves[1], -2)] = getPiece($moves[0][0] , false);
    array_push($moves, $currentPos);
    array_push($move,$moves);
    array_push($actions,$move);  
  }
}
echo "<table>";
  echo "<tr>";
    echo "<th>Move</th>";
    echo "<th>White</th>";
    echo "<th>Black</th>";
  echo "</tr>";
  for($i = 1; $i <= count($actions) ; $i++){
    echo "<tr>";
      echo "<td>" . $i . "</td>";
      echo '<td><button onclick="goToMove'. $i . 'w()">' . $actions[($i-1)][1][3] . '</td>';
      echo '<td><button onclick="goToMove'. $i . 'z()">'. $actions[($i-1)][2][3] . '</td>';
    echo "</tr>";
  }
echo "</table>";
echo "<pre>";
  print_r($actions);
echo "</pre>";
//print_r($parts);

echo "<script>";

?>
var currentMove = 0.5;
console.log(currentMove);
function nextMove() {
    currentMove = currentMove + 0.5;    
    document.getElementById("moveNr").innerHTML=currentMove;
    applyMove(currentMove);   
  }
  function previousMove() {
    currentMove = currentMove - 0.5;    
    document.getElementById("moveNr").innerHTML=currentMove;
    if(currentMove % 1 == 0){

    };   
  }
  
  function applyMove(newMove){
    <?php
      // for($i = 0; $i < count($actions) ; $i++){
      //   echo "if (newMove == ". $actions[$i][0] . "){";
      //     echo 'document.getElementById("' . substr($actions[$i][1][0] , -2) . '").innerHTML= " ";';
      //     echo 'document.getElementById("' . substr($actions[$i][1][1] , -2) . '").innerHTML= "'. getVisualPiece($actions[$i][1][2]) . '"';
      //   echo "}";
      //   echo "if (newMove == ". ($actions[$i][0] + 0.5) . "){";
      //     echo 'document.getElementById("' . substr($actions[$i][2][0] , -2) . '").innerHTML= " ";';
      //     echo 'document.getElementById("' . substr($actions[$i][2][1] , -2) . '").innerHTML= "'. getVisualPiece($actions[$i][2][2]) . '"';
      //   echo "}";
      // }     
      ?>
  } 
<?php
showPosition("startPos()", getStartPosition(), 0.5);
// for($i = 0; $i < count($actions) ; $i++){
//   $a = "goToMove" . ($i +1) ."w()";
//   $b = "goToMove" . ($i +1) ."z()";
//   showPosition($a, $actions[$i][1][5], ($i +1));
//   showPosition($b, $actions[$i][2][5], ($i +1.5));
//}
echo "function goToMove(moveNr){";
  $allSquares= array(
    "a1","b1","c1","d1","e1","f1","g1","h1",
    "a2","b2","c2","d2","e2","f2","g2","h2",
    "a3","b3","c3","d3","e3","f3","g3","h3",
    "a4","b4","c4","d4","e4","f4","g4","h4",
    "a5","b5","c5","d5","e5","f5","g5","h5",
    "a6","b6","c6","d6","e6","f6","g6","h6",
    "a7","b7","c7","d7","e7","f7","g7","h7",
    "a8","b8","c8","d8","e8","f8","g8","h8",   
    );
      for($i = 0; $i < count($actions) ; $i++){
         echo "if(moveNr == ". ($i +1) . "){";          
         foreach($allSquares as $square){
            if(isset($actions[$i][1][5][$square]) && !empty($actions[$i][1][5][$square])){
               echo 'document.getElementById("' . $square . '").innerHTML="'. getVisualPiece($actions[$i][1][5][$square]) . '";'; 
               echo 'linebreak = document.createElement("br");';
               echo 'document.appendChild(linebreak);';
             }
            else{
               echo 'document.getElementById("' . $square . '").innerHTML= " ";';
               echo 'linebreak = document.createElement("br");';
               echo 'document.appendChild(linebreak);';     
            }
          }
          echo "}";
          echo "if(moveNr == ". ($i +1.5) . "){";
            foreach($allSquares as $square){
              if(isset($actions[$i][2][5][$square]) && !empty($actions[$i][1][5][$square])){
                 echo 'document.getElementById("' . $square . '").innerHTML="'. getVisualPiece($actions[$i][1][5][$square]) . '";'; 
                 echo 'linebreak = document.createElement("br");';
                 echo 'document.appendChild(linebreak);';
               }
              else{
                 echo 'document.getElementById("' . $square . '").innerHTML= " ";';
                 echo 'linebreak = document.createElement("br");';
                 echo 'document.appendChild(linebreak);';     
              }
            } 
            echo "}";
    } 
echo "}";
echo "</script>";
?>