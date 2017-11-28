<?php
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Question.cls.php';
    
    $id = $_GET["id"];
    
    $question = new Question();
    
    $question->setId($id);
    $affectedRows = $question->delete($connectionId);
    
    if ($affectedRows < 1){
        echo "question removal failed";
        return;
    }
    
    header('Location: courseManagement.php'); 
?>