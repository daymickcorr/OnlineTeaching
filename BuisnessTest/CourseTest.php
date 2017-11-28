<?php
require_once '../Buisness/Course.cls.php';
require_once '../Buisness/dbConfig.php';

$course = new Course();

$courses = $course->findAll($connectionId);

echo Course::header();
foreach ($courses as $element){
    echo $element;
}
echo Course::footer();

$course->setName("test");
$course->setLanguageId(1);
$course->setSubCategoryId(1);
$course->setMemberId(1);
$id = $course->create($connectionId);

echo "</br>";
echo $id;

$course->setId($id);
$course = $course->findById($connectionId);

echo Course::header();
    echo $course;
echo Course::footer();
/*
$course->setName("test2");
$course->updateName($connectionId);

$course->setId($id);
$course->delete($connectionId);
*/
?>