<?php
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Quiz.cls.php';
    
    $id = $_GET["id"];
    
    $quiz = new Quiz();
    
    $quiz->setId($id);
    $affectedRows = $quiz->delete($connectionId);
    
    if ($affectedRows < 1){
        echo "Quiz removal failed";
        return;
    }
    
    header('Location: courseManagement.php'); 
?>