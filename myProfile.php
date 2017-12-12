<?php
session_start();
include "navbar.php"; ?>

<?php 
/*
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Course.cls.php';
    require_once 'Buisness/Subject.cls.php';
    require_once 'Buisness/Content.cls.php';
    require_once 'Buisness/Quiz.cls.php';
    require_once 'Buisness/ContentByMember.cls.php';
    require_once 'Buisness/QuestionByMember.cls.php';
    
    $contentByMember = new ContentByMember();
    $contentByMembers = $contentByMember->findAll($connectionId);
    
    $idx = 0;
    $usersContents[] = NULL;
    
    foreach ($contentByMembers as $contentByMemberElement){
        if ($contentByMemberElement->getMemberId() == $_SESSION["id"]){
            $usersContents[$idx++] = $contentByMemberElement;
            
        }
    }
    
    $content = new Content();
    $contents = $content->findAll($connectionId);
    
    $subject = new Subject();
    $subjects = $subject->findAll($connectionId);
    
    $course = new Course();
    $courses = $course->findAll($connectionId);
    
    $arrC = 0;
    foreach ($contents as $contentElement){
        echo "<br/>";
        echo " content: ". $contentElement->getId();
        foreach ($subjects as $subjectElement){
            if($contentElement->getSubjectId() == $subjectElement->getId()){
                echo " subject: ". $subjectElement->getId();
                foreach ($courses as $courseElement){
                    if ($subjectElement->getCourseId() == $courseElement->getId()){
                        echo " course : " . $courseElement->getId();
                        $arrCourses[$arrC++]= Array("course" => $courseElement->getId(), "subject" => $subjectElement->getId(), "content" => $contentElement->getId());
                        
                    }
                }
            }
        }
    }
    
    echo "<br/>";

 for($i = 0; $i < count($arrCourses); $i++){
     echo "<br/>";
     echo $arrCourses[$i]["content"];
     echo $arrCourses[$i]["course"];
     
 }
 */
?>

<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/ContentByMember.cls.php';
    require_once 'Buisness/Course.cls.php';
    require_once 'Buisness/Subject.cls.php';
    require_once 'Buisness/Content.cls.php';
    
    $contentByMember = new ContentByMember();
    $contentByMembers = $contentByMember->findAll($connectionId);
    
    $idx = 0; 
    
    //list of done content
    foreach ($contentByMembers as $contentByMemberElement){
        if ($contentByMemberElement->getMemberId() == $_SESSION["id"]){
            $arrContentByMember[$idx++] = $contentByMemberElement;
        }
    }
    
    function ContentsByCourseId($courseId){        
        global $connectionId;
        $idx=0;
        
        $subject = new Subject();
        $subjects = $subject->findAll($connectionId);
        
        $content = new Content();
        $contents = $content->findAll($connectionId);
        
        foreach ($subjects as $subjectElement) {
            if ($subjectElement->getCourseId() == $courseId){
                foreach ($contents as $contentElement){
                    if ($contentElement->getSubjectId() == $subjectElement->getId()){
                        $arrContentsByCourseId[$idx++] = $contentElement;
                    }
                }
            }
        }
        
        return $arrContentsByCourseId;
    }
    
    function CourseByContentsId($contentId){
        global $connectionId;
        $course = new Course();
        $courses = $course->findAll($connectionId);
        
        $subject = new Subject();
        $subjects = $subject->findAll($connectionId);
        
        $content = new Content();
        $contents = $content->findAll($connectionId);
        
        foreach($content as $contentElement){
            if ($contentElement->getId() == $contentId){
                $subject->setId($contentElement->getSubjectId());
                $subject = $subject->findById($connectionId);
                
                $course->setId($subject->getCourseId());
                $course = $course->findById($connectionId);
                
                return $course;
            }
        }
    }
    
    foreach (ContentsByCourseId(CourseByContentsId($contentId)) as $contentsElement){
    foreach ($arrContentByMember as $arrContentByMemberElement){
        $currentCourse = CourseByContentsId($arrContentByMemberElement->getContentId());
        foreach (ContentsByCourseId($currentCourse->getId()) as $contentsByCourseElement){
            echo $contentsByCourseElement;
            echo "<br/>";
            echo $contentsElement;
            echo "<br/>";
        }
    }
    }
    
?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div>
					<h2>My Profile</h2>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
			<!-- course in progress --> 
				<div>
					<label>Course in progress</label>
					
					<?php 
					
					?>
					
					<div>
						
					</div>
				</div>
			<!-- quiz in progress -->
			<!-- quiz result -->
			<!-- completed courses -->
			<!-- completed quizs -->
			</div>
		</div>
	</div>