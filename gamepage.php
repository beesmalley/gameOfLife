<?php
session_start();
if(isset($_POST['start'])) {
    $start_time = time();
  }
  
  if(isset($_POST['stop'])) {
    $stop_time = time();
    $newscore = $stop_time - $start_time;
    $fp = fopen('userdata.txt','a+');
    $path = 'userdata.txt';
    if(file_exists($path)){
        $contents = file($path);
        foreach($contents as $value){
            $personinfo=explode(",",$contents[$value]);
            $username=trim($personinfo[0]);
            $password=trim($personinfo[1]);
            $score=trim($personinfo[2]);
            if($username==$_SESSION["uname"]){
                if($newscore>$score){
                    $score = $newscore;
                    break;
                }
            }
        }
        $userarr = array();
        $scorearr = array();
        foreach($contents as $value){
            $personinfo=explode(",",$contents[$value]);
            $userarr[$value] = $personinfo[0];
            $scorearr[$value] =$personinfo[2];
        }
        $leaders = array_combine($userarr,$scorearr);
        
        $leaders = arsort($leaders);
    }
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
            <form method="POST">
                <button name="start" type="submit">Start</button>
                <button name="stop" type="submit">Stop</button>
                <input type="text" name="result" value="">
            </form>
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