<?php
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Subject.cls.php';
    
    $id = $_GET["id"];
    
    $subject = new Subject();
    
    $subject->setId($id);
    $affectedRows = $subject->delete($connectionId);
    
    if($affectedRows < 1) {
        echo "subject removal failed! Make sure their is no associated subElements ";
        return;
    }
    
    header('Location: courseManagement.php'); 
?>