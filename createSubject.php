<?php 
session_start();
include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Subject.cls.php';
    require_once 'Buisness/Course.cls.php';
?>

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
					<select name="course">
						<?php 
						   $course = new Course();
						   $courses = $course->findAll($connectionId);
						   
						   foreach($courses as $element){
						       //echo $_SESSION['id'];
						       if ($element->getMemberId() == $_SESSION["id"]){
					               echo "<option value='".$element->getId()."'>".$element->getName()."</option>";
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

