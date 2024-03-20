<?php
function getBishopMove($currentPos, $move, $isWhiteMove, $currentmove){
    $newPos = $currentPos;
    $piece = "";
    if($isWhiteMove){
        $piece = "wb";
    }
    else{
        $piece = "zb";
    }
    if(str_contains($move,"x")){
        $newPos[$move[2] . $move[3]] = $piece; 
        unset($newPos[findBishop($move[2], $move[3], $currentPos, $piece)]);
    }
    else{       
        $newPos[$move[1] . $move[2]] = $piece; 
        unset($newPos[findBishop($move[1], $move[2], $currentPos, $piece)]);
    }
    return $newPos;
}
function findBishop($endRank, $endFile, $currentPos, $piece){
    $squaretolook = $endRank . $endFile;
    $movedfrom = checkRightUp($squaretolook, $piece, $currentPos);
    if(!empty($movedfrom)){
        return $movedfrom;
    }
    $movedfrom = checkLeftUp($squaretolook, $piece, $currentPos);
    if(!empty($movedfrom)){
        return $movedfrom;
    }
    $movedfrom = checkRightDown($squaretolook, $piece, $currentPos); 
    echo 'hoooi' . $movedfrom;
    if(!empty($movedfrom)){
        return $movedfrom;
    }

    $movedfrom = checkLeftDown($squaretolook, $piece, $currentPos);
    if(!empty($movedfrom)){
        return $movedfrom;
    }
    echo 'it moved from ' . $movedfrom;
    return $movedfrom;
}
function checkRightUp($square, $piece, $currentPos){
    if($square[0] != "h" && $square[1] != "8"){
        $rank = letterToNumber($square[0]);
        $rank++;
        $rank = numberToLetter($rank);
        $square = $rank . ($square[1] +1);
        if (checkSquare($square, $piece, $currentPos)){
            echo 'RU found bishop at ' . $square;
            return $square;          
        }
        else{
            echo 'nobisshop ' . $square;
            checkrightUp($square, $piece, $currentPos);
        }
    }
    else{
    return;
    }
}
function checkRightDown($square, $piece, $currentPos){
    $movedfrom = "";
    if($square[0] != "i" && $square[1] != "0"){
        $rank = letterToNumber($square[0]);
        $rank++;
        $rank = numberToLetter($rank);
        $square = $rank . ($square[1] -1);
        if (checkSquare($square, $piece, $currentPos)){              
            echo 'RD found bishop at ' . $square;
            $movedfrom = $square;  
            echo 'hallo ' .$movedfrom;
            
        }
        else{
            echo 'nobisshop ' . $square;
            checkRightDown($square, $piece, $currentPos);
        }
    }
    return $movedfrom; 
}
function checkLeftUp($square, $piece, $currentPos){
    if($square[0] != "a" && $square[1] != "8"){
        $rank = letterToNumber($square[0]);
        $rank--;
        $rank = numberToLetter($rank);
        $square = $rank . ($square[1] +1);
        if (checkSquare($square, $piece, $currentPos)){
            echo 'LU found bishop at ' . $square;
            return $square;          
        }
        else{
            echo 'nobisshop ' . $square;
            checkleftUp($square, $piece, $currentPos);
        }
    }
    else{
    return;
    }
}
function checkLeftDown($square, $piece, $currentPos){
    if($square[0] != "a" && $square[1] != "1"){
        $rank = letterToNumber($square[0]);
        $rank--;
        $rank = numberToLetter($rank);
        $square = $rank . ($square[1] -1);
        if (checkSquare($square, $piece, $currentPos)){
            echo 'LD found bishop at ' . $square;
            return $square;          
        }
        else{
            echo 'nobisshop ' . $square;
            checkleftDown($square, $piece, $currentPos);
        }
    }
    else{
    return "nope";
    }
}
function checkSquare($square, $piece, $currentPos){
    if(isset($currentPos[$square]) && $currentPos[$square] == $piece){
        return true;
    }
    else{
        return false;
    }
}