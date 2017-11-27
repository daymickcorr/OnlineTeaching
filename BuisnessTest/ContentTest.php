<?php
require_once '../Buisness/dbConfig.php';
require_once '../Buisness/Content.cls.php';

$content = new Content();

$contents  = $content->findAll($connectionId);
echo Content::header();
foreach ($contents as $element){
    echo $element;
}
echo Content::footer();
//create content with no quiz  update quiz id afterwards

$content->setName("test");
$content->setText("blablabla");
$content->setSubjectId(1);
$content->setQuizId(1);
$id = $content->create($connectionId);
echo "</br>";
echo $id;

$content->setId($id);
$content->setName("test2");
$affectedRows = $content->updateName($connectionId);
echo "</br>";
echo $affectedRows;
echo $content->findById($connectionId);

$affectedRow  = $content->delete($connectionId);
echo "</br>";
echo $affectedRows;

?>