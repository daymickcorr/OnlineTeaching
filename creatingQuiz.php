<?php
    session_start();
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Quiz.cls.php';
    
    $name = $_GET["quizName"];
    $total = $_GET["quizTotal"];
    
    $quiz = new Quiz();
    
    $quiz->setName($name);
    $quiz->setTotal($total);
    $quiz->setMemberId($_SESSION["id"]);
    
    $id = $quiz->create($connectionId);
    
    if(!($id > 0)){
        echo "quiz creation failed";
        return;
    }
    
    header('Location: courseManagement.php'); 
?>