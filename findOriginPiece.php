<?php 
function findOriginPiece($moves, $currentPos, $piece){
    foreach ($moves as $squares){
        foreach($squares as $square)
        {
            // echo $square;
            if(isset($currentPos[$square])){
                if($currentPos[$square] == $piece){
                    // echo 'found ' .$piece . ' on '. $square;
                    return $square;                   
                }
                else{
                    break;
                }
            }
        }
    }
    // echo 'dit not find ' . $piece;
    return;
}