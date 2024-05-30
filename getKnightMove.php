<?php
function getKnightMove($currentPos, $move, $isWhiteMove, $currentmove){
    $newPos = $currentPos;
    $piece = "";
    $endSquare = substr($move, -2);
    if($isWhiteMove){
        $piece = "wn";
    }
    else{
        $piece = "zn";
    } 
    $newPos[substr($move, -2)] = $piece; 
    if ((strlen($move) == 4 && !str_contains($move, 'x')) || strlen($move) == 5){
        
        unset($newPos[findKnight($endSquare, $currentPos, $piece, $move[1])]);
    }
    else{
        unset($newPos[findKnight($endSquare, $currentPos, $piece)]);
    }
    return $newPos;
}
function findKnight($square, $currentPos, $piece, $origin = false){
    $squaresToLook = [];
    if($square[0] != "a" && $square[0] != "b"){
        $newrank = numberToLetter(letterToNumber($square[0]) -2);
        if($square[1] < 8){
            array_push($squaresToLook, $newrank . ($square[1] +1));
        }
        if($square[1] > 1){
            array_push($squaresToLook, $newrank . ($square[1] -1));
        }
    }
    if($square[0] != "a"){
        $newrank = numberToLetter(letterToNumber($square[0]) -1);
        if($square[1] < 7){
            array_push($squaresToLook, $newrank . ($square[1] +2));
        }
        if($square[1] > 2){
            array_push($squaresToLook, $newrank . ($square[1] -2));
        }
    }
    if($square[0] != "g" && $square[0] != "h"){
        $newrank = numberToLetter(letterToNumber($square[0]) + 2);
        if($square[1] < 8){
            array_push($squaresToLook, $newrank . ($square[1] +1));
        }
        if($square[1] > 1){
            array_push($squaresToLook, $newrank . ($square[1] -1));
        }
    }
    if($square[0] != "h"){
        $newrank = numberToLetter(letterToNumber($square[0]) + 1);
        if($square[1] < 7){
            array_push($squaresToLook, $newrank . ($square[1] +2));
        }
        if($square[1] > 2){
            array_push($squaresToLook, $newrank . ($square[1] -2));
        }
    }
    foreach($squaresToLook as $square){
        if($origin !== false){
            if(is_numeric($origin) && $square[1] == $origin && isset($currentPos[$square]) && $currentPos[$square] == $piece){
                return $square;
            }
            elseif($square[0] == $origin && isset($currentPos[$square]) && $currentPos[$square] == $piece){
                return $square;
            }
        }
        else{
            if(isset($currentPos[$square]) && $currentPos[$square] == $piece){
                return $square;
            }
        }
    }
}
