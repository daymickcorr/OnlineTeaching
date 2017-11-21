<?php

class Member
{
    private $id;
    private $lastName;
    private $firstName;
    private $userName;
    private $password;
    private $email;
    private $memberTypeId;
    
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return the $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return the $userName
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return the $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return the $memberTypeId
     */
    public function getMemberTypeId()
    {
        return $this->memberTypeId;
    }

    /**
     * @param Ambigous <string, unknown> $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param Ambigous <string, unknown> $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @param Ambigous <string, unknown> $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @param Ambigous <string, unknown> $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @param Ambigous <string, unknown> $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param Ambigous <string, unknown> $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param Ambigous <string, unknown> $memberTypeId
     */
    public function setMemberTypeId($memberTypeId)
    {
        $this->memberTypeId = $memberTypeId;
    }

    function __construct($id=NULL,$lastName=NULL,$firstName=NULL,$userName=NULL,$password=NULL,$email=NULL,$memberTypeId=NULL){
        $this->id = $id;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->userName = $userName;
        $this->password = $password;
        $this->email = $email;
        $this->memberTypeId = $memberTypeId;
    }
    
    static function header(){
        return "<table><tr><th>Id</th><th>Last Name</th><th>First Name</th><th>User Name</th><th>Password</th><th>Email</th><th>Member Type Id</th></tr>";    
    }
    
    static function footer(){
        return "</table>";
    }
    
    function __toString(){
        return "<tr><td>$this->id</td><td>$this->lastName</td><td>$this->firstName</td><td>$this->userName</td><td>$this->password</td><td>$this->email</td><td>$this->memberTypeId</td></tr>";
    }
    
    function create($connectionId){
        $password = md5($this->password);
        $affectedRows = $connectionId->exec("insert into member (pk_member_id, member_lastName, member_firstName, member_userName,member_password,member_email,fk_memberType_Id)
        values ('','$this->lastName','$this->firstName','$this->userName','$password','$this->email',$this->memberTypeId)");
        return $connectionId->lastInsertId();
    }
    
    function updateLastName($connectionId){
        $affectedRows = $connectionId->exec("update member set member_lastName = '$this->lastName' where pk_member_id = $this->id");
        return $affectedRows;
    }
    
    function updateFirstName($connectionId){
        $affectedRows = $connectionId->exec("update member set member_firstName = '$this->firstName' where pk_member_id = $this->id");
        return $affectedRows;
    }
    
    function updatePassword($connectionId){
        $affectedRows = $connectionId->exec("update member set member_password = '$this->password' where pk_member_id = $this->id");
        return $affectedRows;
    }
    
    function updateEmail($connectionId){
        $affectedRows = $connectionId->exec("update member set member_email = '$this->email' where pk_member_id = $this->id");
        return $affectedRows;
    }
    
    function updateMemberTypeId($connectionId){
        $affectedRows = $connectionId->exec("update member set fk_memberType_id = $this->memberTypeId where pk_member_id = $this->id");
        return $affectedRows;
    }
    
    function delete($connectionId){
        $affectedRows = $connectionId->exec("delete from member where pk_member_id = $this->id");    
    }
    
    function findAll($connectionId){
        $idx=0;
        foreach($connectionId->query("select * from member ") as $row){
            $member = new Member();
            $member->setId($row["pk_member_id"]);
            $member->setLastName($row["member_lastName"]);
            $member->setFirstName($row["member_firstName"]);
            $member->setUserName($row["member_userName"]);
            $member->setPassword($row["member_password"]);
            $member->setEmail($row["member_email"]);
            $member->setMemberTypeId($row["fk_memberType_id"]);
            $arr[$idx++] = $member;
        }
        return $arr;
    }
    
    function findById($connectionId){
        foreach($connectionId->query("select * from member where pk_member_id = $this->id") as $row){
            $member = new Member();
            $member->setId($row["pk_member_Id"]);
            $member->setLastName($row["member_lastName"]);
            $member->setFirstName($row["member_firstName"]);
            $member->setUserName($row["member_userName"]);
            $member->setPassword($row["member_password"]);
            $member->setEmail($row["member_email"]);
            $member->setMemberTypeId($row["fk_memberType_id"]);
            return $member;
        }
    }
    
    function authentificate($connectionId){
        $password = md5($this->password);
        $id = -1;
        foreach ($connectionId->query("select pk_member_id from member where member_userName = '$this->userName' and member_password = '$password' ") as $row){
            $id = $row["pk_member_id"];
        }
        return $id;
    }
}

