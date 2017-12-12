<?php
session_start();
require_once 'Buisness/dbConfig.php';
require_once 'Buisness/QuestionByMember.cls.php';

//verify if user has already done these questions
$questionByMember = new QuestionByMember();

$questionByMembers = $questionByMember->findAll($connectionId);

foreach ($_GET as $key => $value) { 
    $value = mb_strtolower($value,'UTF-8');
    $flag=false;
    foreach ($questionByMembers as $questionByMemberElement){
        if ($questionByMemberElement->getMemberId() == $_SESSION["id"] && $questionByMemberElement->getQuestionId() == $key){
            //needs update
            
            $questionByMember->setId($questionByMemberElement->getId());
            $questionByMember->setAnswer($value);
            
            echo "in";
            echo "<br/>";
            echo "<br/>";
            echo $questionByMemberElement->getId();
            echo $questionByMember->getAnswer();
            
            if($questionByMemberElement->getAnswer() != $questionByMember->getAnswer()){$questionByMember->updateAnswer($connectionId);}
            $questionId = $questionByMemberElement->getQuestionId();
            $flag=true;
        }
    }
    // goes to creation
    if (!$flag){
        echo "out<br/>";
        $questionByMember->setMemberId($_SESSION["id"]);
        $questionByMember->setAnswer($value);
        $questionByMember->setQuestionId($key);
        
        $id = $questionByMember->create($connectionId);
        
        if($id < 1){
            echo "<br/>questionByMember creation failed<br/>";
            echo $key;
        }
        $questionId = $questionByMember->getQuestionId();
    }

}

header("Location: quizResult.php?questionId=".$questionId.""); 
?>