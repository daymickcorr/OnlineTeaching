<?php

$host = "127.0.0.1";
$username = "root";
$password = "";
$dbName = "onlineteaching";
try{
    $connectionId = new PDO("mysql:host=$host;dbname=$dbName",$username,$password);
    //echo "connected";
}
catch(PDOException $ex){
    echo $ex;
}
?>