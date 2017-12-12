<?php 
session_start();
include "navbar.php"; ?>

<?php 
    require_once 'Buisness/dbConfig.php';
    require_once 'Buisness/Course.cls.php';
    require_once 'Buisness/Subject.cls.php';
    require_once 'Buisness/Content.cls.php';
    require_once 'Buisness/Media.cls.php';
    require_once 'Buisness/Quiz.cls.php';

    
    $_SESSION["quizPage"] = $_GET["contentId"];
    
    if (isset($_SESSION["id"])){
        if ($_SESSION["id"]>0){
            require_once 'Buisness/ContentByMember.cls.php';
            $contentByMember = new ContentByMember();
            
            $contentByMembers = $contentByMember->findAll($connectionId);
            
            $phpdate = strtotime("now");
            $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
            
            $flag = false;
            foreach ($contentByMembers as $contentByMemberElement){
                if ($contentByMemberElement->getMemberId() == $_SESSION["id"] && $contentByMemberElement->getContentId() == $_GET["contentId"]){
                    //you have already seen this page 
                    $flag = true;
                    $contentByMemberElement->setDate($mysqldate);
                    $contentByMemberElement->updateDate($connectionId);
                }
            }
            
            if(!$flag){
                $contentByMember->setContentId($_GET["contentId"]);
                $contentByMember->setDate($mysqldate);
                $contentByMember->setMemberId($_SESSION["id"]);
                $contentByMember->create($connectionId);
            }
            
        }
    }
?>

<?php 
    //where am i 
    
    $content = new Content();
    $content->setId($_GET["contentId"]);
    $content = $content->findById($connectionId);
    
    $subject = new Subject();
    $subject->setId($content->getSubjectId());
    $subject = $subject->findById($connectionId);
    
    $course = new Course();
    $course->setId($subject->getCourseId());
    $course = $course->findById($connectionId);
    
    $contents = $content->findAll($connectionId);
    
    $idx = 0;
    foreach ($contents as $contentElement){
        if ($contentElement->getSubjectId() == $subject->getId()){
            $arr[$idx++] = $contentElement->getId();
        }
    }
    
    //where are we compared to total number of contents for the subject
    $position = array_search($content->getId(), $arr);
    $total = count($arr);
    
    /*
    echo "<br/>";
    echo ($position)+1;
    echo "<br/>";
    echo $total;
    */
?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div>
					<h2><?php echo $content->getName();?></h2>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<p><?php echo $content->getText();?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 mx-auto text-center">
				<?php 
				    $mediaTypes = array(array(0 => '.mp4','.webm','.ogg'), array(1 => '.mp3','.wav'), array (2=> '.gif', '.jpg', '.png', '.svg'));
				    
				    
				    $media = new Media();
				    $medias = $media->findAll($connectionId);
				    
				    foreach ($medias as $mediaElement){
				        if($mediaElement->getContentId() == $content->getId()){
				            foreach ($mediaTypes as $key => $valArr){
				                foreach ($valArr as $valKey => $val){
				                    if ($mediaElement->getType() == $val){
				                    
				                        switch($key){
				                            case 0:{
				                                    switch($val){
				                                        case '.mp4':{
				                                            echo "<video style='max-width: calc(100% - 20px);' controls><source type='video/mp4'  src='".$mediaElement->getPath()."'>Video Not Supported By Your Browser</video>";
				                                        }break;
				                                        case '.webm':{
				                                            echo "<video style='max-width: calc(100% - 20px);' controls><source type='video/webm' src='".$mediaElement->getPath()."'>Video Not Supported By Your Browser</video>";
				                                        }break;
				                                        case '.ogg':{
				                                            echo "<video style='max-width: calc(100% - 20px);' controls><source type='video/ogg' src='".$mediaElement->getPath()."'>Video Not Supported By Your Browser</video>";
				                                        }break;
				                                    }
				                            }break;
				                            case 1:{
				                                    switch($val){
				                                        case '.mp3':{
				                                            echo "<audio style='max-width: calc(100% - 20px);' controls><source type='audio/mpeg' src='".$mediaElement->getPath()."'>Audio Not Supported By Your Browser</audio>";
				                                        }break;
				                                        case '.wav':{
				                                            echo "<audio style='max-width: calc(100% - 20px);' controls><source type='audio/wav' src='".$mediaElement->getPath()."'>Audio Not Supported By Your Browser</audio>";
				                                        }break;
				                                    }
				                            }break;
				                            case 2:{
				                                echo "<img src='".$mediaElement->getPath()."' alt='Media not found' style='max-width: calc(100% - 20px);'/>";
				                            }break;
				                        }
				                    }
				                }
				            }
				        }
				    }
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<?php 
				    if(null !== $content->getQuizId()){
				        $quiz = new Quiz();
				        $quiz->setId($content->getQuizId());
				        $quiz = $quiz->findById($connectionId);
				        echo "<b><label>Available Quiz:</label></b><br/>";
				        echo "<a href='quizViewer.php?id=".$quiz->getId()."'>".$quiz->getName()."</a>";
				        
				    }
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12" style="text-align: right;">
				<?php 
				    if (($position)+1 == $total ){
				        //finished all content of this subject
				        $subjects = $subject->findAll($connectionId);
				        $arrIdx = 0;
				        foreach ($subjects as $subjectElement){
				            if ($subjectElement->getCourseId() == $course->getId()){
				                $subArr[$arrIdx++] = $subjectElement->getId();
				            }
				        }
				        
				        $subPosition = array_search($subject->getId(), $subArr);
				        $subTotal = count($subArr);
				        
				        if(($subPosition)+1 == $subTotal){
				            echo "<h5><a style='text-decoration: none; color: inherit;' href='index.php'>End Of Course >></a></h5>";
				        }
				        else{
				            //next subject content
				            $subject->setId($subArr[($subPosition)+1]);
				            $subject = $subject->findById($connectionId);
				            
				            foreach ($contents as $contentElement){
				                if ($contentElement->getSubjectId() == $subject->getId()){
				                    echo "<h5><a style='text-decoration: none; color: inherit;' href='contentViewer.php?contentId=".$contentElement->getId()."'>Next Subject >></a></h5>";
				                    break;
				                }
				            } 
				            
				        }
				    }
				    else{
				        //next content 
				        echo "<h5><a style='text-decoration: none; color: inherit;' href='contentViewer.php?contentId=".$arr[($position)+1]."'>Next >></a></h5>";
				    }
				?>
			</div>
		</div>
	</div>