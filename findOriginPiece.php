<?php 
function findOriginPiece($moves, $currentPos, $piece){
    foreach ($moves as $squares){
        print_r($squares);
        foreach($squares as $square)
        {
            echo $square;
            if(isset($currentPos[$square])){
                if($currentPos[$square] == $piece){
                    echo 'found piece ' . $square;
                    return $square;
                    
                }
                else{
                    break;
                }
            }
        }
    }
    return;
}