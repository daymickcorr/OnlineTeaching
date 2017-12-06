<?php include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Quiz.cls.php';
?>
<form action="creatingQuiz.php" method="get">
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
					<input type="number" class="form-control" name="quizTotal" placeholder="Enter quiz total" min="1" required="required"/>
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