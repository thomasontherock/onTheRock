<?php
function getRookMove($currentPos, $move, $isWhiteMove, $currentmove){
    $newPos = $currentPos;
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
                if(!isset($newPos[$move[1] . $move[3]])){
                    echo 'no rook at ' . $newPos[$move[1] . $move[3]];
                }
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
    return $newPos;
}