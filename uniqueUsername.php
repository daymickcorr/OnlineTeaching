<?php
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Member.cls.php';
    
    $username = $_GET["username"];
    
    $member = new Member();
    
    $status = 0;
    
    foreach($member->findAll($connectionId) as $element){
        if($element->getUserName() == $username){
            $status = "1";
        }
    }
    echo $status;
?>