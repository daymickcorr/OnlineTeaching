<?php
require_once '../Buisness/QuestionByMember.cls.php';
require_once '../Buisness/dbConfig.php';

$questionByMember = new QuestionByMember();

$questionByMembers = $questionByMember->findAll($connectionId);

echo QuestionByMember::header();
foreach ($questionByMembers as $element){
    echo $element;
}
echo QuestionByMember::footer();

$questionByMember->setAnswer("a");
$questionByMember->setMemberId(1);
$questionByMember->setQuestionId(1);

$id = $questionByMember->create($connectionId);

echo "<br/>";
echo $id;

$questionByMember->setId($id);
$questionByMember->setAnswer("b");
$questionByMember->updateAnswer($connectionId);

$questionByMember->delete($connectionId);
?>