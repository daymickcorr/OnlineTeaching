<?php include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Quiz.cls.php';
    $quiz = new Quiz();
    $quiz->setId($_GET["id"]);
    $quiz = $quiz->findById($connectionId);
?>
<script>
$( document ).ready(function() {
	document.getElementById("quizName").value = "<?php echo trim($quiz->getName());?>";
	document.getElementById("quizTotal").value = "<?php echo trim($quiz->getTotal());?>";
});
</script>
<form action="creatingQuiz.php" action="get">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div>
					<h2>Quiz Creation</h2>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
				<div class="form-group">	
					<label>Name:</label>
					<input type="text" class="form-control" id="quizName" placeholder="Enter quiz name" name="quizName" required="required"/>
				</div>
				<div class="form-group">
					<label>Quiz Total:</label>
					<input type="number" class="form-control" id="quizTotal" name="quizTotal" placeholder="Enter quiz total" min="1" required="required"/>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary" id="create" name="id" value="<?php echo $quiz->getId();?>>">Update</button>
				</div>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>
</form>