<?php
require 'getRookMove.php';
require 'getBishopMove.php';
require 'getKnightMove.php';
require 'getQueenMove.php';
require 'findOriginPiece.php';
function getNewPosition($currentPos, $move, $isWhiteMove, $currentmove){
    $newPos = $currentPos;
    $move = str_replace("+", "", $move);
    $move = str_replace("#", "", $move);
    $allfiles = array("a","b","c","d","e","f","g","h");
    $aFile = array("a1", "a2", "a3", "a4", "a5", "a6", "a7", "a8");
    $bFile = array("b1", "b2", "b3", "b4", "b5", "b6", "b7", "b8");
    $cFile = array("c1", "c2", "c3", "c4", "c5", "c6", "c7", "c8");
    $dFile = array("d1", "d2", "d3", "d4", "d5", "d6", "d7", "d8");
    $eFile = array("e1", "e2", "e3", "e4", "e5", "e6", "e7", "e8");
    $fFile = array("f1", "f2", "f3", "f4", "f5", "f6", "f7", "f8");
    $gFile = array("g1", "g2", "g3", "g4", "g5", "g6", "g7", "g8");
    $hFile = array("h1", "h2", "h3", "h4", "h5", "h6", "h7", "h8");
    

    if(str_contains($move, "=")){
        //echo 'promotion at move ' . $move;
    }
    elseif(str_contains($move, "O-O")){
        if($isWhiteMove){
            unset($newPos["e1"]);
            unset($newPos["h1"]);
            $newPos["f1"] = "wr";
            $newPos["g1"] = "wk";
            return $newPos;
        }
        else{
            unset($newPos["e8"]);
            unset($newPos["h8"]);
            $newPos["f8"] = "zr";
            $newPos["g8"] = "zk";
            return $newPos;
        }
    }
    elseif(str_contains($move, 'O-O-O')){
        if($isWhiteMove){
            unset($newPos["e1"]);
            unset($newPos["a1"]);
            $newPos["d1"] = "wr";
            $newPos["c1"] = "wk";
            return $newPos;
        }
        else{
            unset($newPos["e8"]);
            unset($newPos["a8"]);
            $newPos["d8"] = "wr";
            $newPos["c8"] = "wk";
            return $newPos;
        }
    }
    else{
        $piece = getPiece($move[0], $isWhiteMove);       
        if($move[0] == "a" || $move[0] == "b" || $move[0] == "c" || $move[0] == "d" || $move[0] == "e" || $move[0] == "f" || $move[0] == "g" || $move[0] == "h"){
            $movedfrom = "";
            $newsquare = "";
            if(str_contains($move, "x")){
                $newsquare = $move[2] . $move[3];
                if($isWhiteMove){
                    $movedfrom = $move[0] . ($move[3] - 1);
                    if($currentPos[$movedfrom] != "wp"){
                        echo "error: uknown where pawn moved from @ " . $move;
                    }
                }
                else{
                    $movedfrom = $move[0] . ($move[3] + 1);
                    if($currentPos[$movedfrom] != "zp"){
                        echo "error: uknown where pawn moved from @ " . $move;
                    }
                }
            }
            else{
                $newsquare = $move;
                if($isWhiteMove){                    
                    if (isset($currentPos[$move[0] . ($move[1] - 1)]) && $currentPos[$move[0] . ($move[1] - 1)] == $piece){
                        $movedfrom = $move[0] . ($move[1] - 1);

                    }
                    elseif(isset($currentPos[$move[0] . ($move[1] - 2)]) && $currentPos[$move[0] . ($move[1] - 2)] == $piece){
                        $movedfrom = $move[0] . ($move[1] - 2);
                    }
                    else{
                        echo 'error cant locate pawn '. $move . ' ' . $currentmove;
                    }
                }
                else{
                    if (isset($currentPos[$move[0] . ($move[1] + 1)]) && $currentPos[$move[0] . ($move[1] + 1)] == $piece){
                        $movedfrom = $move[0] . ($move[1] + 1);

                    }
                    elseif(isset($currentPos[$move[0] . ($move[1] + 2)]) && $currentPos[$move[0] . ($move[1] + 2)] == $piece){
                        $movedfrom = $move[0] . ($move[1] + 2);
                    }
                    else{
                        echo 'error cant locate pawn '. $move . ' ' . $currentmove;
                    }
                    
                }
            }
            unset($newPos[$movedfrom]);
            $newPos[$newsquare] = $piece; 
        }
        if($move[0] == "R"){
            $newPos = getRookMove($currentPos, $move, $isWhiteMove, $currentmove);      
        }   
        if($move[0] == "B"){
            $newPos = getBishopMove($currentPos, $move, $isWhiteMove, $currentmove);
        }     
        if($move[0] == "N"){
            $newPos = getKnightMove($currentPos, $move, $isWhiteMove, $currentmove);
        }
        if($move[0] == "Q"){
            $newPos = getQueenMove($currentPos, $move, $isWhiteMove, $currentmove);
        }
    }
    return $newPos;
}
function letterToNumber ($letter){
    $alphabet = range('a', 'z');
    return array_search($letter, $alphabet);
}
function numberToLetter($number){
    $alphabet = range('a', 'z');
    return $alphabet[$number];
}
