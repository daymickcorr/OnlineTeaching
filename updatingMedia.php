<?php
session_start();
require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Media.cls.php';

$condition = $_FILES["media"]["tmp_name"];

$oldMedia = new Media();
$oldMedia->setId($_POST["id"]);
$oldMedia = $oldMedia->findById($connectionId);


if($condition != "") {
    $uploadError = $_FILES["media"]["error"];
    $file = $_FILES["media"]["tmp_name"];
    $type = '.'.pathinfo($_FILES["media"]['name'],PATHINFO_EXTENSION);
}

$name = $_POST["mediaName"];
$contentId = $_POST["content"];

if ($condition != ""){
    if (!is_uploaded_file($file)){echo "Image Upload Failed error // " .$uploadError; return;}

    $path = "Media/".$_SESSION["id"]."/";

    if (!is_dir($path)){mkdir($path, 0777, true);}

    $newName = md5(uniqid(rand(), true));

    $newFullPath = $path.$newName.$type;

    move_uploaded_file($file, $newFullPath);
    
    if(!unlink($oldMedia->getPath())){ echo "cannot delete physical file"; return;}
}


$media = new Media();
$media->setId($_POST["id"]);
$media->setName($name);
$media->setContentId($contentId);
if($condition != ""){
    $media->setPath($newFullPath);
    $media->setType($type);
}


if($oldMedia->getName() != $media->getName()){$media->updateName($connectionId);}
if($oldMedia->getContentId() != $media->getContentId()){$media->updateContentId($connectionId);}
if($condition != ""){
    $media->updatePath($connectionId); 
    $media->updateType($connectionId);
}

header('Location: courseManagement.php');


?>