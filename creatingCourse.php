<?php
session_start();

require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Course.cls.php';

$languageId = $_GET["courseLanguage"];
$memberId = $_SESSION["id"];
$name = $_GET["courseName"];
$subCategoryId = $_GET["subCategory"];

$course = new Course();
$course->setLanguageId($languageId);
$course->setMemberId($memberId);
$course->setName($name);
$course->setSubCategoryId($subCategoryId);
$id = $course->create($connectionId);

if (!($id > 0)){
    echo "course creation failed";
    return;
}

header('Location: courseManagement.php'); 
?>