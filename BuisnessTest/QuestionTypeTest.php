<?php
require_once '../Buisness/QuestionType.cls.php';
require_once '../Buisness/dbConfig.php';

$questionType = new QuestionType();
$questionTypes = $questionType->findAll($connectionId);

echo QuestionType::header();
foreach ($questionTypes as $element){
    echo $element;
}
echo QuestionType::footer();

$questionType->setName("test");
$id = $questionType->create($connectionId);

echo "<br/>";
echo $id;

$questionType->setId($id);
$questionType->setName("test2");
$questionType->updateName($connectionId);

$questionType->delete($connectionId);
?>