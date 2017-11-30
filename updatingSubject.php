<?php
require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Subject.cls.php';

$oldSubject = new Subject();
$oldSubject->setId($_GET["id"]);
$oldSubject = $oldSubject->findById($connectionId);

$courseId = $_GET["course"];
$name = $_GET["subjectName"];

$subject = new Subject();
$subject->setId($_GET["id"]);
$subject->setCourseId($courseId);
$subject->setName($name);

if($oldSubject->getCourseId() != $subject->getCourseId()){$subject->updateCourseId($connectionId);}
if($oldSubject->getName() != $subject->getName()){$subject->updateName($connectionId);}

header('Location: courseManagement.php');

?>