<?php
require_once '../Buisness/Language.cls.php';
require_once '../Buisness/dbConfig.php';

$language = new Language();

$languages = $language->findAll($connectionId);

echo Language::header();
foreach($languages as $element){
    echo $element;
}
echo Language::footer();

$language->setName("test3");

$id = $language->create($connectionId);

echo "</br>";
echo $id;

$language->setId($id);
$language->setName("test4");
$language->updateName($connectionId);


$language->delete($connectionId);
?>