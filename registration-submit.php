<?php
 $file = file("userdata.txt");
 $newdata = $_POST["uname"] . "," . $_POST["password"] .",0". "\n";
 $name = $_POST["uname"];
 $found = false;
 
 for ($i = 0; $i < count($file); $i++) {
     $personinfo = explode(",", $file[$i]);
     $username = trim($personinfo[0]);
     $password = trim($personinfo[1]);
     if ($username == $_POST["uname"] && $password == $_POST["pass"]) {
         $found = true;
         break;
     }
 }
 
 if (!$found) {
     file_put_contents("userdata.txt", $newdata, FILE_APPEND);
     session_start();
     $_SESSION["confirm_message"] = "Account Successfully Created";
     header('Location: login.php');
 }
    ?>