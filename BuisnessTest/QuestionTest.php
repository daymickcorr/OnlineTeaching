<?php
require_once '../Buisness/Question.cls.php';
require_once '../Buisness/dbConfig.php';

$question = new Question();

$questions = $question->findAll($connectionId);
echo Question::header();
foreach($questions as $element){
    echo $element;
}
echo Question::footer();

$question->setPoints(100);
$question->setQuestion("test");
$question->setQuestionTypeId(1);
$question->setQuizId(1);
$question->setAnswer("a");
$question->setChoix1("a");
$question->setChoix2("b");
$question->setChoix3("c");
$question->setChoix4("d");
$id = $question->create($connectionId);

echo "<br/>";
echo $id;

$question->setId($id);
$question->setQuestion("test2");
$question->updateQuestion($connectionId);

$question->delete($connectionId);
?>