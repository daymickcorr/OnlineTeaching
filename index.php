<?php include "navbar.php"; ?>

<style>
.responsive-card{
  width: 18rem;
  float: left;
  margin-left: 1rem;
  margin-right: 1rem;
  margin-top: 2rem;
}
</style>

<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Course.cls.php';
    require_once 'Buisness/SubCategory.cls.php';
    require_once 'Buisness/Category.cls.php';
    
    $course = new Course();
    $subCategory = new SubCategory();
    $category = new Category();

    //make cards in responsive grid 
    foreach ($course->findAll($connectionId) as $element){
        echo "<div class='responsive-card'>";
            echo "<div class='card'>";
                
                //echo "<img class='card-img-top' src='...' alt='Card image cap'>";
                echo "<p class='card-img-top' style='background-color:grey; color: white; text-align:center;'>No Image</p>";  
            
                    echo "<div class='card-block'>";
                        echo "<div class='card-body'>";

                            echo "<h4 class='card-title'>".$element->getName()."</h4>";

                            $subCategory->setId($element->getSubCategoryId());
                            $subCategory = $subCategory->findById($connectionId);

                            echo "<h6 class='card-subtitle'>".$subCategory->getName()."</h6>";

                            $category->setId($subCategory->getCategoryId());
                            $category = $category->findById($connectionId);
                            echo "<p class='card-text'>".$category->getName()."</p>";

                        echo "</div>";
                    echo "</div>";
            echo "</div>";
        echo "</div>";
    }
    
?>