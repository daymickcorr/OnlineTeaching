<?php

class MemberType
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
    
    static function __toString(){
        return "<tr><td>$this->id</td><td>$this->name</td></tr>";
    }
    
    function create($connectionId){
        $affectedRows = $connectionId->exec("insert into memberType (pk_memberType_id,memberType_name) values('','$this->name')");
        return $connectionId->lastInsertId();
    }
    
    function updateName($connectionId){
        $affectedRows = $connectionId->exec("update memberType set memberType_name = '$this->name' where pk_memberType_id = $this->id");
        return $affectedRows;
    }
    
    function delete($connectionId){
        $affectedRows = $connectionId->exec("delete from memberType where pk_memberType_id = $this->id");
        return $affectedRows;
    }
    
    function findAll($connectionId){
        $idx=0;
        foreach($connectionId->query("select * from memberType") as $row){
            $memberType = new MemberType();
            $memberType->setId($row["pk_memberType_id"]);
            $memberType->setName($row["memberType_name"]);
            $arr[$idx++] = $memberType;
        }
        return $arr;
    }
    
    function findById($connectionId){
        foreach($connectionId->query("select * from memberType where pk_memberType_id = $this->id") as $row){
            $memberType = new MemberType();
            $memberType->setId($row["pk_memberType_id"]);
            $memberType->setName($row["memberType_name"]);
            return $memberType;
        }
    }
}

?>
