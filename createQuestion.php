<?php include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Question.cls.php';
?>
<!-- <form action="creatingQuestion.php" action="get"> -->
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
				</div>
				<div class="form-group">
					<label>Question Type:</label>
				</div>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>
<!-- </form> -->