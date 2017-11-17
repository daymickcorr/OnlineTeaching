<?php

class QuestionType
{
    private $id;
    private $name;
    
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

    function __construct($id=NULL,$name=NULL){
        $this->id = $id;
        $this->name = $name;
    }
    
    static function header(){
        return "<table><tr><th>Id</th><th>Name</th></tr>";    
    }
    
    static function footer(){
        return "</table>";
    }
    
    function __toString(){
        return "<tr><td>$this->id</td><td>$this->name</td></tr>";
    }
    
    function create($connectionId){
        $affectedRows = $connectionId->exec("insert into questionType (pk_questionType_id,questionType_name) values
        ('','$this->name')");
        return $connectionId->lastInsertId();
    }
    
    function updateName($connectionId){
        $affectedRows = $connectionId->exec("update questionType set questionType_name = '$this->name' where pk_questionType_id = $this->id");
        return $affectedRows;
    }
    
    function delete($connectionId){
        $affectedRows = $connectionId->exec("delete from questionType where pk_questionType_id = $this->id");
        return $affectedRows;
    }
    
    function findAll($connectionId){
        $idx=0;
        foreach($connectionId->query("select * from questionType") as $row){
            $questionType = new QuestionType();
            $questionType->setId($row["pk_questionType_id"]);
            $questionType->setName($row["questionType_name"]);
            $arr[$idx++] = $questionType;
        }
        return $arr;
    }
    
    function findById($connectionId){
        foreach($connectionId->query("select * from questionType where pk_1uestionType_id = $this->id") as $row){
            $questionType = new QuestionType();
            $questionType->setId($row["pk_questionType_id"]);
            $questionType->setName($row["questionType_name"]);
            return $questionType;
        }
    }
    
}

?>