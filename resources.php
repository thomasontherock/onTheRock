<?php
require "getPiece.php";
require "getVisualPiece.php";
require "getStartPosition.php";
require "showPosition.php";
require "pgnBuilder.php";


$sql = "SELECT game FROM game WHERE id='4'";
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
$actions = pgnBuilder($game);
echo "<table>";
  echo "<tr>";
    echo "<th>Move</th>";
    echo "<th>White</th>";
    echo "<th>Black</th>";
  echo "</tr>";
  for($i = 1; $i <= count($actions) ; $i++){
    echo "<tr>";
      echo "<td>" . $i . "</td>";
      echo '<td><button onclick="goToMove('. $i . ')">' . $actions[($i-1)][1][3] . '</td>';
      if(isset($actions[($i-1)][2][3])){
      echo '<td>';
        if($actions[($i-1)][2][3] != "0" && $actions[($i-1)][2][3] != "1"){
          echo '<button onclick="goToMove('. ($i + 0.5) . ')">'. $actions[($i-1)][2][3] . '</td>';
        }
      echo '</td>';
      }
      else{
      echo "<td></td>";
    }
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
function nextMove() {
    <?php
    $moveAmount = count($actions);
    if(isset($actions[($moveAmount - 1)][2][2]) && !$actions[($moveAmount - 1)][2][2] == "Unknown piece"){ 
      echo "if (currentMove <". ($moveAmount + 0.4). "){";
    } 
    else {
      echo "if (currentMove <". ($moveAmount). "){";
    }
    ?>
    currentMove = currentMove + 0.5;    
    document.getElementById("moveNr").innerHTML=currentMove;
    goToMove(currentMove);
  <?php echo "}"; ?>   
}
  function previousMove() {
    if(currentMove > 0.5){
      currentMove = currentMove - 0.5;    
      document.getElementById("moveNr").innerHTML=currentMove;
      goToMove(currentMove);
    }   
  }
<?php
echo "function goToMove(moveNr){";
  echo 'currentMove = moveNr;';
  echo 'document.getElementById("moveNr").innerHTML=currentMove;';
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
    echo "if(moveNr == 0.5){";
      $startPos = getStartPosition();
      foreach ($allSquares as $square) {
        if(isset($startPos[$square]) && !empty($startPos[$square])){
          echo 'document.getElementById("' . $square . '").innerHTML="'. getVisualPiece($startPos[$square]) . '";'; 
          echo 'linebreak = document.createElement("br");';
          echo 'document.body.appendChild(linebreak);';
        }
        else{
          echo 'document.getElementById("' . $square . '").innerHTML= " ";';
          echo 'linebreak = document.createElement("br");';
          echo 'document.body.appendChild(linebreak);';     
       }
      }
    echo "};";
      for($i = 0; $i < count($actions) ; $i++){
         echo "if(moveNr == ". ($i +1) . "){";          
         foreach($allSquares as $square){
            if(isset($actions[$i][1][5][$square]) && !empty($actions[$i][1][5][$square])){
               echo 'document.getElementById("' . $square . '").innerHTML="'. getVisualPiece($actions[$i][1][5][$square]) . '";'; 
               echo 'linebreak = document.createElement("br");';
               echo 'document.body.appendChild(linebreak);';
             }
            else{
               echo 'document.getElementById("' . $square . '").innerHTML= " ";';
               echo 'linebreak = document.createElement("br");';
               echo 'document.body.appendChild(linebreak);';     
            }
          }
          echo "}";
          echo "if(moveNr == ". ($i +1.5) . "){";
            foreach($allSquares as $square){
              if(isset($actions[$i][2][5][$square]) && !empty($actions[$i][2][5][$square])){
                 echo 'document.getElementById("' . $square . '").innerHTML="'. getVisualPiece($actions[$i][2][5][$square]) . '";'; 
                 echo 'linebreak = document.createElement("br");';
                 echo 'document.body.appendChild(linebreak);';
               }
              else{
                 echo 'document.getElementById("' . $square . '").innerHTML= " ";';
                 echo 'linebreak = document.createElement("br");';
                 echo 'document.body.appendChild(linebreak);';     
              }
            } 
            echo "}";
    } 
echo "}";
echo "</script>";
?>