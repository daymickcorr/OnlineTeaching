<?php

class Content
{
    private $id;
    private $name;
    private $text;
    private $subjectId;
    private $quizId;
    
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return the $text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return the $subjectId
     */
    public function getSubjectId()
    {
        return $this->subjectId;
    }

    /**
     * @return the $quizId
     */
    public function getQuizId()
    {
        return $this->quizId;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param string $subjectId
     */
    public function setSubjectId($subjectId)
    {
        $this->subjectId = $subjectId;
    }

    /**
     * @param string $quizId
     */
    public function setQuizId($quizId)
    {
        $this->quizId = $quizId;
    }

    function __construct($id = NULL, $name  = NULL , $text = NULL , $subjectId = NULL, $quizId = NULL){
       $this->id = $id;
       $this->name = $name;
       $this->text = $text;
       $this->subjectId = $subjectId;
       $this->quizId = $quizId;
    }
   
    static function header(){
        return "<table><tr><th>Id</th><th>Name</th><th>Text</th><th>Subject Id</th><th>Quiz Id</th></tr>";     
    }
    static function footer(){
        return "</table>";
    }
    function __toString(){
        return "<tr><th>$this->id</th><th>$this->name</th><th>$this->text</th><th>$this->subjectId</th><th>$this->quizId</th></tr>";
    }
    
    
    function create($connectionId){
        $affectedRows = $connectionId->exec("insert into content (pk_content_id,content_name,content_text,fk_subject_id,fk_quiz_id) 
        values('','$this->name','$this->text',$this->subjectId,$this->quizId);");
        return $connectionId->lastInsertId();
    }
    
    function updateName($connectionId){
        $affectedRows = $connectionId->exec("update content set content_name = $this->name where pk_content_id = $this->id ");
        return $affectedRows;
    }
    
    function updateText($connectionId){
        $affectedRows = $connectionId->exec("update content set content_text = $this->text where pk_content_id = $this->id");
        return $affectedRows;
    }
    
    function updateSubjectId($connectionId){
        $affectedRows = $connectionId->exec("update content set fk_subject_id = $this->subjectId where pk_content_id = $this->id");
        return $affectedRows;
    }
    
    function updateQuizId($connectionId){
        $affectedRows = $connectionId->exec("update content set fk_quiz_id = $this->quizId where pk_content_id = $this->id");
        return $affectedRows;
    }
    
    function delete($connectionId){
        $affectedRows = $connectionId->exec("delete from content where pk_content_id = $this->id");
        return $affectedRows;
    }
    
    function findAll($connectionId){
        $idx=0;
        foreach($connectionId->query("select * from content") as $row){
            $content = new Content();
            $content->setId($row["pk_content_id"]);
            $content->setName($row["content_name"]);
            $content->setText($row["content_text"]);
            $content->setSubjectId($row["fk_subject_id"]);
            $content->setQuizId($row["fk_quiz_id"]);
            $arr[$idx++] = $content;
        }
        return $arr;
    }
    
    function findById($connectionId){
        foreach($connectionId->query("select * from content where pk_content_id = $this->id") as $row){
            $content = new Content();
            $content->setId($row["pk_content_id"]);
            $content->setName($row["content_name"]);
            $content->setText($row["content_text"]);
            $content->setSubjectId($row["fk_subject_id"]);
            $content->setQuizId($row["fk_quiz_id"]);
            return $content;
        }
    }
    
    
}

?>