<?php
require_once '../Buisness/Member.cls.php';
require_once '../Buisness/dbConfig.php';

$member = new Member();


$members = $member->findAll($connectionId);
echo Member::header();
foreach ($members as $element){
    echo $element;
}
echo Member::footer();

$member->setEmail("test@yopmail.com");
$member->setFirstName("test");
$member->setLastName("Test");
$member->setMemberTypeId(1);
$member->setPassword("password");
$member->setUserName("test");
$id = $member->create($connectionId);

echo "</br>";
echo $id;

$member->setId($id);
$member->setEmail("test2@yopmail.com");
$member->updateEmail($connectionId);

$member->delete($connectionId);

?>