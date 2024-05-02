<?php
function getQueenMove($currentPos, $move, $isWhiteMove, $currentmove){
    $newPos = $currentPos;
    if($isWhiteMove){
        $piece = "wq";
    }
    else{
        $piece = "zq";
    } 
    $newPos[substr($move, -2)] = $piece; 
    unset($newPos[findQueen(substr($move, -2), $currentPos, $piece)]);
    return $newPos;
}
function findQueen($square, $currentPos, $piece){
    $squaresToCheck = [];
    $array = [];
    for($i = (letterToNumber($square[0]) +1); $i < 8; $i++){
        array_push($array, numberToLetter($i) . $square[1]);
    }
    // if(!empty($array)){
        array_push($squaresToCheck,  $array);
    // }
    $array = [];    
    for(($i = letterToNumber($square[0]) -1); $i >= 0; $i--){
        array_push($array, numberToLetter($i) . $square[1]);
    }
    // if(!empty($array)){
        array_push($squaresToCheck,  $array);
    // }  
    $array = [];   
    for($i = $square[1] +1; $i <= 8; $i++){
        array_push($array, $square[0] . $i);
    }
    // if(!empty($array)){
        array_push($squaresToCheck,  $array);
    // }  
    $array = [];   
    for($i = $square[1] -1; $i > 0; $i--){
        array_push($array, $square[0] . $i);
    }
    // if(!empty($array)){
        array_push($squaresToCheck,  $array);
    // }
    $currentFile = $square[1];
    $array = [];
    for($i = letterToNumber($square[0]); $i < 8; $i++){
        if($currentFile > 8){
            break;
        }
        else{ 
            if(numberToLetter($i) . $currentFile != $square){       
                array_push($array, numberToLetter($i) . $currentFile);
            }
            $currentFile++;
        }
    }
    array_push($squaresToCheck,$array);
    $array = [];
    $currentFile = $square[1];
    for($i = letterToNumber($square[0]); $i >= 0; $i--){
        if($currentFile > 8){
            break;
        }
        else{
            if(numberToLetter($i) . $currentFile != $square){       
                array_push($array, numberToLetter($i) . $currentFile);
            }
            $currentFile++;
        }
    }
    array_push($squaresToCheck,$array);
    $array = [];
    $currentFile = $square[1];
    for($i = letterToNumber($square[0]); $i >= 0; $i--){
        if($currentFile < 1){
            break;
        }
        else{         
            if(numberToLetter($i) . $currentFile != $square){       
                array_push($array, numberToLetter($i) . $currentFile);
            }
            $currentFile--;
        }
    }
    array_push($squaresToCheck,$array);
    $currentFile = $square[1];
    $array = [];
    for($i = letterToNumber($square[0]); $i < 8; $i++){
        if($currentFile < 1){
            break;
        }
        else{
            if(numberToLetter($i) . $currentFile != $square){       
                array_push($array, numberToLetter($i) . $currentFile);
            }
            $currentFile--;
        }
    }
    array_push($squaresToCheck,$array);
    // echo '<pre>';
    // print_r($squaresToCheck);
    // echo '</pre>';
    // echo 'check ' .$piece . ' for square '. $square . ';';
    $newSquare = findOriginPiece($squaresToCheck, $currentPos, $piece);;
    return $newSquare;
}