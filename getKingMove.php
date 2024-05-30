<?php
function getKingMove($currentPos, $move, $isWhiteMove, $currentmove){
    $newPos = $currentPos;
    if($isWhiteMove){
        $piece = "wk";
    }
    else{
        $piece = "zk";
    } 
    $newPos[substr($move, -2)] = $piece; 
    unset($newPos[findKing(substr($move, -2), $currentPos, $piece)]);
    return $newPos;
}

    function findKing($square, $currentPos, $piece){
        //echo 'find king k' . $square;
        $arrayToLook = [];
        if($square[0] != "h"){
            $rankUp = numberToLetter(letterToNumber($square[0]) +1);
        }
        if($square[0] != "a"){
            $rankDown = numberToLetter(letterToNumber($square[0]) -1);
        }
        $arrayToCheck = [];
        if($square[0] != "8"){
            array_push($arrayToLook, $square[0] . $square[1] +1);
            array_push($arrayToCheck, $arrayToLook);
        }
        $arrayToLook = [];
        if($square[1] != "1"){
            array_push($arrayToLook, $square[0] . $square[1] -1);
            array_push($arrayToCheck, $arrayToLook);
        }
        $arrayToLook = [];
        if($square[0] != "h"){
            if($square[1] != "1"){
                array_push($arrayToLook, $rankUp . $square[1] -1);
                array_push($arrayToCheck, $arrayToLook);
            }
            $arrayToLook = [];
            array_push($arrayToLook, $rankUp . $square[1]);
            array_push($arrayToCheck, $arrayToLook);
            $arrayToLook = [];
            if($square[0] != "8"){
                array_push($arrayToLook, $rankUp . $square[1] +1);
                array_push($arrayToCheck, $arrayToLook);
            }
            $arrayToLook = [];
        }
        if($square[0] != "a"){
            if($square[1] != "1"){
                array_push($arrayToLook, $rankDown . $square[1] -1);
                array_push($arrayToCheck, $arrayToLook);
            }
            $arrayToLook = [];
            array_push($arrayToLook, $rankDown . $square[1]);
            array_push($arrayToCheck, $arrayToLook);
            $arrayToLook = [];
            if($square[0] != "8"){
                array_push($arrayToLook, $rankDown . $square[1] +1);
                array_push($arrayToCheck, $arrayToLook);
            }
        }
        echo 'kingmove ' . $square;
        echo '<pre>';
        echo print_r($arrayToCheck);
        echo '</pre>';
        return findOriginPiece($arrayToCheck,$currentPos,$piece);
    }
    