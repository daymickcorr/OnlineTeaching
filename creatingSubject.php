<?php
require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Subject.cls.php';

$courseId = $_GET["course"];
$name = $_GET["subjectName"];

$subject = new Subject();

$subject->setCourseId($courseId);
$subject->setName($name);

$id = $subject->create($connectionId);

if (!($id > 0)){
    echo "Subject creation failed";
    return;
}

header('Location: courseManagement.php'); 

?>