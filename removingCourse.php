<?php
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Course.cls.php';
    
    $id = $_GET["id"];
    
    $course = new Course();
    
    $course->setId($id);
    $affectedRows = $course->delete($connectionId);
    
    if($affectedRows < 1){
        echo "course removal failed! Make sure their is no associated subElements ";
        return ;
    }
    
    header('Location: courseManagement.php'); 
?>