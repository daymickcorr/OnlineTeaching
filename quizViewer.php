<?php 
session_start();
include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Quiz.cls.php';
    require_once 'Buisness/Question.cls.php';
    
    if ($_SESSION["id"]<1){echo "You must be signed in to pass the quizs!"; return;}
    
?>
<?php 
    $quiz = new Quiz;
    $quiz->setId($_GET["id"]);
    $quiz = $quiz->findById($connectionId);
    
    $question = new Question();
    $questions = $question->findAll($connectionId);
?>

<form action="quizValidation.php" method="get">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div>
					<h2><?php echo $quiz->getName();?></h2>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
                <?php 
                    foreach ($questions as $questionElement){
                        if($questionElement->getQuizId() == $quiz->getId()){
                            echo "<div class='form-group'>";
                            echo "<label>".$questionElement->getQuestion()." -     " . $questionElement->getPoints()." Points</label>";
                            switch($questionElement->getQuestionTypeId()){
                                case 1:{
                                    echo "<select class='form-control' required='required' name='".$questionElement->getId()."'>";
                                        if (null !==($questionElement->getChoix1())){echo "<option value='".$questionElement->getChoix1()."'>".$questionElement->getChoix1()."</option>";}
                                        if (null !==($questionElement->getChoix2())){echo "<option value='".$questionElement->getChoix2()."'>".$questionElement->getChoix2()."</option>";}
                                        if (null !==($questionElement->getChoix3())){echo "<option value='".$questionElement->getChoix3()."'>".$questionElement->getChoix3()."</option>";}
                                        if (null !==($questionElement->getChoix4())){echo "<option value='".$questionElement->getChoix4()."'>".$questionElement->getChoix4()."</option>";}
                                    echo "</select>";
                                }
                                    break;
                                case 2:{
                                    echo "<div class='form-control'>";
                                    echo "<input type='radio' required='required' name='".$questionElement->getId()."' value='true' text='true'>True<br/>";
                                    echo "<input type='radio' required='required' name='".$questionElement->getId()."' value='false' text='false'>False";
                                    echo "</div>";
                                }
                                    break;
                                case 3:{
                                    echo "<input class='form-control' required='required' type='text' name='".$questionElement->getId()."' placeholder='Enter answer here'>";
                                }
                                    break;
                                case 4:{
                                    echo "<div class='form-control'>";
                                    if (null !==($questionElement->getChoix1())){echo "<input type='radio' required='required' name='".$questionElement->getId()."' value='".$questionElement->getChoix1()."'>".$questionElement->getChoix1()."</input><br/>";}
                                    if (null !==($questionElement->getChoix2())){echo "<input type='radio' required='required' name='".$questionElement->getId()."' value='".$questionElement->getChoix2()."'>".$questionElement->getChoix2()."</input><br/>";}
                                    if (null !==($questionElement->getChoix3())){echo "<input type='radio' required='required' name='".$questionElement->getId()."' value='".$questionElement->getChoix3()."'>".$questionElement->getChoix3()."</input><br/>";}
                                    if (null !==($questionElement->getChoix4())){echo "<input type='radio' required='required' name='".$questionElement->getId()."' value='".$questionElement->getChoix4()."'>".$questionElement->getChoix4()."</input>";}
                                    echo "</div>";
                                }
                                    break;
                                case 5:{
                                    echo "<input class='form-control' type='number' required='required' name='".$questionElement->getId()."'/>";
                                }
                                    break;
                            }
                            echo "</div>";
                        }
                    }
                ?>
			</div>
		</div>
		<div class="text-center">
			<button type="submit" class="btn btn-primary" >Submit</button>
		</div>
	</div>
</form>