<?php

try{
    $pdo = new PDO('mysql:host=localhost;dbname=ipos','root','admin123');
    //echo 'Connection Successfull';
}catch(PDOException $error){
    echo $error->getmessage();
}


?>