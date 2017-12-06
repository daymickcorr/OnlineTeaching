<?php

require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Content.cls.php';

$oldContent = new Content();
$oldContent->setId($_POST["id"]);
$oldContent = $oldContent->findById($connectionId);

$name = $_POST["contentName"];
$subjectId = $_POST["contentSubject"];
$text = $_POST["contentText"];
$quizId = $_POST["contentQuiz"];


$content = new Content();
$content->setId($_POST["id"]);
$content->setName($name);
$content->setSubjectId($subjectId);
$content->setText($text);
$content->setQuizId($quizId);


if($content->getName() != $oldContent->getName()){$content->updateName($connectionId);}
if($content->getSubjectId() != $oldContent->getSubjectId()){$content->updateSubjectId($connectionId);}
if($content->getText() != $oldContent->getText()){$content->updateText($connectionId);}
if($content->getQuizId() != $oldContent->getQuizId()){$content->updateQuizId($connectionId);}

header('Location: courseManagement.php');
?>