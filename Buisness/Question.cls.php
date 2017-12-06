<?php

class Question
{
    private $id;
    private $question;
    private $answer;
    private $points;
    private $quizId;
    private $questionTypeId;
    private $choix1;
    private $choix2;
    private $choix3;
    private $choix4;
    
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return the $answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @return the $points
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @return the $quizId
     */
    public function getQuizId()
    {
        return $this->quizId;
    }

    /**
     * @return the $questionTypeId
     */
    public function getQuestionTypeId()
    {
        return $this->questionTypeId;
    }

    /**
     * @return the $choix1
     */
    public function getChoix1()
    {
        return $this->choix1;
    }

    /**
     * @return the $choix2
     */
    public function getChoix2()
    {
        return $this->choix2;
    }

    /**
     * @return the $choix3
     */
    public function getChoix3()
    {
        return $this->choix3;
    }

    /**
     * @return the $choix4
     */
    public function getChoix4()
    {
        return $this->choix4;
    }

    
    
    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @param string $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    /**
     * @param string $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * @param string $quizId
     */
    public function setQuizId($quizId)
    {
        $this->quizId = $quizId;
    }

    /**
     * @param string $questionTypeId
     */
    public function setQuestionTypeId($questionTypeId)
    {
        $this->questionTypeId = $questionTypeId;
    }

    /**
     * @param string $choix1
     */
    public function setChoix1($choix1)
    {
        $this->choix1 = $choix1;
    }

    /**
     * @param string $choix2
     */
    public function setChoix2($choix2)
    {
        $this->choix2 = $choix2;
    }

    /**
     * @param string $choix3
     */
    public function setChoix3($choix3)
    {
        $this->choix3 = $choix3;
    }

    /**
     * @param string $choix4
     */
    public function setChoix4($choix4)
    {
        $this->choix4 = $choix4;
    }

    function __construct($id=NULL,$question=NULL,$answer=NULL,$points=NULL,$quizId=NULL,$questionTypeId=NULL,
        $choix1=NULL,$choix2=NULL,$choix3=NULL,$choix4=NULL){
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
        $this->points = $points;
        $this->quizId = $quizId;
        $this->questionTypeId = $questionTypeId;
        $this->choix1 = $choix1;
        $this->choix2 = $choix2;
        $this->choix3 = $choix3;
        $this->choix4 = $choix4;
    }
    
    static function header(){
        return "<table><tr><th>Id</th><th>Question</th><th>Answer</th><th>Points</th><th>Quiz Id</th><th>Question Type Id</th>
        <th>Choice 1</th><th>Choice 2</th><th>Choice 3</th><th>Choice 4</th></tr>";    
    }
    
    static function footer(){
        return "</table>";
    }
    
   function __toString(){
       return "<tr><td>$this->id</td><td>$this->question</td><td>$this->answer</td><td>$this->points</td><td>$this->quizId</td><td>$this->questionTypeId</td>
        <td>$this->choix1</td><td>$this->choix2</td><td>$this->choix3</td><td>$this->choix4</td></tr>";
   }
   
   function create($connectionId){
        $affectedRows = $connectionId->exec("insert into question (pk_question_id,question_question,question_answer,question_points,fk_quiz_id,fk_questionType_id,question_choix1,question_choix2,question_choix3,question_choix4)
         values ('','$this->question','$this->answer','$this->points',$this->quizId,$this->questionTypeId,'$this->choix1','$this->choix2','$this->choix3','$this->choix4')");
        return $connectionId->lastInsertId();
   }
   
   function createNoMultiple($connectionId){
       $affectedRows = $connectionId->exec("insert into question (pk_question_id,question_question,question_answer,question_points,fk_quiz_id,fk_questionType_id)
       values ('','$this->question','$this->answer','$this->points',$this->quizId,$this->questionTypeId)");
       return $connectionId->lastInsertId();
   }
   
   function updateQuestion($connectionId){
        $affectedRows = $connectionId->exec("update question set question_question = '$this->question' where pk_question_id = $this->id ");
        return $affectedRows;
   }
   
   function updateAnswer($connectionId){
        $affectedRows = $connectionId->exec("update question set question_answer = '$this->answer' where pk_question_id = $this->id");
        return $affectedRows;
   }
   
   function updatePoints($connectionId){
        $affectedRows = $connectionId->exec("update question set question_points = $this->points where pk_question_id = $this->id");
        return $affectedRows;
   }
   
   function updateQuizId($connectionId){
        $affectedRows = $connectionId->exec("update question set fk_quiz_id = $this->quizId where pk_question_id = $this->id");
        return $affectedRows;
   }
   
   function updateQuestionTypeId($connectionId){
       $affectedRows = $connectionId->exec("update question set fk_questionType_id = $this->questionTypeId where pk_question_id = $this->id");
       return $affectedRows;
   }
   
   function updateChoix1($connectionId){
        $affectedRows = $connectionId->exec("update question set question_choix1 = '$this->choix1' where pk_question_id = $this->id");
        return $affectedRows;
   }
   
   function updateChoix2($connectionId){
       $affectedRows = $connectionId->exec("update question set question_choix2 = '$this->choix2' where pk_question_id = $this->id");
       return $affectedRows;
   }
   
   function updateChoix3($connectionId){
        $affectedRows = $connectionId->exec("update question set question_choix3 = '$this->choix3' where pk_question_id = $this->id");
        return $affectedRows;
   }
   
   function updateChoix4($connectionId){
        $affectedRows = $connectionId->exec("update question set question_choix4 = '$this->choix4' where pk_question_id = $this->id");
        return $affectedRows;
   }
   
   function delete($connectionId){
       $affectedRows = $connectionId->exec("delete from question where pk_question_id = $this->id");
       return $affectedRows;
   }
   
   function findAll($connectionId){
        $idx=0;
        foreach($connectionId->query("select * from question") as $row){
            $question = new Question();
            $question->setId($row["pk_question_id"]);
            $question->setQuestion($row["question_question"]);
            $question->setAnswer($row["question_answer"]);
            $question->setPoints($row["question_points"]);
            $question->setQuizId($row["fk_quiz_id"]);
            $question->setQuestionTypeId($row["fk_questionType_id"]);
            $question->setChoix1($row["question_choix1"]);
            $question->setChoix2($row["question_choix2"]);
            $question->setChoix3($row["question_choix3"]);
            $question->setChoix4($row["question_choix4"]);
            $arr[$idx++] = $question;
        }
        return $arr;
   }
   
   function findById($connectionId){
       foreach($connectionId->query("select * from question where pk_question_id = $this->id") as $row){
           $question = new Question();
           $question->setId($row["pk_question_id"]);
           $question->setQuestion($row["question_question"]);
           $question->setAnswer($row["question_answer"]);
           $question->setPoints($row["question_points"]);
           $question->setQuizId($row["fk_quiz_id"]);
           $question->setQuestionTypeId($row["fk_questionType_id"]);
           $question->setChoix1($row["question_choix1"]);
           $question->setChoix2($row["question_choix2"]);
           $question->setChoix3($row["question_choix3"]);
           $question->setChoix4($row["question_choix4"]);
           return $question;
       }
   }
   
}

?>