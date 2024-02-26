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
          return "bn";
      }
    case "B":
      if($color){
        return "wb";
      }
      else{
        return "bb";
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
        return "bk";
      }
    default:
    return "Unknown piece";
  }
}
