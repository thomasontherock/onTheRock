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
    $movedfrom1 = checkLeftUp($squaretolook, $piece, $currentPos);
    if(!empty($movedfrom1)){
        return $movedfrom1;
    }
    $movedfrom2 = checkRightDown($squaretolook, $piece, $currentPos); 
    echo 'hoooi ' . $movedfrom2 . ' asdf';
    if(!empty($movedfrom2)){
        return $movedfrom2;
    }
    $movedfrom3 = checkLeftDown($squaretolook, $piece, $currentPos);
    if(!empty($movedfrom3)){
        return $movedfrom3;
    }
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
            return checkrightUp($square, $piece, $currentPos);
        }
    }
    else{
    return;
    }
}
function checkRightDown($square, $piece, $currentPos){
    $movedfrom = "";
    if($square[0] != "h" && $square[1] != "1"){
        $rank = letterToNumber($square[0]);
        $rank++;
        $rank = numberToLetter($rank);
        $square = $rank . ($square[1] -1);
        if (checkSquare($square, $piece, $currentPos)){              
            echo 'RD found bishop at ' . $square;
            return $square;         
        }
        else{
            echo 'nobisshop ' . $square;
            return checkRightDown($square, $piece, $currentPos);
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
            return checkleftUp($square, $piece, $currentPos);
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
            return checkleftDown($square, $piece, $currentPos);
        }
    }
    else{
    return;
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