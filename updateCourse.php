<?php include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Course.cls.php';
    require_once 'Buisness/Language.cls.php';
    require_once 'Buisness/SubCategory.cls.php';
    require_once 'Buisness/Category.cls.php';
    
    $course = new Course();
    $course->setId($_GET["id"]);
    $course = $course->findById($connectionId);
?>

<script>
$( document ).ready(function() {
document.getElementById("courseName").value = "<?php echo trim($course->getName());?>";

});
</script>

<form action="updatingCourse.php" method="get">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div>
					<h2>Course Creation</h2>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
				<div class="form-group">	
					<label>Name:</label>
					<input type="text" class="form-control" id="courseName" placeholder="Enter course name" name="courseName" required="required"/>
				</div>
				<div class="form-group">
					<label>Language:</label>
					<select class="form-control" name="courseLanguage">
						<?php 
						  $language = new Language();
						  $languages = $language->findAll($connectionId);
						  
						  foreach ($languages as $element){
						      echo "<option value='".$element->getId()."' ". (($element->getId() == $course->getLanguageId())? 'selected="selected"':'') .">".$element->getName()."</option>";
                          }
						?>
					</select>
				</div>
				<div class="form-group">
					<label>SubCategory:</label>
					<select class="form-control" name="subCategory">
					<?php

					   $subCategory =  new SubCategory();
					   $category = new Category();
					   $categories = $category->findAll($connectionId);
					   $subCategories = $subCategory->findAll($connectionId);
					   foreach ($categories as $catElement){
					       echo "<optgroup label='".$catElement->getName()."'>";
					       foreach ($subCategories as $subCatElement){
					           if ($subCatElement->getCategoryId() == $catElement->getId()){
					               //echo "<option value='".$subCatElement->getId() ."|" .$catElement->getId() ."'>".$subCatElement->getName()."</option>";
					               echo "<option value='".$subCatElement->getId()."' ".(($catElement->getId() == $course->getSubCategoryId())?'selected="selected"':'')." >".$subCatElement->getName()."</option>";
					           }
					       }
					       echo "</optgroup>";
					   }
					?>
					</select>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary" id="create" name="id" value="<?php echo $_GET["id"];?>">Update</button>
				</div>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>
</form>