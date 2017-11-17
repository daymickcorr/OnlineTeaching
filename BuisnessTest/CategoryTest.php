<?php
require_once '../Buisness/Category.cls.php';
require_once '../Buisness/dbConfig.php';

$category = new Category();

$categories = $category->findAll($connectionId);
echo Category::header();
foreach ($categories as $element){
    echo $element;
}
echo Category::footer();

$category->setName("test");
$id  = $category->create($connectionId);
echo $id;

$category->setName("test2");
$category->setId($id);
$affectedRows = $category->updateName($connectionId);
echo "<br/>";
echo $affectedRows;

$affectedRows = $category->delete($connectionId);
echo "<br/>";
echo $affectedRows;
?>