<?php
session_start();


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
            <button>Start</button>
            <button>Stop</button>
            <button>Increment 1 Generation</button>
            <button>Increment 23 Generations</button>
            <button>Reset</button>
            Animate:<select>
                <option>option 1</option>
                <option>option 2</option>
                <option>option 3</option>
                <option>option 4</option>
            </select>

        </div>
        
    </div>

    <script src="game.js"></script>
</body>
</html>