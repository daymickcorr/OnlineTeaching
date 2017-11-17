<?php

class Media
{
    private $id;
    private $path;
    private $name;
    private $type;
    private $contentId;
    
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return the $contentId
     */
    public function getContentId()
    {
        return $this->contentId;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $contentId
     */
    public function setContentId($contentId)
    {
        $this->contentId = $contentId;
    }

    function  __construct($id = NULL, $path = NULL, $name = NULL, $type = NULL, $contentId = NULL){
        $this->id = $id;
        $this->path = $path;
        $this->name = $name;
        $this->type = $type;
        $this->contentId = $contentId;
    }
    
    static function header(){
        return "<table><tr><th>Id</th><th>Path</th><th>Name</th><th>Type</th><th>Content Id</th></tr>";
    }
    
    static function footer(){
        return "</table>";
    }
    
    function __toString(){
        return "<tr><td>$this->id</td><td>$this->path</td><td>$this->name</td><td>$this->type</td><td>$this->contentId</td></tr>";
    }
    
    function create($connectionId){
        $affectedRows = $connectionId->exec("insert into media (pk_media_id,media_path,media_name,media_type,fk_content_id) values ('','$this->path','$this->name','$this->type','$this->contentId')");
        return $connectionId->lastInsertId();
    }
    
    function updateName($connectionId){
        $affectedRows = $connectionId->exec("update media set media_name = '$this->name' where pk_media_id = $this->id");
        return $affectedRows;
    }
    
    function updatePath($connectionId){
        $affectedRows = $connectionId->exec("update media set media_path = '$this->path' where pk_media_id = $this->id");
        return $affectedRows;
    }
    
    function updateType($connectionId){
        $affectedRows = $connectionId->exec("update media set media_type = '$this->type' where pk_media_id = $this->id");
        return $affectedRows;
    }
    
    function updateContentId($connectionId){
        $affectedRows = $connectionId->exec("update media set fk_content_id = $this->contentId where pk_media_id = $this->id");
        return $affectedRows;
    }
    
    function delete($connectionId){
        $affectedRows = $connectionId->exec("delete from media where pk_media_id = $this->id");
        return $affectedRows;
    }
    
    function findAll($connectionId){
        $idx=0;
        foreach($connectionId->query("select * from media") as $row){
            $media = new Media();
            $media->setId($row["pk_media_id"]);
            $media->setName($row["media_name"]);
            $media->setPath($row["media_path"]);
            $media->setType($row["media_type"]);
            $media->setContentId($row["fk_content_id"]);
            $arr[$idx++] = $media;
        }
        return $arr;
    }
    
    function findById($connectionId){
        foreach($connectionId->query("select * from media where pk_media_id = $this->id") as $row){
            $media = new Media();
            $media->setId($row["pk_media_id"]);
            $media->setName($row["media_name"]);
            $media->setPath($row["media_path"]);
            $media->setType($row["media_type"]);
            $media->setContentId($row["fk_content_id"]);
            return $media;
        }
    }
    
}

?>