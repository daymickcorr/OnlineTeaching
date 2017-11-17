<?php

class Subject
{
    private $id;
    private $name;
    private $courseId;
    
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
     * @return the $courseId
     */
    public function getCourseId()
    {
        return $this->courseId;
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
     * @param string $courseId
     */
    public function setCourseId($courseId)
    {
        $this->courseId = $courseId;
    }

    function __construct($id=NULL,$name=NULL,$courseId=NULL){
        $this->id = $id;
        $this->name = $name;
        $this->courseId = $courseId;
    }
    
    static function header(){
        return "<table><tr><th>Id</th><th>Name</th><th>Course Id</th></tr>";
    }
    
    static function footer(){
        return "</table>";    
    }
    
    function __toString(){
        return "<tr><td>$this->id</td><td>$this->name</td><td>$this->courseId</td></tr>";
    }
    
    function create($connectionId){
        $affectedRows = $connectionId->exec("insert into subject (pk_subject_id,subject_name,fk_course_id) values ('','$this->name',$this->courseId)");
        return $connectionId->lastInsertId();
    }
    
    function updateName($connectionId){
        $affectedRows = $connectionId->exec("update subject set subject_name = '$this->name' where pk_subject_id = $this->id");
        return $affectedRows;
    }
    
    function updateCourseId($connectionId){
        $affectedRows = $connectionId->exec("update subject set fk_course_id = $this->courseId where pk_subject_id = $this->id");
        return $affectedRows;
    }
    
    function delete($connectionId){
        $affectedRows = $connectionId->exec("delete from subject where pk_subject_id = $this->id");
        return $affectedRows;
    }
    
    function findAll($connectionId){
        $idx=0;
        foreach($connectionId->query("select * from subject") as $row){
            $subject = new Subject();
            $subject->setId($row["pk_subject_id"]);
            $subject->setName($row["subject_name"]);
            $subject->setCourseId($row["fk_course_id"]);
            $arr[$idx++] = $subject;
        }
        return $arr;
    }
    
    function findById($connectionId){
        foreach($connectionId->query("select * from subject where pk_subject_id = $this->id") as $row){
            $subject = new Subject();
            $subject->setId($row["pk_subject_id"]);
            $subject->setName($row["subject_name"]);
            $subject->setCourseId($row["fk_course_id"]);
            return $subject;
        }
    }
    
}

?>