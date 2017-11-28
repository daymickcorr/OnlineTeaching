<?php
session_start();
require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Media.cls.php';


$uploadError = $_FILES["media"]["error"];
$file = $_FILES["media"]["tmp_name"];
$name = $_POST["mediaName"];
$type = '.'.pathinfo($_FILES["media"]['name'],PATHINFO_EXTENSION);
$contentId = $_POST["content"];

if (!is_uploaded_file($file)){echo "Image Upload Failed error // " .$uploadError;}

$path = "Media/".$_SESSION["id"]."/";

if (!is_dir($path)){mkdir($path, 0777, true);}

$newName = md5(uniqid(rand(), true));

$newFullPath = $path.$newName.$type;

move_uploaded_file($file, $newFullPath);


$media = new Media();

$media->setName($name);
$media->setPath($newFullPath);
$media->setType($type);
$media->setContentId($contentId);

$id = $media->create($connectionId);

if(!($id > 0)){ echo "file information has not been uploaded in db"; return;}

header('Location: courseManagement.php'); 


?>