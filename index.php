<?php 

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
    <button onclick="nextMove()"> > </button>
    <div id="moveNr">1.0</div>
    <div id="pgn"> pgnViewer</div>
    <script src="javascript.js"></script>

</body>
</html>
