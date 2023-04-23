<?php

session_start();
$_SESSION["uname"]=$_POST["uname"];
$file = file("userdata.txt");
$found=false;

for($i=0;$i<count($file);$i++){
    $personinfo=explode(",",$file[$i]);
    $username=trim($personinfo[0]);
    $password=trim($personinfo[1]);
    $score=trim($personinfo[2]);
    if($username==$_POST["uname"] && $password==$_POST["password"]){
        $found=true;
        $_SESSION["score"]=$score;
        break;
    }
}

if(!$found){
    $_SESSION["incorrect_message"] = "Incorrect Username or Password.";
    header('Location: login.php');
}else{
    header('Location: gamepage.php');
}

?>
