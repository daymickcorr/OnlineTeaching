<?php
require_once '../Buisness/SubCategory.cls.php';
require_once '../Buisness/dbConfig.php';

$subCategory = new SubCategory();
$subCategories = $subCategory->findAll($connectionId);

echo SubCategory::header();
foreach ($subCategories as $element){
    echo $element;
}
echo SubCategory::footer();

$subCategory->setName("test");
$subCategory->setCategoryId(1);

$id = $subCategory->create($connectionId);

echo "<br/>";
echo $id;

$subCategory->setId($id);
$subCategory->setName("test2");
$subCategory->updateName($connectionId);

$subCategory->delete($connectionId);
?>