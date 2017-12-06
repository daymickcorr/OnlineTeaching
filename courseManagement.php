<?php 
session_start();
include "navbar.php"; ?>
<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Course.cls.php';
    require_once 'Buisness/Subject.cls.php';
    require_once 'Buisness/Content.cls.php';
    require_once 'Buisness/Quiz.cls.php';
    require_once 'Buisness/Media.cls.php';
    require_once 'Buisness/Question.cls.php';
?>

<style>
#orgView ul, #navul ul{
border-left: 2px solid black;
border-top: 1px dotted black;
}
#orgView li, #nav li{
   list-style-type: none;
   cursor:pointer;
}
#nav li:before{
content: "\f055";
font-family: FontAwesome;
display: inline-block;
margin-left: -1.3em; 
width: 1.3em; 

}

#nav li.plus:before {
content: "\f056";
font-family: FontAwesome;
display: inline-block;
margin-left: -1.3em; 
width: 1.3em; 
}

.hide{
display:none;
}
</style>

<script>
$( document ).ready(function() {
	$(".first").parent().find('ul').slideToggle(200);
	//$(".first").addClass("plus");
});



function tree(obj){
	//alert("test")
	//alert($(obj).parent().children('ul').index());
	//var obj2 = $(obj)
	//var selectedIndex = $(obj).index());
	$(obj).parent().children('ul').slideToggle(200);
	//$(obj).parent().children('ul').slideToggle(200);
	$(obj).toggleClass("plus");
}

 
</script>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div>
					<h2>Course Management</h2>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 ">
				<div id="orgView">
					<h6>New:</h6>
					<ul>
						<li>
						<a href='createCourse.php'> Course</a>
						<ul>
							<li>
							<a href='createSubject.php'> Subject</a>
							<ul>
								<li>
								<a href='createContent.php'> Content</a>
								<ul>
									<li>
									<a href='addMedia.php'> Media</a>
									</li>
									<li>
									<a href='createQuiz.php'> Quiz</a>
									<ul>
										<li>
										<a href='createQuestion.php'> Question </a>
										</li>
									</ul>
									</li>
								</ul>
								</li>
							</ul>
							</li>
						</ul>
						</li>
					</ul>
				</div>
				<div id="navul">
					<h6>Existing:</h6>
					<ul id="nav">
						<?php 
						  $course = new Course();
						  $courses = $course->findAll($connectionId);
						  
						  $subject = new Subject();
						  $subjects = $subject->findAll($connectionId);
						  
						  $content = new Content();
						  $contents = $content->findAll($connectionId);
						  
						  $media = new Media();
						  $medias = $media->findAll($connectionId);
						  
						  $quiz = new Quiz();
						  $quizs = $quiz->findAll($connectionId);
						  
						  $question = new Question();
						  $questions = $question->findAll($connectionId);
						  
						  
						  
						  foreach ($courses as $courseElement){
						      if($courseElement->getMemberId() == $_SESSION["id"]){
						          echo "<li class='first' onclick='tree(this)'>".$courseElement->getName()."</li>";
						          echo "<a href='createCourse.php'> create</a>";
						          echo "<a href='removingCourse.php?id=".$courseElement->getId()."'> remove</a>";
						          echo "<a href='updateCourse.php?id=".$courseElement->getId()."'> update</a>";
						          echo "<ul>";
						          foreach ($subjects as $subjectElement){
						              if($subjectElement->getCourseId() ==  $courseElement->getId()){
						                  echo "<li onclick='tree(this)'>".$subjectElement->getName()."</li>";
						                  echo "<a href='createSubject.php?course=".$courseElement->getId()."'> create</a>";
						                  echo "<a href='removingSubject.php?id=".$subjectElement->getId()."'> remove</a>";
						                  echo "<a href='updateSubject.php?id=".$subjectElement->getId()."'> update</a>";
						                  echo "<ul>";
						                  foreach ($contents as $contentElement){
						                      if ($contentElement->getSubjectId() == $subjectElement->getId()){
						                          echo "<li onclick='tree(this)'>".$contentElement->getName()."</li>";
						                          echo "<a href='createContent.php?subject=".$subjectElement->getId()."'> create</a>";
						                          echo "<a href='removingContent.php?id=".$contentElement->getId()."'> remove</a>";
						                          echo "<a href='updateContent.php?id=".$contentElement->getId()."'> update</a>";
						                          echo "<ul>";
						                          foreach ($medias as $mediaElement){
						                              if($mediaElement->getContentId() == $contentElement->getId()){
						                                  echo "<li onclick='tree(this)'>".$mediaElement->getName()."</li>";
						                                  echo "<a href='addMedia.php?content=".$contentElement->getId()."'> add</a>";
						                                  echo "<a href='removingMedia.php?id=".$mediaElement->getId()."'> remove</a>";
						                                  echo "<a href='updateMedia.php?id=".$mediaElement->getId()."'> update</a>";
						                              }
						                          }
						                          echo "</ul>";
						                          echo "<ul>";
						                          foreach ($quizs as $quizElement){
						                              if($quizElement->getId() == $contentElement->getQuizId()){
						                                  echo "<li onclick='tree(this)'>".$quizElement->getName()."</li>";
						                                  echo "<a href='createQuiz.php".$contentElement->getId()."'> create</a>";
						                                  echo "<a href='removingQuiz.php?id=".$quizElement->getId()."&contentId=".$contentElement->getId()."'> remove</a>";
						                                  echo "<a href='updateQuiz.php?id=".$quizElement->getId()."'> update</a>";
						                                  echo "<ul>";
						                                      foreach ($questions as $questionElement){
						                                          if ($questionElement->getQuizId() == $quizElement->getId()){
						                                              echo "<li onclick='tree(this)'>".$questionElement->getQuestion()."</li>";
						                                              echo "<a href='createQuestion.php?quiz=".$quizElement->getId()."'> create</a>";
						                                              echo "<a href='removingQuestion.php?id=".$questionElement->getId()."'> remove</a>";
						                                              echo "<a href='updateQuestion.php?id=".$questionElement->getId()."'> update</a>";
						                                          }
						                                      }
						                                  echo "</ul>";
						                              }
						                          }
						                          echo "</ul>";
						                      }
						                  }
						                  echo "</ul>";
						              }
						          }
			                      echo "</ul>";
						      }
						  }
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>