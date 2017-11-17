<?php
require_once '../Buisness/Media.cls.php';
require_once '../Buisness/dbConfig.php';

$media = new Media();
echo Media::header();
foreach ($media->findAll($connectionId) as $element){
    echo $element;
}
echo Media::footer();

$media->setName("test");
$media->setPath("/Media/1/1d842ce4115046e388afa5c29b7cbdcb.jpg");
$media->setType(".jpg");
$media->setContentId(1);

$id = $media->create($connectionId);
echo "</br>";
echo $id;

$media->setId($id);
$media->setName("test2");
$media->updateName($connectionId);

$media->delete($connectionId);
?>