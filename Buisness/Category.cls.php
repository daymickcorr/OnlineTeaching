<?php

class Category
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
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @param field_type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    function __construct($id = null,$name = null){
        $this->id = $id;
        $this->name = $name;
    }
    
    public static function header(){
        return "<table><tr><th>Id</th><th>Name</th></tr>";
    }
    
    public static function footer(){
        return "</table>";
    }
    
    function __toString(){
        return "<tr><td>$this->id</td><td>$this->name</td></tr>";
    }
    
    function create($connectionId){
        $affectedRows =$connectionId->exec("insert into category (pk_category_id,category_name) values ('','$this->name')");
        //if last insert id is 0 insertion failed
        return $connectionId->lastInsertId();
    }
    
    function updateName($connectionId){
        $affectedRows = $connectionId->exec("update category set category_name = '$this->name' where pk_category_id = $this->id");
        return $affectedRows;
    }
    
    function delete($connectionId){
        $affectedRows = $connectionId->exec("delete from category where pk_category_id = $this->id");
        return $affectedRows;
    }
    
    function findById($connectionId){
        foreach ($connectionId->query("select * from category where pk_category_id = $this->id") as $row){
            $category = new Category();
            $category->setId($row["pk_category_id"]);
            $category->setName($row["category_name"]);
            return $category;
        }
    }
    
    function findAll($connectionId){
        $idx=0;
        foreach ($connectionId->query("select * from category") as $row){
            $category = new Category();
            $category->setId($row["pk_category_id"]);
            $category->setName($row["category_name"]);
            $arr[$idx++] = $category;
        }
        return $arr;
    }
    
}

?>