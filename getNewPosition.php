<?php
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
        echo 'castle queenside at move ' . $move;
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
        $movedfrom = "";
        if($move[0] == "a" || $move[0] == "b" || $move[0] == "c" || $move[0] == "d" || $move[0] == "e" || $move[0] == "f" || $move[0] == "g" || $move[0] == "h"){
            if(str_contains($move, "x")){
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
                    unset($newPos[$movedfrom]);
                    $newPos[$move] = $piece; 
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
                    unset($newPos[$movedfrom]);
                    $newPos[$move] = $piece; 
                }
            }
        }
        if($move[0] == "R"){
            if(str_contains($move,"x")){
                
                if(strlen($move) == 5){
                    //echo 'hoiii ' . strlen($move);
                    if(is_numeric($move[1])){
                        $movedfrom = $newPos[$move[3] . $move[1]];
                    }
                    else{                   
                        $movedfrom = $newPos[$move[1] . $move[3]];
                    }
                }
                if(strlen($move) == 4){
                    if($isWhiteMove){
                        //echo 'hoiii ' . $move;
                        for ($i = $move[3]; $i <=8; $i++){
                            //echo 'move: ' . $move . ' checking ' .$move[2] . $i;
                            if(isset($currentPos[$move[2] . $i]) && $currentPos[$move[2] . $i] == "wr"){
                                $movedfrom = $move[2] . $i ;
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                        for ($i = $move[3]; $i >=1; $i--){
                           // echo 'move: ' . $move . ' checking ' .$move[2] . $i;
                            if(isset($currentPos[$move[2] . $i]) && $currentPos[$move[2] . $i] == "wr"){                               
                                $movedfrom = $move[2] . $i ;
                               // echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                        for ($i = letterToNumber($move[2]); $i <=7; $i++){  
                            //echo 'move: ' . $move . ' checking ' .numberToLetter($i) . $move[3];                 
                            if(isset($currentPos[numberToLetter($i) . $move[3]]) && $currentPos[numberToLetter($i) . $move[3]] == "wr"){
                                $movedfrom = numberToLetter($i) . $move[3]; 
                               // echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                        for ($i = letterToNumber($move[2]); $i >=0; $i--){
                            //echo 'move: ' . $move . ' checking ' .$move[2] . letterToNumber($i); 
                            if(isset($currentPos[numberToLetter($i) . $move[3]]) && $currentPos[numberToLetter($i) . $move[3]] == "wr"){                               
                                $movedfrom = numberToLetter($i) . $move[3] ;
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                    }
                    else{                      
                        for ($i = $move[3]; $i <=8; $i++){
                            //echo 'move: ' . $move . ' checking ' .$move[2] . $i;
                            if(isset($currentPos[$move[2] . $i]) && $currentPos[$move[2] . $i] == "zr"){
                                $movedfrom = $move[2] . $i ;
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                        for ($i = $move[3]; $i >=1; $i--){
                            //echo 'move: ' . $move . ' checking ' .$move[2] . $i;
                            if(isset($currentPos[$move[2] . $i]) && $currentPos[$move[2] . $i] == "zr"){
                                $movedfrom = $move[2] . $i ;
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                        for ($i = letterToNumber($move[2]); $i <=7; $i++){  
                            //echo 'move: ' . $move . ' checking ' .numberToLetter($i) . $move[3];                 
                            if(isset($currentPos[numberToLetter($i) . $move[3]]) && $currentPos[numberToLetter($i) . $move[3]] == "zr"){
                                $movedfrom = numberToLetter($i) . $move[3]; 
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                        for ($i = letterToNumber($move[2]); $i >=0; $i--){
                            //echo 'move: ' . $move . ' checking ' .numberToLetter($i) . $move[3]; 
                            if(isset($currentPos[numberToLetter($i) . $move[3]]) && $currentPos[numberToLetter($i) . $move[3]] == "zr"){                               
                                $movedfrom = numberToLetter($i) . $move[3] ;
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                    }
                }
            }
            else{
                if(strlen($move) == 4){
                   // echo 'rookmove ' . $move;
                    if(is_numeric($move[1])){
                        $movedfrom = $newPos[$move[3] . $move[1]];
                    }
                    else{  
                        echo 'hallotjes ' . $move[1] . $move[3];
                        echo 'for move ' . $move;                  
                        $movedfrom = $newPos[$move[1] . $move[3]];
                    }
                }
                if(strlen($move) == 3){
                    if($isWhiteMove){
                        for ($i = $move[2]; $i <=8; $i++){
                            //echo 'move: ' . $move . ' checking ' .$move[1] . $i;
                            if(isset($currentPos[$move[1] . $i]) && $currentPos[$move[1] . $i] == "wr"){
                                $movedfrom = $move[1] . $i ;
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                        for ($i = $move[2]; $i >=1; $i--){
                            //echo 'move: ' . $move . ' checking ' .$move[1] . $i;
                            if(isset($currentPos[$move[1] . $i]) && $currentPos[$move[1] . $i] == "wr"){                               
                                $movedfrom = $move[1] . $i ;
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                        for ($i = letterToNumber($move[1]); $i <=7; $i++){  
                            //echo 'move: ' . $move . ' checking ' .numberToLetter($i) . $move[2];                 
                            if(isset($currentPos[numberToLetter($i) . $move[2]]) && $currentPos[numberToLetter($i) . $move[2]] == "wr"){
                                $movedfrom = numberToLetter($i) . $move[2]; 
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                        for ($i = letterToNumber($move[1]); $i >=0; $i--){
                            //echo 'move: ' . $move . ' checking ' .$move[1] . letterToNumber($i); 
                            if(isset($currentPos[numberToLetter($i) . $move[2]]) && $currentPos[numberToLetter($i) . $move[2]] == "wr"){                               
                                $movedfrom = numberToLetter($i) . $move[2] ;
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                    }
                    else{
                        for ($i = $move[2]; $i <=8; $i++){
                            if(isset($currentPos[$move[1] . $i]) && $currentPos[$move[1] . $i] == "zr"){
                                $movedfrom = $move[1] . $i ;
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                        for ($i = $move[2]; $i >=1; $i--){
                            if(isset($currentPos[$move[1] . $i]) && $currentPos[$move[1] . $i] == "zr"){
                                $movedfrom = $move[1] . $i ;
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                        for ($i = letterToNumber($move[1]); $i <=7; $i++){  
                            //echo 'move: ' . $move . ' checking ' .numberToLetter($i) . $move[2];                 
                            if(isset($currentPos[numberToLetter($i) . $move[2]]) && $currentPos[numberToLetter($i) . $move[2]] == "zr"){
                                $movedfrom = numberToLetter($i) . $move[2]; 
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                        for ($i = letterToNumber($move[1]); $i >=0; $i--){
                            //echo 'move: ' . $move . ' checking ' .$move[1] . letterToNumber($i); 
                            if(isset($currentPos[numberToLetter($i) . $move[2]]) && $currentPos[numberToLetter($i) . $move[2]] == "zr"){                               
                                $movedfrom = numberToLetter($i) . $move[2] ;
                                //echo 'found movedfrom: ' . $movedfrom;
                                break;
                            }  
                        }
                    }
                }
            }
            //echo 'move: ' . $move . ' movedfrom: ' .$movedfrom;
            if(empty($movedfrom)){
                echo 'empty movedfrom! error could not find: ' .$move;
            }
            unset($newPos[$movedfrom]);
            if($isWhiteMove){
                $newPos[substr($move, -2)] = 'wr'; 
            }
            else{
                $newPos[substr($move, -2)] = 'zr';
            }






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