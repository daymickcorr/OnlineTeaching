<?php
require_once 'Buisness/dbConfig.php';
require_once 'Buisness/Media.cls.php';

$id = $_GET["id"];

$media = new Media();

$media->setId($id);

$media = $media->findById($connectionId);
if(!unlink($media->getPath())){
    echo "cannot delete physical file";
    return;
}

$affectedRows = $media->delete($connectionId);

if ($affectedRows < 1){
    echo "media removal failed";
    return;
}

header('Location: courseManagement.php'); 
?>