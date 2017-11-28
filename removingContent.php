<?php
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Content.cls.php';
    
    $content = new Content();
    
    $content->setId($id);
    $affectedRows = $content->delete($connectionId);
    
    if ($affectedRows < 1){
        echo "content removal failed";
        return;
    }
    
    header('Location: courseManagement.php'); 
?>