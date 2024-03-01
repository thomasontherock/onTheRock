<?php
require 'getNewPosition.php';
function pgnBuilder($game){
    if(str_contains($game, "1... ")){
        return chessComPgn($game);
    }
    else{
    return easyPgn($game);
    }
}
function chessComPgn($game){
    $returnarray = [];
    $moveAmount = getTotalMoves($game);
    echo $moveAmount;
    $parts = explode(" ", $game);
    $currentmove = 0;
    $currentPos = getStartPosition();
    echo '<pre>';
    echo print_r($parts);
    echo '</pre>';
    $moves = [];
    for($i = 0; $i < count($parts); $i++)
    {
        if($i % 8 == 0 || $i == 0){  
            $move = [];     
            $currentmove = str_replace(".", "", $parts[$i]);
            array_push($move,$parts[$i]);
        }
        if($i % 8 == 1){
            array_push($move,$parts[$i]);
            array_push($move, getPiece($parts[$i][0], true));
            $currentPos = getNewPosition($currentPos, $parts[$i], true, $currentmove);
            array_push($move, $currentPos);
            array_push($moves, $move);
            
        }
        if($i % 8 == 5){
            $move = [];
            array_push($move,$parts[($i-1)]);
            array_push($move,$parts[$i]);
            array_push($move, getPiece($parts[$i][0], false));
            $currentPos = getNewPosition($currentPos, $parts[$i], false, $currentmove);
            array_push($move, $currentPos);
            array_push($moves, $move);
        }
        
    }
    
    echo '<pre>';
    print_r($moves);
    echo '</pre>';
    return $returnarray;    
}
function easyPgn($game){
    $moveAmount = getTotalMoves($game);
    echo $moveAmount;
    $toRemove = array("#","+");
    $cleanGames = str_replace($toRemove, "", $game);
    $parts = explode(" ", $cleanGames);
    $rawparts = str_replace('ck-ck', '0-0', $game);
    $rawparts = str_replace('cq-cq', '0-0-0', $game);
    $rawparts = explode(" ", $rawparts);

    $currentmove = 0;
    $actions = [];
    $currentPos = getStartPosition();
    for($i = 1; $i <= ($moveAmount * 3) ; $i++){
    if($i % 3 == 1){
        $currentmove = str_replace(".","",$parts[($i-1)]); 
        $move = $currentmove;
        
        //array_push($actions, $currentmove);
    }
    elseif($i % 3 == 2){
        $moves = explode("-", $parts[($i-1)]);
        array_push($moves, getPiece($moves[0][0] , true));
        if(str_contains($rawparts[($i-1)], "0")){
        array_push($moves, $rawparts[($i-1)]);
        }
        else{
        $rawMoves = explode("-", $rawparts[($i-1)]);
        array_push($moves, $rawMoves[1]);
        }
        array_push($moves, $currentPos);
        if($moves[0] == "cq"){
        unset($currentPos["e1"]);
        unset($currentPos["a1"]);
        $currentPos["c1"] = "wk";
        $currentPos["d1"] = "wr";
        }
        if($moves[0] == "ck"){
        unset($currentPos["e1"]);
        unset($currentPos["h1"]);
        $currentPos["g1"] = "wk";
        $currentPos["f1"] = "wr";
        }
        else{
        unset($currentPos[substr($moves[0], -2)]);
        $currentPos[substr($moves[1], -2)] = getPiece($moves[0][0] , true);
        }
        array_push($moves, $currentPos);
        array_push($move,$moves);
    }
    else{
        if(isset($parts[($i-1)])){
            $moves = explode("-", $parts[($i-1)]);
            array_push($moves, getPiece($moves[0][0] , false));
            $rawMoves = explode("-", $rawparts[($i-1)]);
            array_push($moves, $rawMoves[1]);
            array_push($moves, $currentPos);
            if($moves[0] == "cq"){
                unset($currentPos["e8"]);
                unset($currentPos["a8"]);
                $currentPos["c8"] = "wk";
                $currentPos["d8"] = "wr";
            }
            if($moves[0] == "ck"){
                unset($currentPos["e8"]);
                unset($currentPos["h8"]);
                $currentPos["g8"] = "wk";
                $currentPos["f8"] = "wr";
            }
            else{
                unset($currentPos[substr($moves[0], -2)]);
                $currentPos[substr($moves[1], -2)] = getPiece($moves[0][0] , false);
            }
            array_push($moves, $currentPos);
            array_push($move,$moves);
            array_push($actions,$move);
            }  
        }
    }
    return $actions;
}
function getTotalMoves($game){
    for ($i = 1; $i < 100; $i++) {
        if(str_contains($game, ($i . '.'))) {
        }
        else{
         return ($i - 1);         
        }
    }
  }