
<?php
session_start();

$file = file("userdata.txt");
$users = array();
$username="";
$score="";
for($i=0; $i<count($file); $i++){
    $personinfo = explode(",", $file[$i]);
    $username = trim($personinfo[0]);
    $score = trim($personinfo[2]);
    $users[] = array('username' => $username, 'score' => $score);
    if($username == $_SESSION["uname"]){
        $_SESSION["score"] = $score;
        break;
    }
}

usort($users, function($a, $b) {
    return $b['score'] - $a['score'];
});

// Create an HTML string to represent the leaderboard
$leaderboard_html = "<h1>Leaderboard</h1><span id=\"score\">Your score: ".$_SESSION['score']." seconds</span><br><hr><table><thead><tr><th>Rank</th><th>Username</th><th>Score</th></tr></thead><tbody>";

for ($i = 0; $i < 10 && $i < count($users); $i++) {
    $leaderboard_html .= "<tr><td>" . ($i + 1) . "</td><td>" . $users[$i]['username'] . "</td><td>" . $users[$i]['score'] . "</td></tr>";
}

$leaderboard_html .= "</tbody></table>";

$leaderboard_html .= "<br><hr><p id=\"rules\">Welcome to Conway's Game of Life! Play by clicking squares on the grid to bring them to life, then press Start to see if they survive! A square with less than 2 or more than 3 live neighbors will die from under/over crowding. A dead cell with exactly 3 live neighbors will come to life! To clear the grid hit reset, and to stop/pause the simulation press the stop button. The cumulative seconds you spent in a simulation between the press of the start and stop/reset buttons is your score, which you can see here. Have fun and good luck! :)</p>";

// Send the leaderboard HTML as a response to the AJAX request
echo $leaderboard_html;
?>