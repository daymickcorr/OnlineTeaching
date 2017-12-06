<?php
require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Question.cls.php';

$val = $_GET["questionAnswer"];
$answer = strtolower($val);

$choix1 = $_GET["questionChoice1"];
$choix2 = $_GET["questionChoice2"];
$choix3 = $_GET["questionChoice3"];
$choix4 = $_GET["questionChoice4"];
$points = $_GET["questionPoints"];
$questionText = $_GET["questionQuestion"];
$questionTypeId = $_GET["questionType"];
$quizId = $_GET["quiz"];

$question = new Question();

$question->setAnswer($answer);
$question->setChoix1($choix1);
$question->setChoix2($choix2);
$question->setChoix3($choix3);
$question->setChoix4($choix4);
$question->setPoints($points);
$question->setQuestion($questionText);
$question->setQuestionTypeId($questionTypeId);
$question->setQuizId($quizId);

$id = $question->create($connectionId);

if(!($id>0)){
    echo "question creation failed";
    return;
}

header('Location: courseManagement.php'); 

?>