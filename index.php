<?php 
include("databaseconnection.php");
?>
<html>
<head>
    <title> Schaakbord </title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
     include("schaakbord.php");
    ?>
    <button onclick="goToMove(-1)"> < < </button>
    <button onclick="previousMove()"><</button>
    <button onclick="nextMove()"> > </button>
    <div id="moveNr">-1</div>
    <div id="pgn"> pgnViewer</div>
    <?php
    include("resources.php");
    ?>
    <script src="initialiseboard.js"></script>
</body>
</html>
