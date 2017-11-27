<?php

class Course
{   
    private $id;
    private $name;
    private $languageId;
    private $subCategoryId;
    private $memberId;
    
    /**
     * @return the $memberId
     */
    public function getMemberId()
    {
        return $this->memberId;
    }

    /**
     * @param field_type $memberId
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;
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
     * @return the $languageId
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * @return the $subCategoryId
     */
    public function getSubCategoryId()
    {
        return $this->subCategoryId;
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
     * @param string $languageId
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;
    }

    /**
     * @param string $subCategoryId
     */
    public function setSubCategoryId($subCategoryId)
    {
        $this->subCategoryId = $subCategoryId;
    }

    function __construct($id = NULL, $name = NULL, $languageId = NULL, $subCategoryId = NULL , $memberId = NULL){
        $this->id = $id;
        $this->name = $name;
        $this->languageId = $languageId;
        $this->subCategoryId = $subCategoryId;
        $this->memberId = $memberId;
    }
    
    static function header(){
        return "<table><tr><th>Id</th><th>Name</th><th>Language Id</th><th>Sub Category Id</th><th>Member Id</th></tr>";
    }
    
    static function footer(){
        return "</table>";
    }
        
    function __toString(){
        return "<tr><td>$this->id</td><td>$this->name</td><td>$this->languageId</td><td>$this->subCategoryId</td><td>$this->memberId</td></tr>";   
    }
    
    function create($connectionId){
        $affectedRows = $connectionId->exec("insert into course (pk_course_id,course_name,fk_language_id,fk_subCategory_id,fk_member_id) 
        values ('','$this->name',$this->languageId,$this->subCategoryId,$this->memberId)");
        return $connectionId->lastInsertId();
    }
    
    function updateName($connectionId){
        $affectedRows = $connectionId->exec("update course set course_name = '$this->name' where pk_course_id = $this->id");
        return $affectedRows;
    }
    
    function updateLanguageId($connectionId){
        $affectedRows = $connectionId->exec("update course set fk_language_id = $this->languageId where pk_course_id = $this->id");
        return $affectedRows;
    }
    
    function updateSubCategoryId($connectionId){
        $affectedRows = $connectionId->exec("update course set fk_subCategory_id = $this->subCategoryId where pk_course_id = $this->id");
        return $affectedRows;
    }
    
    function updateMemberId($connectionId){
        $affectedRows = $connectionId->exec("update course set fk_member_id = $this->memberId where pk_course_id = $this->id");
        return $affectedRows;
    }
    
    function delete($connectionId){
        $affectedRows = $connectionId->exec("delete from course where pk_course_id = $this->id");
        return $affectedRows;
    }
    
    function findAll($connectionId){
        $idx=0;
        foreach($connectionId->query("select * from course") as $row){
            $course = new Course();
            $course->setId($row["pk_course_id"]);
            $course->setName($row["course_name"]);
            $course->setLanguageId($row["fk_language_id"]);
            $course->setSubCategoryId($row["fk_subCategory_id"]);
            $course->setMemberId($row["fk_member_id"]);
            $arr[$idx++]= $course; 
        }
            return $arr;
    }
    
    function findById($connectionId){
        $idx=0;
        foreach($connectionId->query("select * from course where pk_course_id = $this->id") as $row){
            $course = new Course();
            $course->setId($row["pk_course_id"]);
            $course->setName($row["course_name"]);
            $course->setLanguageId($row["fk_language_id"]);
            $course->setSubCategoryId($row["fk_subCategory_id"]);
            $course->setMemberId($row["fk_member_id"]);
            $arr[$idx++]= $course;
        }
        return $arr;
    }
}

?>