<?php
require 'getRookMove.php';
require 'getBishopMove.php';
require 'getKnightMove.php';
require 'getQueenMove.php';
require 'getKingMove.php';
require 'findOriginPiece.php';
function getNewPosition($currentPos, $move, $isWhiteMove, $currentmove){
    $newPos = $currentPos;
    $move = str_replace("+", "", $move);
    $move = str_replace("#", "", $move);   

    if(str_contains($move, "=")){
        //echo 'promotion at move ' . $move;                 
        echo "wajowe";
        if(str_contains($move, "x")){
            if($isWhiteMove){
                unset($newPos[$move[0] . "7"]);
                $newPos[$move[2] . $move[3]] = getPiece(substr($move, -1), true);
            }
            else{
                unset($newPos[$move[0] . "2"]);
                $newPos[$move[2] . $move[3]] = getPiece(substr($move, -1), false);
                }
            }  
        else{
            if($isWhiteMove){
                unset($newPos[$move[0] . "7"]);
                $newPos[$move[0] . $move[1]] = getPiece(substr($move, -1), true);
            }
            else{
                unset($newPos[$move[0] . "2"]);
                $newPos[$move[0] . $move[1]] = getPiece(substr($move, -1), false);
                }
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
            $newPos["d8"] = "zr";
            $newPos["c8"] = "zk";
            return $newPos;
        }
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
    else{
        $piece = getPiece($move[0], $isWhiteMove);       
        if($move[0] == "a" || $move[0] == "b" || $move[0] == "c" || $move[0] == "d" || $move[0] == "e" || $move[0] == "f" || $move[0] == "g" || $move[0] == "h"){
            $movedfrom = "";
            $newsquare = "";
            if(str_contains($move, "x")){
                $newsquare = $move[2] . $move[3];
                if($isWhiteMove){
                    $movedfrom = $move[0] . ($move[3] - 1);
                    if(empty($currentPos[$newsquare]) && $currentPos[$move[2] . ($move[3]-1)] == "zp")
                    {
                        echo 'en pasant move @' . $move . '<br>'; 
                        unset($newPos[$move[2] . ($move[3]-1)]);
                    }
                    if($currentPos[$movedfrom] != "wp"){
                        echo "error: uknown where pawn moved from @ " . $move;
                    }
                }
                else{
                    if(empty($currentPos[$newsquare]) && $currentPos[$move[2] . ($move[3]+1)] == "wp")
                    {
                        echo 'en pasant move @' . $move; 
                        unset($newPos[$move[2] . ($move[3]+1)]);
                    }
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
        if($move[0] == "K"){
            $newPos = getKingMove($currentPos, $move, $isWhiteMove, $currentmove);
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
