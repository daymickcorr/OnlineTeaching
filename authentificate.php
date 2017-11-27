<?php
    session_start();
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Member.cls.php';
    
    $id = "-2";
    
    $member = new Member();
    $member->setUserName($_POST["username"]);
    $member->setPassword($_POST["password"]);
    $id = $member->authentificate($connectionId);
    
    echo strval($id);
    
    $_SESSION["id"] = $id;
?>
	