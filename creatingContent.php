<?php

require_once 'Buisness/dbConfig.php';
require_once 'Buinsess/Content.cls.php';

$name = $_GET["contentName"];
$quizId = $_GET["contentQuiz"];
$subjectId = $_GET["contentSubject"];
$text = $_GET["contentText"];

$content = new Content();

$content->setName($name);
$content->setQuizId($quizId);
$content->setSubjectId($subjectId);
$content->setText($text);

$id = $content->create($connectionId);

if (!($id>0)){
    echo "content creation failed";
    return;
}

header('Location: courseManagement.php'); 
?>