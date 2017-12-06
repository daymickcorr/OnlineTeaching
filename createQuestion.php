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
?>

<style>
    .nodisplay{
        	display: none;
        }
</style>

<script>
	function Choice(obj){
    	if (obj.value == 1 || obj.value == 4){
    			$("#choice").removeClass("nodisplay");
    			$("#questionChoice1").attr("required");
    		}
    	else{
    		$("#choice").addClass("nodisplay");
    		$("#questionChoice1").removeAttr("required");
    	}
    	if(obj.value == 2){
			$("#2").removeClass("nodisplay");
			$("#2 > input").attr("disabled",false);
			$("#5").addClass("nodisplay");
			$("#5 > input:hidden").attr("disabled",true);
			$("#answer").addClass("nodisplay");
			$("#answer > input:hidden").attr("disabled",true);
        }
    	else if(obj.value == 5){
            $("#5").removeClass("nodisplay");
            $("#5 > input").attr("disabled",false);
            $("#2").addClass("nodisplay");
            $("#2 > input:hidden").attr("disabled", true);
        	$("#answer").addClass("nodisplay");
        	$("#answer > input:hidden").attr("disabled", true);
        }
        else{
    		$("#2").addClass("nodisplay");
    		$("#2 > input").attr("disabled",false);
        	$("#5").addClass("nodisplay");
        	$("#5 > input:hidden").attr("disabled", true);
        	$("#answer").removeClass("nodisplay");
        	$("#answer > input:hidden").attr("disabled", true);
        }
    	
	}
</script>

<form action="creatingQuestion.php" method="get">
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
					<label>Question Type:</label>
					<select class="form-control" name="questionType" onchange="Choice(this)">
					<?php 
					   $questionType = new QuestionType();
					   $questionTypes = $questionType->findAll($connectionId);
					   
					   foreach ($questionTypes as $questionTypeElement){
					       echo "<option value='".$questionTypeElement->getId()."'>".$questionTypeElement->getName()."</option>";
					   }
			
					?>
					</select>
				</div>
				<div class="form-group">
					<label>Question:</label>
					<input type="text" class="form-control" id="questionQuestion" placeholder="Enter question text" name="questionQuestion" required="required"/>
				</div>
				<div class="form-group">
						<label>Answer:</label>
					<div id="answer">
						<input type="text" class="form-control" id="questionAnswer" placeholder="Enter Answer text" name="questionAnswer" required="required"/>
					</div>
					<div id="2" class="nodisplay"  class="form-control">
						<input type="radio" name="questionAnswer" value="true" checked="checked" disabled="disabled">True<br/>
						<input type="radio" name="questionAnswer" value="false" disabled="disabled">False
					</div>
					<div id="5" class="nodisplay">
						<input type="number" class="form-control" name="questionAnswer" placeholder="Enter Number" disabled="disabled" required="required"/>
					</div>
				</div>
				<div class="form-group">
					<label>Points:</label>
					<input type="number" class="form-control" id="questionPoints" placeholder="Enter question Points" name="questionPoints" required="required" min="1"/>
				</div>
				<div class="form-group">
					<label>Quiz:</label>
					<select class="form-control" name="quiz">
					<?php 
					   $quiz = new Quiz();
					   
					   if(isset($_GET["quiz"])){
					       $quiz->setId($_GET["quiz"]);
					       $quiz = $quiz->findById($connectionId);
					       echo "<option value='".$quiz->getId()."'>".$quiz->getName()."</option>";
					   }
					   else{
					   
					       $quizs = $quiz->findAll($connectionId);
					  
                           foreach ($quizs as $quizElement){
                               if($quizElement->getMemberId() == $_SESSION["id"]){
                                   echo "<option value='".$quizElement->getId()."'>".$quizElement->getName()."</option>";
                               }
                           }
					                           
					   }
					   
					?>
					</select>
				</div>
				
				<div id="choice">
    				<div class="form-group">
    					<label>Choice 1:</label>
    					<input type="text" class="form-control" id="questionChoice1" placeholder="Enter Choice 1" name="questionChoice1" required="required" />
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
				</div>
				<div>
    				<div class="text-center">
    				<button type="submit" class="btn btn-primary" id="create" >Create</button>
    				</div>
    			</div>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>
</form>