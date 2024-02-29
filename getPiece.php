<?php
function getPiece(string $piece, bool $color){
  switch($piece){
    case "a":
    case "b":
    case "c":
    case "d":
    case "e":
    case "f":
    case "g":
    case "h":
      if($color) {
        return "wp";
      }
        else{
          return "zp";
      }
    case "N":
      if($color) {
        return "wn";
      }
        else{
          return "zn";
      }
    case "B":
      if($color){
        return "wb";
      }
      else{
        return "zb";
      }
    case "R":
      if($color) {
        return "wr";
      }
      else{
        return "zr";
      }
    case "Q":
      if($color){
        return "wq";
      }
      else{
        return "zq";
      }
    case "K":
      if($color){
        return "wk";
      }
      else{
        return "zk";
      }
    case "cq":
      if($color){
        return "cqw";
      }
      else{
        return "cqz";
      }
    case "ck":
      if($color){
        return "ckw";
      }
      else{ 
        return "ckz";
      }
    default:
    return "Unknown piece";
  }
}
