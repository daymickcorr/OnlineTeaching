<?php 
session_start();
include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Quiz.cls.php';
    require_once 'Buisness/Question.cls.php';
    require_once 'Buisness/QuestionByMember.cls.php';
    
    //recieve question id 
    $question = new Question();
    $question->setId($_GET["questionId"]);
    $question = $question->findById($connectionId);
    
    $quiz = new Quiz();
    $quiz->setId($question->getQuizId());
    $quiz = $quiz->findById($connectionId);
    
    $questions = $question->findAll($connectionId);
    
    $questionByMember = new QuestionByMember();
    $questionByMembers = $questionByMember->findAll($connectionId);
    
    $cumulatedPoints = 0 ;
?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div>
					<h2>Quiz Result</h2>
					<h4><?php echo $quiz->getName();?></h4>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
			<div class="table-responsive">
			<h5 style='text-decoration: underline;'>Results: </h5>
			<table class="table">
				<tr style="background-color: grey; color: white;">
					<th>Points Worth</th>
					<th>Question</th>
					<th>Good Answer</th>
					<th>Your Answer</th>
				</tr>
					<?php
                        foreach ($questions as $questionElement){
                            if($questionElement->getQuizId() == $question->getQuizId()){
                                foreach ($questionByMembers as $questionByMemberElement){
                                    if ($questionByMemberElement->getMemberId() == $_SESSION["id"] && $questionElement->getId() == $questionByMemberElement->getQuestionId()){
                                        if($questionElement->getAnswer() == $questionByMemberElement->getAnswer()){$cumulatedPoints += $questionElement->getPoints();
                                            echo "<tr style='background-color: #42f450;'>";
                                        }
                                        else{
                                            echo "<tr style='background-color: #d86868;'>";
                                        }
                                        
                                        echo "<td>".$questionElement->getPoints()."</td>"; 
                                        echo "<td>".$questionElement->getQuestion()."</td>";
                                        echo "<td>".$questionElement->getAnswer()."</td>";
                                        echo "<td>".$questionByMemberElement->getAnswer()."</td>";
                                        echo "</tr>";
                                    }
                                }
                            }    
                        }
                    ?>
			</table>
			</div>
			<?php 
			echo "<h5>Total : ";
			echo $cumulatedPoints."/";
			echo $quiz->getTotal();
			echo "</h5>";
			?>
			<div class="row">
				<div class="col-sm-12" style="text-align: right;">
        			<?php 
        				echo "<h5><a style='text-decoration: none; color: inherit;' href='contentViewer.php?contentId=".$_SESSION["quizPage"]."'> Next >></a></h5>";
        			?>
				</div>
			</div>			
			</div>
    	</div>
    </div>
 