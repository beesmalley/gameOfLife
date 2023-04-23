<?php
session_start();

$file = file("userdata.txt");
$users = array();
$lineNum = "";
$username="";
$password="";
$score="";
for($i=0; $i<count($file); $i++){
    $personinfo = explode(",", $file[$i]);
    $username = trim($personinfo[0]);
    $password = trim($personinfo[1]);
    $score = trim($personinfo[2]);
    $users[] = array('username' => $username, 'score' => $score);
    if($username == $_SESSION["uname"]){
        $_SESSION["score"] = $score;
        $lineNum=$i;
        break;
    }
}

// Check if the start button has been pressed
if(isset($_POST['start'])) {
    // Save the start time in a session variable
    $_SESSION['start_time'] = time();
}

// Check if the stop or reset button has been pressed
if(isset($_POST['stop']) || isset($_POST['reset'])) {
    // Calculate the time elapsed in seconds
    if(isset($_SESSION['start_time'])){
        $elapsed_time = time() - $_SESSION['start_time'];
        // Add the elapsed time to the user's score
        $score += $elapsed_time;
        // Update the score in the user data file
        $file[$lineNum] = $username . "," .$password . "," . $score . "\n";
        file_put_contents("userdata.txt", implode("", $file));
        // Update the score in the session
        $_SESSION['score'] = $score;
        // Unset the start time session variable
        unset($_SESSION['start_time']);
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
<script>
document.addEventListener('DOMContentLoaded', function() {
  var form = document.getElementById('game-form');
  var startBtn = document.getElementById('start');
  var stopBtn = document.getElementById('stop');
  var resetBtn = document.getElementById('reset');

  form.addEventListener('submit', function(e) {
    e.preventDefault(); // prevent the form from submitting

    // handle the form submission asynchronously
    var xhr = new XMLHttpRequest();
    xhr.open('POST', form.action);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(new FormData(form));
  });

  // handle button clicks
  startBtn.addEventListener('click', function(e) {
    e.preventDefault(); // prevent the button from submitting the form
    var xhr = new XMLHttpRequest();
    xhr.open('POST', form.action);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('start=true');
  });

  stopBtn.addEventListener('click', function(e) {
    e.preventDefault(); // prevent the button from submitting the form
    var xhr = new XMLHttpRequest();
    xhr.open('POST', form.action);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('stop=true');
  });

  resetBtn.addEventListener('click', function(e) {
    e.preventDefault(); // prevent the button from submitting the form
    var xhr = new XMLHttpRequest();
    xhr.open('POST', form.action);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('reset=true');
  });
});


</script>

<body>
    <div>
        <div id="top">
            <div id="gamebox">

            </div>
            <div id="leaderboard">
            
            </div>
        </div>
        <div id="buttonpanel">
            <form id="game-form">
                <button id="start" name="start" type="button">Start</button>
                <button id="stop" name="stop" type="button">Stop</button>
                <button id="upOne" type="button">Increment 1 Generation</button>
                <button id="upMany" type="button">Increment 23 Generations</button>
                <button id="reset" name="reset" type="button">Reset</button>
                <select>
                    <option disabled selected>Animate</option>
                    <option>The Toad</option>
                    <option>The Beacon</option>
                    <option>The Pulsar</option>
                </select>
            </form>

        </div>
        
    </div>
 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to update the leaderboard
    function updateLeaderboard() {
        $.ajax({
            url: 'leaderboard.php', // URL of the PHP file that generates the leaderboard HTML
            success: function(response) {
              
                $('#leaderboard').html(response);
            },
            error: function() {
                console.log('Error updating leaderboard');
            }
            });}

            setInterval(updateLeaderboard, 100);
</script>
    <script src="game.js"></script>
</body>
</html>
