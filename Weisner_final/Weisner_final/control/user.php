<?php  

//class to represent an entry in the users table
class User {
    private $userNo;
    private $userID;
    private $password;
    private $firstname;
    private $lastname;
    private $hireDate;
    private $eMail;
    private $extension;
    private $userLevel;

    public function __construct($userID, $firstName, $lastName, $hireDate, $eMail, $password,
        $extension, $userLevel)
    {
        $this->userID = $userID;
        $this->firstname = $firstName;
        $this->lastname = $lastName;
        $this->eMail = $eMail;
        $this->password = $password;
        $this->hireDate = $hireDate;
        $this->userLevel = $userLevel;
        $this->extension = $extension;
    }
    //get set userID
    public function getUserID(){
        return $this->userID;
    }
    public function setUserID($value){
        $this->userID = $value;
    }
    //get set extension
    public function getExtension(){
        return $this->extension;
    }
    public function setExtension($value){
        $this->extension = $value;
    }

    //get set hireDate
    public function getHireDate(){
        return $this->hireDate;
    }
    public function setHireDate($value){
        $this->hireDate = $value;
    }

    //get and set the person properties
    public function getUserNo(){
        return $this->userNo;
    }
    public function setUserNo($value){
        $this->userNo = $value;
    }

    public function getFirstName(){
        return $this->firstname;
    }
    public function setFirstName($value){
        $this->firstname = $value;
    }

    public function getLastName(){
        return $this->lastname;
    }
    public function setLastName($value){
        $this->lastname = $value;
    }

    public function getEMail(){
        return $this->eMail;
    }
    public function setEMail($value){
        $this->eMail = $value;
    }

    public function getPassword(){
        return $this->password;
    }
    public function setPassword($value){
        $this->password = $value;
    }

    public function getUserLevel(){
        return $this->userLevel;
    }
    public function setUserLevel($value){
        $this->userLevel = $value;
    }
}




?>