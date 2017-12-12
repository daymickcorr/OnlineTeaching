<?php include "navbar.php"; ?>

<style>
.responsive-card{
  width: 18rem;
  float: left;
  margin-left: 1rem;
  margin-right: 1rem;
  margin-top: 2rem;
}

.card-link {
    text-decoration: none;
    color: inherit;
}

</style>

<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Course.cls.php';
    require_once 'Buisness/SubCategory.cls.php';
    require_once 'Buisness/Category.cls.php';
    
    require_once 'Buisness/Subject.cls.php';
    require_once 'Buisness/Content.cls.php';
    
    $subject = new Subject();
    $subjects = $subject->findAll($connectionId);
    
    $content = new Content();
    $contents = $content->findAll($connectionId);
    
    
    $course = new Course();
    $subCategory = new SubCategory();
    $category = new Category();

    //verify if valid course
    $idx = -1;
    foreach ($course->findAll($connectionId) as $element){
        $arr[++$idx] = 0;
        foreach ($subjects as $subjectElement){
            if($element->getId() == $subjectElement->getCourseId()){
                $idx2 = 0;
                foreach ($contents as $contentElement){
                    if ($contentElement->getSubjectId() == $subjectElement->getId()){
                        $arr[$idx] = 1;
                    }
                }
            }
        }
        
        //make cards in responsive grid 
        if($arr[$idx] > 0){
            echo "<a class='card-link' href=courseOverview.php?id=".$element->getId().">";
            echo "<div class='card responsive-card'>";
            
            $subCategory->setId($element->getSubCategoryId());
            $subCategory = $subCategory->findById($connectionId);
        
            echo "<img  style='background-color:grey; color: white; text-align:center;' class='card-img-top' src='".$subCategory->getImagePath()."' alt='No Image'>";
            //echo "<p class='card-img-top' style='background-color:grey; color: white; text-align:center;'>No Image</p>";
            echo "<hr style='margin: 0px;'/>";
            
            echo "<div class='card-block'>";
            echo "<div class='card-body'>";
        
            echo "<h4 class='card-title'>".$element->getName()."</h4>";
        
            echo "<h6 class='card-subtitle'>".$subCategory->getName()."</h6>";
        
            $category->setId($subCategory->getCategoryId());
            $category = $category->findById($connectionId);
            echo "<p class='card-text'>".$category->getName()."</p>";
        
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
            }
        }
    
    
?>