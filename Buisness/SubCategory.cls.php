<?php

class SubCategory
{
    private $id;
    private $name;
    private $categoryId;
    private $imagePath;
    
    /**
     * @return the $imagePath
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param field_type $imagePath
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

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
     * @return the $categoryId
     */
    public function getCategoryId()
    {
        return $this->categoryId;
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
     * @param string $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    function __construct($id=NULL,$name=NULL,$categoryId=NULL,$imagePath=NULL){
        $this->id = $id;
        $this->name = $name;
        $this->categoryId = $categoryId;
        $this->imagePath = $imagePath;
    }
    
    static function header(){
        return "<table><tr><th>Id</th><th>Name</th><th>Category Id</th><th>Image Path</th></tr>";
    }
    
    static function footer(){
        return "</table>";
    }
    
    function __toString(){
        return "<tr><td>$this->id</td><td>$this->name</td><td>$this->categoryId</td><td>$this->imagePath</td></tr>";
    }
    
    function create($connectionId){
        $affectedRows = $connectionId->exec("insert into subCategory (pk_subCategory_id,subCategory_name,fk_category_id,subCategory_imagePath)
        values ('','$this->name',$this->categoryId,'$this->imagePath')");
        return $connectionId->lastInsertId();
    }
    
    function updateName($connectionId){
        $affectedRows = $connectionId->exec("update subCategory set subCategory_name = '$this->name' where pk_subCategory_id = $this->id");
        return $affectedRows;
    }
    
    function updateCategoryId($connectionId){
        $affectedRows = $connectionId->exec("update subCategory set fk_category_id = $this->categoryId where pk_subCategory_id = $this->id");
        return $affectedRows;
    }
    
    function updateImagePath($connectionId){
        $affectedRows = $connectionId->exec("update subCategory set subCategory_imagePath = '$this->imagePath' where pk_subCategory_id = $this->id");
        return $affectedRows;
    }
    
    function delete($connectionId){
        $affectedRows = $connectionId->exec("delete from subCategory where pk_subCategory_id = $this->id");
        return $affectedRows;
    }
    
    function findAll($connectionId){
        $idx=0;
        foreach($connectionId->query("select * from subCategory") as $row){
            $subCategory = new SubCategory();
            $subCategory->setId($row["pk_subCategory_id"]);
            $subCategory->setName($row["subCategory_name"]);
            $subCategory->setCategoryId($row["fk_category_id"]);
            $subCategory->setImagePath($row["subCategory_imagePath"]);
            $arr[$idx++] = $subCategory;
        }
        return $arr;
    }
    
    function findById($connectionId){
        foreach($connectionId->query("select * from subCategory where pk_subCategory_id = $this->id") as $row){
            $subCategory = new SubCategory();
            $subCategory->setId($row["pk_subCategory_id"]);
            $subCategory->setName($row["subCategory_name"]);
            $subCategory->setCategoryId($row["fk_category_id"]);
            $subCategory->setImagePath($row["subCategory_imagePath"]);
            return $subCategory;
        }
    }
    
}

?>