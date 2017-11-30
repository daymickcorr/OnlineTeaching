<?php

require_once 'Buisness/dbConfig.php';
require_once 'Buinsess/Content.cls.php';

$oldContent = new Content();
$oldContent->setId($_GET["id"]);
$oldContent = $oldContent->findById($connectionId);



$name = $_GET["contentName"];
$quizId = $_GET["contentQuiz"];
$subjectId = $_GET["contentSubject"];
$text = $_GET["contentText"];

$content = new Content();
$content->setId($_GET["id"]);
$content->setName($name);
$content->setQuizId($quizId);
$content->setSubjectId($subjectId);
$content->setText($text);

if($content->getName() != $oldContent->getName()){$content->updateName($connectionId);}
if($content->getQuizId() != $oldContent->getQuizId()){$content->updateQuizId($connectionId);}
if($content->getSubjectId() != $oldContent->getSubjectId()){$content->updateSubjectId($connectionId);}
if($content->getText() != $oldContent->getText()){$content->updateText($connectionId);}

header('Location: courseManagement.php');
?>