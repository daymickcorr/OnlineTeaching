<?php
session_start();
include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Question.cls.php';
    require_once 'Buisness/Quiz.cls.php';
    require_once 'Buisness/Content.cls.php';
    require_once 'Buisness/Subject.cls.php';
    require_once 'Buisness/Course.cls.php';
    require_once 'Buisness/QuestionType.cls.php';
    
    $question = new Question();
    $question->setId($_GET["id"]);
    $question = $question->findById($connectionId);
?>
<script>
$( document ).ready(function() {
	document.getElementById("questionQuestion").value = "<?php echo trim($question->getQuestion());?>";
	document.getElementById("questionAnswer").value = "<?php echo trim($question->getAnswer());?>";
	document.getElementById("questionPoints").value = "<?php echo trim($question->getPoints());?>";
	document.getElementById("questionChoice1").value = "<?php echo trim($question->getChoix1());?>";
	document.getElementById("questionChoice2").value = "<?php echo trim($question->getChoix2());?>";
	document.getElementById("questionChoice3").value = "<?php echo trim($question->getChoix3());?>";
	document.getElementById("questionChoice4").value = "<?php echo trim($question->getChoix4());?>";
});
</script>
<form action="updatingQuestion.php" action="get">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div>
					<h2>Question Creation</h2>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Question:</label>
					<input type="text" class="form-control" id="questionQuestion" placeholder="Enter question text" name="questionQuestion" required="required"/>
				</div>
				<div class="form-group">
					<label>Answer:</label>
					<input type="text" class="form-control" id="questionAnswer" placeholder="Enter Answer text" name="questionAnswer" required="required"/>
				</div>
				<div class="form-group">
					<label>Points:</label>
					<input type="number" class="form-control" id="questionPoints" placeholder="Enter question Points" name="questionPoints" required="required"/>
				</div>
				<div class="form-group">
					<label>Quiz:</label>
					<select class="form-control" name="quiz">
					<?php 
					   $quiz = new Quiz();
					   
					       $quizs = $quiz->findAll($connectionId);
					   
					       $course = new Course();
					       $courses = $course->findAll($connectionId);
					   
					       $subject = new Subject();
					       $subjects = $subject->findAll($connectionId);
					   
					       $content = new Content();
					       $contents = $content->findAll($connectionId);
					   
					       foreach ($courses as $courseElement){
					           if($courseElement->getMemberId() == $_SESSION["id"]){
					               foreach ($subjects as $subjectElement){
					                   if($subjectElement->getCourseId() == $courseElement->getId()){
					                       foreach ($contents as $contentElement){
					                           if($contentElement->getSubjectId() == $subjectElement->getId()){
					                               foreach ($quizs as $quizElement){
					                                   if($quizElement->getId() == $contentElement->getQuizId()){
					                                       echo "<option value='".$quizElement->getId()."' ".(($question->getQuizId() == $quizElement->getId())?'selected="selected"':'').">".$quizElement->getName()."</option>";
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
				<div class="form-group">
					<label>Question Type:</label>
					<select class="form-control" name="questionType">
					<?php 
					   $questionType = new QuestionType();
					   $questionTypes = $questionType->findAll($connectionId);
					   
					   foreach ($questionTypes as $questionTypeElement){
					       echo "<option value='".$questionTypeElement->getId()."' ".(($question->getQuestionTypeId() == $questionTypeElement->getId())?'selected="selected"':'').">".$questionTypeElement->getName()."</option>";
					   }
			
					?>
					</select>
				</div>
				<div class="form-group">
					<label>Choice 1:</label>
					<input type="text" class="form-control" id="questionChoice1" placeholder="Enter Choice 1" name="questionChoice1" />
				</div>
				<div class="form-group">
					<label>Choice 2:</label>
					<input type="text" class="form-control" id="questionChoice2" placeholder="Enter Choice 2" name="questionChoice2" />
				</div>
				<div class="form-group">
					<label>Choice 3:</label>
					<input type="text" class="form-control" id="questionChoice3" placeholder="Enter Choice 3" name="questionChoice3" />
				</div>
				<div class="form-group">
					<label>Choice 4:</label>
					<input type="text" class="form-control" id="questionChoice4" placeholder="Enter Choice 4" name="questionChoice4" />
				</div>
				<div>
					<div class="text-center">
					<button type="submit" class="btn btn-primary" id="create" name="id" value="<?php echo $_GET["id"];?>" >Update</button>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>
</form>