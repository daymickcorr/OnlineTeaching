<?php
session_start();

require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Course.cls.php';

$oldCourse = new Course();
$oldCourse->setId($_GET["id"]);
$oldCourse = $oldCourse->findById($connectionId);

$languageId = $_GET["courseLanguage"];
$memberId = $_SESSION["id"];
$name = $_GET["courseName"];
$subCategoryId = $_GET["subCategory"];

$course = new Course();
$course->setId($_GET["id"]);

$course->setLanguageId($languageId);
$course->setMemberId($memberId);
$course->setName($name);
$course->setSubCategoryId($subCategoryId);

if ($oldCourse->getLanguageId() != $course->getLanguageId()){$course->updateLanguageId($connectionId);}
if ($oldCourse->getMemberId() != $course->getMemberId()){$course->updateMemberId($connectionId);}
if ($oldCourse->getName() != $course->getName()){$course->updateName($connectionId);}
if ($oldCourse->getSubCategoryId() != $course->getSubCategoryId()){$course->updateSubCategoryId($connectionId);}

header('Location: courseManagement.php');
?>