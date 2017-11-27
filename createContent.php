<?php 
session_start();
include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Course.cls.php';
    require_once 'Buisness/Subject.cls.php';
    require_once 'Buisness/Content.cls.php';
    require_once 'Buisness/Quiz.cls.php';
?>

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
					<textarea class="form-control" rows="5"></textarea>
				</div>
				<div class="form-group">
					<label>Subject:</label>
					<select class="form-control">
						<?php 
						 $course = new Course();
						 $courses = $course->findAll($connectionId);
						 
						 $subject = new Subject();
						 $subjects = $subject->findAll($connectionId);
						 
						 foreach ($courses as $courseElement){
						     if ($courseElement->getMemberId() == $_SESSION["id"]){
						         echo "<optgroup label='".$courseElement->getName()."'>";
						         foreach ($subjects as $subjectElement){
						             if($courseElement->getId() == $subjectElement->getCourseId()){
						                 echo "<option value='".$subjectElement->getId()."'>".$subjectElement->getName()."</option>";
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
					<select class="form-control">
					<?php 
					$content = new Content();
					$contents = $content->findAll($connectionId);
					
					$quiz = new Quiz();
					$quizs = $quiz->findAll($connectionId);
					
					foreach ($courses as $courseElement){
					    if ($courseElement->getMemberId() == $_SESSION["id"]){
					       foreach ($subjects as $subjectElement){
					           if($subjectElement->getCourseId() == $courseElement->getId()){
					               foreach ($contents as $contentElement){
					                   if($contentElement->getSubjectId() == $subjectElement->getId()){
					                       foreach ($quizs as $quizElement){
					                           if($contentElement->getQuizId() == $quizElement->getId()){
					                               echo "<option value='".$quizElement->getId()."'>".$quizElement->getName()."</option>";
					                           }
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
					<button type="submit" class="btn btn-primary" id="create" >Create</button>
				</div>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>
