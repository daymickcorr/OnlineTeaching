<?php 
session_start();
include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Subject.cls.php';
    require_once 'Buisness/Course.cls.php';
?>

<form action="creatingSubject.php" method="get">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div>
					<h2>Subject Creation</h2>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Course:</label>
					<select class="form-control" name="course">
						<?php 
						   $course = new Course();
						   
						   if(isset($_GET["course"])){
						          $course->setId($_GET["course"]);
						          $course = $course->findById($connectionId);
						          echo "<option value='".$course->getId()."'>".$course->getName()."</option>";
						          
						   }
						   else{
						   
						      $courses = $course->findAll($connectionId);
						   
						      foreach($courses as $element){
						           //echo $_SESSION['id'];
						          if ($element->getMemberId() == $_SESSION["id"]){
					                   echo "<option value='".$element->getId()."'>".$element->getName()."</option>";
						          }
                              }
						   }
						   
					    ?>
					</select>
				</div>
				<div class="form-group">	
					<label>Name:</label>
					<input type="text" class="form-control" id="subjectName" placeholder="Enter subject name" name="subjectName" required="required"/>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary" id="create" >Create</button>
				</div>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>
</form>
