<?php

class Language
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

    function __construct($id =NULL, $name=NULL){
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
        $affectedRows = $connectionId->exec("insert into language (pk_language_id, language_name) values ('','$this->name')");
        return $connectionId->lastInsertId();
    }
    
    function updateName($connectionId){
        $affectedRows = $connectionId->exec("update language set language_name = '$this->name' where pk_language_id = $this->id ");
        return $affectedRows;
    }
    
    function delete($connectionId){
        $affectedRows = $connectionId->exec("delete from language where pk_language_id = $this->id");
        return $affectedRows;
    }
    
    function findAll($connectionId){
        $idx=0;
        foreach ($connectionId->query("select * from language") as $row){
            $language = new Language();
            $language->setId($row["pk_language_id"]);
            $language->setName($row["language_name"]);
            $arr[$idx++]=$language;
        }
        return $arr;
    }
    
    function findById($connectionId){
        foreach ($connectionId->query("select * from language where pk_language_id = $this->id") as $row){
            $language = new Language();
            $language->setId($row["pk_language_id"]);
            $language->setName($row["language_name"]);
            return $language;
        }
    }
}

?>