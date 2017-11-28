<?php 
session_start();
include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Quiz.cls.php';
    require_once 'Buisness/Subject.cls.php';
    require_once 'Buisness/Course.cls.php';
    require_once 'Buisness/Content.cls.php';
?>

<script>
	function displayValue(obj){
		document.getElementById("path").innerHTML = obj.value;
		$("#browse").removeClass("required");
	}

	function validateCreation(){
		if (document.getElementById("path").innerHTML == "" ){
			$("#browse").addClass("required");
			$("#browse").focus();
			return false;
		}
	}
</script>

<form method = 'post' action = 'fileUpload.php' enctype = 'multipart/form-data'>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div>
					<h2>Add Media</h2>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
				<div>	
					<div style="word-wrap: break-word;">
						<span id="path"></span>
					</div>
    				<label id="browse" class="btn btn-basic form-control" style="background-color: grey; color: white;">
    					Browse Media <input type="file" style="display: none;" name="media" onchange="displayValue(this)">
					</label>
    			</div>
				<div class="form-group">	
					<label>Name:</label>
					<input type="text" class="form-control" id="mediaName" placeholder="Enter media name" name="mediaName" required="required"/>
				</div>
				<div class="form-group">
					<label>Content:</label>
					<select name="content" required="required" class="form-control">
					<?php 
					   $content = new Content();
					   
					   if(isset($_GET["content"])){
					       $content->setId($_GET["content"]);
					       $content = $content->findById($connectionId);
					       echo "<option value='".$content->getId()."'>".$content->getName()."</option>";
					   }
					   else{
					       
					       $course = new Course();
					       $courses = $course->findAll($connectionId);
				        
					       $subject = new Subject();
					       $subjects = $subject->findAll($connectionId);
					   
					   
					       $contents = $content->findAll($connectionId);
					   
					   
					       foreach ($courses as $courseElement){
					           if($courseElement->getMemberId() == $_SESSION["id"]){
					               foreach ($subjects as $subjectElement){
					                   if ($subjectElement->getCourseId() == $courseElement->getId()){
					                       foreach ($contents as $contentElement){
					                           if($contentElement->getSubjectId() == $subjectElement->getId()){
					                               echo "<option value='".$contentElement->getId()."'>".$contentElement->getName()."</option>";
					                           }
					                       }
					                   }
					               }
					           }
					       }  
					   }
					?>
					</select>
				</div>
				<div class="text-center">
						<button type="submit" class="btn btn-primary" id="create" name="submit" value="" onclick="return validateCreation()">Add</button>
				</div>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>
</form>