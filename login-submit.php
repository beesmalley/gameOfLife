<?php

session_start();
$_SESSION["uname"]=$_POST["uname"];
$file = file("userdata.txt")
$found=false;

for($i=0;$i<count($file);$i++){
    $personinfo=explode(",",$file[$i]);
    $username=trim($personinfo[0]);
    $password=trim($personinfo[1]);
    if($username==$_POST["uname"]){
        if($password==$_POST["pass"]){
            $found=true;
            break;
        }
    }
}

if(!$found){
    echo "<div id=\"box\">
    <p>Incorrect username or password.</p>
    <br>
    </div>";
}else{
    header('gamepage.html')
    }


?>