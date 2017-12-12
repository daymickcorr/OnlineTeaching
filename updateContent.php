<?php
session_start();
include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Course.cls.php';
    require_once 'Buisness/Subject.cls.php';
    require_once 'Buisness/Content.cls.php';
    require_once 'Buisness/Quiz.cls.php';
    
    $cContent = new Content();
    $cContent->setId($_GET["id"]);
    $cContent = $cContent->findById($connectionId);
?>

<script>
$( document ).ready(function() {
	document.getElementById("contentName").value = "<?php echo trim($cContent->getName());?>";
	document.getElementById("contentText").value = "<?php echo trim(addslashes($cContent->getText()));?>";
	
});
</script>

<form action="updatingContent.php" method="post">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div>
					<h2>Content Creation</h2>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
				<div class="form-group">	
					<label>Name:</label>
					<input type="text" class="form-control" id="contentName" placeholder="Enter content name" name="contentName" required="required"/>
				</div>
				<div class="form-group">
					<label>Text:</label>
					<textarea class="form-control" rows="5" id="contentText" name="contentText"></textarea>
				</div>
				<div class="form-group">
					<label>Subject:</label>
					<select class="form-control" name="contentSubject">
						<?php 
						      $subject = new Subject();
						 
						      $course = new Course();
						      $courses = $course->findAll($connectionId);
						 
						 
						      $subjects = $subject->findAll($connectionId);
						 
						      foreach ($courses as $courseElement){
						          if ($courseElement->getMemberId() == $_SESSION["id"]){
						              echo "<optgroup label='".$courseElement->getName()."'>";
						              foreach ($subjects as $subjectElement){
						                  if($courseElement->getId() == $subjectElement->getCourseId()){
						                      echo "<option value='".$subjectElement->getId()."' ".(($subjectElement->getId() == $cContent->getSubjectId())? 'selected="selected"':'').">".$subjectElement->getName()."</option>";
						                  }
						              }
						              echo "</optgroup>";
						          }
						      }
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Quiz:</label>
					<select class="form-control" name="contentQuiz">
					<option></option>
					<?php 
					
					$quiz = new Quiz();
					$quizs = $quiz->findAll($connectionId);

                       foreach ($quizs as $quizElement){
                           if($quizElement->getMemberId() == $_SESSION["id"]){
                               echo "<option value='".$quizElement->getId()."' ".(($quizElement->getId() == $cContent->getSubjectId())?'selected="selected"':'').">".$quizElement->getName()."</option>";
                           }
                       }   
					                  
					?>
					</select>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary" id="create" name="id" value="<?php echo $_GET["id"];?>" >Update</button>
				</div>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>
</form>