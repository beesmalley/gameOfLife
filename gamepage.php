<?php
session_start();
if(!isset($_SESSION['score'])){
    $_SESSION['score'] = time();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="game.css">
    <title>Game of Life</title>
</head>
<body>
    <div>
        <div id="top">
            <div id="gamebox">

            </div>
            <div id="leaderboard">
                <h1>Leaderboard</h1>
            </div>
        </div>
        <div id="buttonpanel">
            <button id="start">Start</button>
            <button id="stop">Stop</button>
            <button id="upOne">Increment 1 Generation</button>
            <button id="upMany">Increment 23 Generations</button>
            <button id="reset">Reset</button>
            <select>
                <option disabled selected>Animate</option>
                <option>The Toad</option>
                <option>The Beacon</option>
                <option>The Pulsar</option>
            </select>

        </div>
        
    </div>

    <script src="game.js"></script>
</body>
</html>