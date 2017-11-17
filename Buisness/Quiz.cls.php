<?php

class Quiz
{
    private $id;
    private $name;
    private $total;
    
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
     * @return the $total
     */
    public function getTotal()
    {
        return $this->total;
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
     * @param string $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    function __construct($id=NULL,$name=NULL,$total=NULL){
        $this->id = $id;
        $this->name = $name;
        $this->total = $total;
    }
    
    static function header(){
        return "<table><tr><th>Id</th><th>Name</th><th>Total</th></tr>";    
    }
   
    static function footer(){
        return "</table>";
    }
    
    function __toString(){
        return "<tr><td>$this->id</td><td$this->name></td><td>$this->total</td></tr>";
    }
    
    function create($connectionId){
        $affectedRows = $connectionId->exec("insert into quiz (pk_quiz_id,quiz_name,quiz_total) values ('','$this->name',$this->total)");
        return $connectionId->lastInsertId();
    }
    
    function updateName($connectionId){
        $affectedRows = $connectionId->exec("update quiz set quiz_name = '$this->name' where pk_quiz_id = $this->id");
        return $affectedRows;
    }
    
    function updateTotal($connectionId){
        $affectedRows = $connectionId->exec("update quiz set quiz_total = $this->total where pk_quiz_id = $this->id");
        return $affectedRows;
    }
    
    function delete($connectionId){
        $affectedRows = $connectionId->exec("delete from quiz where pk_quiz_id = $this->id");
        return $affectedRows;
    }
    
    function findAll($connectionId){
        $idx=0;
        foreach($connectionId->query("select * from quiz") as $row){
            $quiz = new Quiz();
            $quiz->setId($row["pk_quiz_id"]);
            $quiz->setName($row["quiz_name"]);
            $quiz->setTotal($row["quiz_total"]);
            $arr[$idx++] = $quiz;
        }
        return $arr;
    }
    
    function findById($connectionId){
        foreach($connectionId->query("select * from quiz where pk_quiz_id = $this->id") as $row){
            $quiz = new Quiz();
            $quiz->setId($row["pk_quiz_id"]);
            $quiz->setName($row["quiz_name"]);
            $quiz->setTotal($row["quiz_total"]);
            return $quiz;
        }
    }
}

?>