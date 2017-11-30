<?php
require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Question.cls.php';

$oldQuestion = new Question();
$oldQuestion->setId($_GET["id"]);
$oldQuestion = $oldQuestion->findById($connectionId);

$answer = $_GET["questionAnswer"];
$choix1 = $_GET["questionChoice1"];
$choix2 = $_GET["questionChoice2"];
$choix3 = $_GET["questionChoice3"];
$choix4 = $_GET["questionChoice4"];
$points = $_GET["questionPoints"];
$questionText = $_GET["questionQuestion"];
$questionTypeId = $_GET["questionType"];
$quizId = $_GET["quiz"];

$question = new Question();
$question->setId($_GET["id"]);
$question->setAnswer($answer);
$question->setChoix1($choix1);
$question->setChoix2($choix2);
$question->setChoix3($choix3);
$question->setChoix4($choix4);
$question->setPoints($points);
$question->setQuestion($questionText);
$question->setQuestionTypeId($questionTypeId);
$question->setQuizId($quizId);

if ($question->getAnswer() != $oldQuestion->getAnswer()){$question->updateAnswer($connectionId);}
if ($question->getChoix1() != $oldQuestion->getChoix1()){$question->updateChoix1($connectionId);}
if ($question->getChoix2() != $oldQuestion->getChoix2()){$question->updateChoix2($connectionId);}
if ($question->getChoix3() != $oldQuestion->getChoix3()){$question->updateChoix3($connectionId);}
if ($question->getChoix4() != $oldQuestion->getChoix4()){$question->updateChoix4($connectionId);}
if ($question->getPoints() != $oldQuestion->getPoints()){$question->updatePoints($connectionId);}
if ($question->getQuestion() != $oldQuestion->getQuestion()){$question->updateQuestion($connectionId);}
if ($question->getQuestionTypeId() != $oldQuestion->getQuestionTypeId()){$question->updateQuestionTypeId($connectionId);}
if ($question->getQuizId() != $oldQuestion->getQuizId()){$question->updateQuizId($connectionId);}


header('Location: courseManagement.php');

?>