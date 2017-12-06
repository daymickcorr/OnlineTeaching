<?php

require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Content.cls.php';

$name = $_POST["contentName"];
$subjectId = $_POST["contentSubject"];
$text = $_POST["contentText"];

if ($_POST["contentQuiz"] == ""){unset($_POST["contentQuiz"]);}

echo $name;
echo "<br/>";
echo $subjectId;
echo "<br/>";
echo $text;
echo "<br/>";

if(isset($_POST["contentQuiz"])){
    $quizId = $_POST["contentQuiz"];
}

$content = new Content();

$content->setName($name);
$content->setSubjectId($subjectId);
$content->setText($text);

if(isset($_POST["contentQuiz"])){
    $content->setQuizId($quizId);
}

if (isset($_POST["contentQuiz"])){
    echo "create quiz";
    $id = $content->create($connectionId);
}
else{
    echo "create no quiz";
    $id = $content->createNoQuiz($connectionId);    
}


if (!($id>0)){
    echo "content creation failed";
    return;
}


header('Location: courseManagement.php'); 
?>