<?php

class ContentByMember
{
    private $id;
    private $date;
    private $memberId;
    private $contentId;
    
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return the $memberId
     */
    public function getMemberId()
    {
        return $this->memberId;
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
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param string $memberId
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;
    }

    /**
     * @param string $contentId
     */
    public function setContentId($contentId)
    {
        $this->contentId = $contentId;
    }

    function __construct($id = NULL, $date = NULL, $memberId = NULL, $contentId = NULL){
        $this->id = $id;
        $this->date = $date;
        $this->memberId = $memberId;
        $this->contentId = $contentId;
    }
    
    static function header(){
        return "<table><tr><td>Id</td><td>Date</td><td>Member Id</td><td>Content Id</td></tr>";
    }
        
    static function footer(){
        return "</table>";
    }
    
    function __toString(){
        return "<tr><td>$this->id</td><td>$this->date</td><td>$this->memberId</td><td>$this->contentId</td></tr>";    
    }
    
    function create($connectionId){
        $affectedRows = $connectionId->exec("insert into contentbymember (pk_contentByMember_id,contentByMember_date,fk_member_id,fk_content_id) 
        values ('','$this->date',$this->memberId,$this->contentId)");
        return $connectionId->lastInsertId();
    }
    
    function updateDate($connectionId){
        $affectedRows = $connectionId->exec("update contentByMember set contentByMember_date = '$this->date' where pk_contentByMember_id = $this->id ");
        return $affectedRows;
    }
    
    function updateMemberId($connectionId){
        $affectedRows = $connectionId->exec("update contentByMember set fk_member_id = $this->memberId where pk_contentByMember_id $this->memberId");
        return $affectedRows;
    }
    
    function updateContentId($connectionId){
        $affectedRows = $connectionId->exec("update contentByMember set fk_content_id = $this->contentId where pk_contentByMember_id = $this->id");
        return $affectedRows;
    }
    
    function delete($connectionId){
        $affectedRows = $connectionId->exec("delete from contentByMember where pk_contentByMember_id = $this->id");
        return $affectedRows;
    }
    
    function findAll($connectionId){
        $idx =0; 
        foreach($connectionId->query("select * from contentByMember") as $row){
            $contentByMember = new ContentByMember();
            $contentByMember->setId($row["pk_contentByMember_id"]);
            $contentByMember->setDate($row["contentByMember_date"]);
            $contentByMember->setMemberId($row["fk_member_id"]);
            $contentByMember->setContentId($row["fk_content_id"]);
            $arr[$idx] = $contentByMember;
        }
        return $arr;
    }
    
    function findById($connectionId){
        foreach($connectionId->query("select * from contentByMember where pk_contentByMember_id = $this->id") as $row){
            $contentByMember = new ContentByMember();
            $contentByMember->setId($row["pk_contentByMember_id"]);
            $contentByMember->setDate($row["contentByMember_date"]);
            $contentByMember->setMemberId($row["fk_member_id"]);
            $contentByMember->setContentId($row["fk_content_id"]);
            return $contentByMember;
        }
    }
    
}

?>