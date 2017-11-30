<?php
session_start();
include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Subject.cls.php';
    require_once 'Buisness/Course.cls.php';
    
    $subject = new Subject();
    $subject->setId($_GET["id"]);
    $subject = $subject->findById($connectionId);
?>

<script>
$( document ).ready(function() {
	document.getElementById("subjectName").value = "<?php echo trim($subject->getName());?>";

});
</script>

<form action="updatingSubject.php" method="get">
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
						      $courses = $course->findAll($connectionId);
						   
						      foreach($courses as $element){
						           //echo $_SESSION['id'];
						          if ($element->getMemberId() == $_SESSION["id"]){
						              echo "<option value='".$element->getId()."' ".(($element->getId() == $subject->getCourseId())? 'selected="selected"':'').">".$element->getName()."</option>";
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
					<button type="submit" class="btn btn-primary" id="create" name="id" value="<?php echo $_GET["id"]; ?>">Update</button>
				</div>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>
</form>
