<?php
    function getVisualPiece(string $piece){
switch($piece){
    case "wp":
        return "&#9817";
    case "zp":
        return "&#9823";
    case "wn":
        return "&#9816";
    case "bn":
        return "&#9822";
    case "wb":
        return "&#9815";
    case "bb":
        return "&#9821";
    case "wr":
        return "&#9814";
    case "zr":
        return "&#9820";
    case "wq":
        return "&#9813";
    case "zq":
        return "&#9819";
    case "wk":
        return "&#9812";
    case "bk": 
        return "&#9818";
    default:
        return "ERROR";
    }
}
