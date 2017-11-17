<?php
require_once '../Buisness/MemberType.cls.php';
require_once '../Buisness/dbConfig.php';

$memberType = new MemberType();

$memberTypes = $memberType->findAll($connectionId);

echo MemberType::header();
foreach ($memberTypes as $element){
    echo $element;
}
echo MemberType::footer();

$memberType->setName("test");
$id = $memberType->create($connectionId);

echo "<br/>";
echo $id;

$memberType->setId($id);
$memberType->setName("test2");
$memberType->updateName($connectionId);

$memberType->delete($connectionId);


?>