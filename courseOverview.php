<?php include "navbar.php"; ?>

<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Course.cls.php';
    require_once 'Buisness/Subject.cls.php';
    require_once 'Buisness/Content.cls.php';
?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div>
					<h2>Course Overview</h2>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<ul>
				<?php 
				    $course = new Course();
				    $course->setId($_GET["id"]);
				    $course = $course->findById($connectionId);
				    
				    echo "<li>".$course->getName();
				    
				    $subject = new Subject();
				    $subjects = $subject->findAll($connectionId);
				    
				    $content = new Content();
				    $contents = $content->findAll($connectionId);
				    echo "<ul>";
				    foreach ($subjects as $subjectElement){
				        if($subjectElement->getCourseId() == $course->getId()){
				            echo "<li>" .$subjectElement->getName();
				            echo "<ul>";
				            foreach ($contents as $contentElement){
				                if($contentElement->getSubjectId() == $subjectElement->getId()){
				                    echo "<li>";
				                    echo "<a href='contentViewer.php?contentId=".$contentElement->getId()."'>".$contentElement->getName()."</a>";
				                    echo "</li>";
				                }
				            }
				            echo "</ul>";
				            echo "</li>";
				        }
				    }
				    echo "</ul>";
				    
				    echo "</li>";
				?>
				</ul>
			</div>
		</div>
	</div>
