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
        unset($currentPos[findBishop($move[2], $move[3], $currentPos, $piece)]);
    }
    else{
        $newPos[$move[1] . $move[2]] = $piece; 
    }


    return $newPos;
}
function findBishop($endRank, $endFile, $currentPos, $piece){
    $movedfrom = "";
    $squaretolook = $endRank . $endFile;
    if ($currentPos[$squaretolook] == $piece){
        return $squaretolook;      
    } 
    elseif($squaretolook[0] != "h" || $squaretolook[1] != "8"){
        $rank = letterToNumber($squaretolook[0]);
        $rank++;
        $squaretolook = $rank . ($squaretolook[1] +1);

    }
    if(empty($movedfrom)){
            echo "error empty bishop move!";
    }
    return $movedfrom;
}