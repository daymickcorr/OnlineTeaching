<?php
require_once '../Buisness/Subject.cls.php';
require_once '../Buisness/dbConfig.php';

$subject = new Subject();
$subjects = $subject->findAll($connectionId);

echo Subject::header();
foreach ($subjects as $element){
    echo $element;
}
echo Subject::footer();

$subject->setName("test");
$subject->setCourseId(1);

$id = $subject->create($connectionId);

echo "<br/>";
echo $id;

$subject->setId($id);
$subject->setName("test2");
$subject->updateName($connectionId);

$affectedRows = $subject->delete($connectionId);

echo "<br/>";
echo $affectedRows;
?>