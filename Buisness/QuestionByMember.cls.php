<?php

class QuestionByMember
{
    private $id;
    private $answer;
    private $memberId;
    private $questionId;
    
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @return the $memberId
     */
    public function getMemberId()
    {
        return $this->memberId;
    }

    /**
     * @return the $questionId
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    /**
     * @param string $memberId
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;
    }

    /**
     * @param string $questionId
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;
    }

    function __construct($id=NULL,$answer=NULL,$memberId=NULL,$questionId=NULL){
        $this->id = $id;
        $this->answer = $answer;
        $this->memberId = $memberId;
        $this->questionId = $questionId;
    }
    
    static function header(){
        return "<table><tr><th>Id</th><th>Answer</th><th>Member Id</th><th>Question Id</th></tr>"; 
    }
    
    static function footer(){
        return "</table>";
    }
    
    function __toString(){
        return "<tr><td>$this->id</td><td>$this->answer</td><td>$this->memberId</td><td>$this->questionId</td></tr>";
    }
    
    function create($connectionId){
        $affectedRows = $connectionId->exec("insert into questionByMember (pk_questionByMember_id,questionByMember_answer,fk_member_id,fk_question_id) 
        values ('','$this->answer',$this->memberId,$this->questionId)");
        return $connectionId->lastInsertId();
    }
    
    function updateAnswer($connectionId){
        $affectedRows = $connectionId->exec("update questionByMember set questionByMember_answer = '$this->answer' where pk_questionByMember = $this->id");
        return $affectedRows;
    }
    
    function updateMemberId($connectionId){
        $affectedRows = $connectionId->exec("update questionByMember set fk_member_id = $this->memberId where pk_questionByMember_Id = $this->id");
        return $affectedRows;
    }
    
    function updateQuestionId($connectionId){
        $affectedRows = $connectionId->exec("update questionByMember set fk_question_id = $this->questionId where pk_questionByMember_id = $this->id");
        return $affectedRows;
    }
    
    function delete($connectionId){
        $affectedRows = $connectionId->exec("delete from questionByMember where pk_questionByMember_id = $this->id");
        return $affectedRows;
    }
    
    function findAll($connectionId){
        $idx=0;
        foreach($connectionId->query("select * from questionByMember") as $row){
            $questionByMember = new QuestionByMember();
            $questionByMember->setId($row["pk_questionByMember_id"]);
            $questionByMember->setAnswer($row["questionByMember_answer"]);
            $questionByMember->setMemberId($row["fk_member_id"]);
            $questionByMember->setQuestionId($row["fk_question_id"]);
            $arr[$idx++] = $questionByMember;
        }
        return $arr;
    }
    
    function findById($connectionId){
        foreach($connectionId->query("select * from questionByMember where pk_questionByMember_id = $this->id") as $row){
            $questionByMember = new QuestionByMember();
            $questionByMember->setId($row["pk_questionByMember_id"]);
            $questionByMember->setAnswer($row["questionByMember_answer"]);
            $questionByMember->setMemberId($row["fk_member_id"]);
            $questionByMember->setQuestionId($row["fk_question_id"]);
            return $questionByMember;
        }
    }
    
}

?>