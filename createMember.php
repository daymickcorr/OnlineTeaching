<?php
require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Member.cls.php';

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$membertype = $_POST["submit"];

$member = new Member();

$member->setFirstName($firstname);
$member->setLastName($lastname);
$member->setEmail($email);
$member->setUserName($username);
$member->setPassword($password);
$member->setMemberTypeId($membertype);

$id = $member->create($connectionId);

if($id > 0){
    header("Location: index.php");
}
else{
    alert("error : "+ $id);
}

?>