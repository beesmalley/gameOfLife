<?php
        $file=file("userdata.txt");
        $newdata=$_POST["uname"].",".$_POST["pass"]."\n";
        $name=$_POST["uname"];
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
            }else{
                $file=file("data.txt");
                $newdata=$_POST["uname"].",".$_POST["pass"]."\n";
                file_put_contents($file,$newdata,FILE_APPEND);
                $name=$_POST["uname"];
                header('login.html')
            }
        }
        

       
    ?>