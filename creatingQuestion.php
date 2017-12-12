<?php
require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Question.cls.php';

$val = $_GET["questionAnswer"];
$answer = mb_strtolower($val,'UTF-8');

$val1 = $_GET["questionChoice1"];
$val2 = $_GET["questionChoice2"];
$val3 = $_GET["questionChoice3"];
$val4 = $_GET["questionChoice4"];

$choix1 =  mb_strtolower($val1,'UTF-8');
$choix2 =  mb_strtolower($val2,'UTF-8');
$choix3 =  mb_strtolower($val3,'UTF-8');
$choix4 =  mb_strtolower($val4,'UTF-8');
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