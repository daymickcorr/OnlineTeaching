<?php
require_once '../Buisness/ContentByMember.cls.php';
require_once '../Buisness/dbConfig.php';

$contentByMember = new ContentByMember();

$contentByMembers = $contentByMember->findAll($connectionId);

echo ContentByMember::header();
foreach ($contentByMembers as $element){
    echo $element;
}
echo ContentByMember::footer();


$contentByMember->setDate(date("Y-m-d"));
$contentByMember->setContentId(1);
$contentByMember->setMemberId(1);
$id = $contentByMember->create($connectionId);

echo "</br>";
echo $id;

$contentByMember->setId($id);
$d = strtotime("tomorrow");
$contentByMember->setDate(date("Y-m-d",$d));
$contentByMember->updateDate($connectionId);

echo "</br>";
$contentByMember->setId($id);
echo $contentByMember->findById($connectionId);

$contentByMember->delete($connectionId);

?>