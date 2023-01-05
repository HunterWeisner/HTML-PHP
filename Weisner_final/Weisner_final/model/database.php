<?php
// Add user account: User ID: cis367final_user Password: 6TusdNdKdUoACkHm
class Database {
    // DB connection parameters
    private $host = 'localhost';
    private $dbname = 'cis367_wk3final';
    private $username = 'cis367final_user';
    private $password = '6TusdNdKdUoACkHm';

    //DB connection and error message
    private $conn;
    private $conn_error = '';

    //constructor - connect to the DB or set an error
    //message if the connection failed
    function __construct() {
        //turn off error reporting since we're handling them manually
        mysqli_report(MYSQLI_REPORT_OFF);

        //connect tot he database
        $this->conn = mysqli_connect($this->host, $this->username,
            $this->password, $this->dbname);
        //if the connection failed, set the error message
        if($this->conn === false) {
            $this->conn_error = "Failed to connect to DB: "
             . mysqli_connect_errno();
        }
    }

    function __destruct() {
        mysqli_close($this->conn);
    }

    //functions to get the db connection paramaters
    //it will be false
    function getDbConn(){
        return $this->conn;
    }

    function getDbError(){
        return $this->conn_error;
    }

    //functions to get the db connection parameters
    function getDbHost() {
        return $this->host;
    }

    function getDbName(){
        return $this->dbname;
    }

    function getDbUser(){
        return $this->username;
    }

    function getDbUserPw() {
        return $this->password;
    }

}


?>