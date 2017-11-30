<?php
require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Quiz.cls.php';

$oldQuiz = new Quiz();
$oldQuiz->setId($_GET["id"]);
$oldQuiz = $oldQuiz->findById($connectionId);

$name = $_GET["quizName"];
$total = $_GET["quizTotal"];

$quiz = new Quiz();
$quiz->getId($_GET["id"]);
$quiz->setName($name);
$quiz->setTotal($total);

if ($quiz->getName() != $oldQuiz->getName()){$quiz->updateName($connectionId);}
if ($quiz->getTotal() != $oldQuiz->getTotal()){$quiz->updateTotal($connectionId);}

header('Location: courseManagement.php');
?>