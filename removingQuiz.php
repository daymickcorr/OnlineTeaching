<?php
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Quiz.cls.php';
    require_once 'Buisness/Content.cls.php';
    
    $content = new Content();
    $content->setId($_GET["contentId"]);
    $content->findById($connectionId);
    $content->setQuizId("NULL");
    $content->updateQuizId($connectionId);
    
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