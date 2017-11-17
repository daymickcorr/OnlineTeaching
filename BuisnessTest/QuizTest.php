<?php
require_once '../Buisness/Quiz.cls.php';
require_once '../Buisness/dbConfig.php';

$quiz = new Quiz();

$quizs = $quiz->findAll($connectionId);

echo Quiz::header();
foreach ($quizs as $element){
    echo $element;
}
echo Quiz::footer();

$quiz->setName("test3");
$quiz->setTotal(100);
$id = $quiz->create($connectionId);

echo "<br/>";
echo $id;

$quiz->setId($id);
$quiz->setName("test2");
$quiz->updateName($connectionId);

$quiz->delete($connectionId);
?>