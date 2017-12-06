<?php
session_start();
require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Member.cls.php';

$member = new Member();
$member->setId($_SESSION["id"]);
$member = $member->findById($connectionId);

echo $member->getMemberTypeId();

?>