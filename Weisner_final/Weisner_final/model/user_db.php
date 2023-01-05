<?php 

require_once('database.php');

class UserDB{
    public static function getUsers(){
        $db = new Database();
        $dbConn = $db->getDbConn();

        if($dbConn){
            $query = 
            'SELECT * FROM users
                INNER JOIN user_levels
                    on users.UserLevelNo = user_levels.UserLevelNo';

            return $dbConn->query($query);
        }else{
            return false;
        }
    }
    public static function getUser($userNo){
        $db = new Database();
        $dbConn = $db->getDbConn();

        if($dbConn){
            $query = 
                "SELECT * FROM users
                    INNER JOIN user_levels
                        on users.UserLevelNo = user_levels.UserLevelNo
                    WHERE UserNo = '$userNo'";
            $result = $dbConn->query($query);

            return $result->fetch_assoc();
        }else{
            return false;
        }
    }
    //function to get a user by their e-mail address
    public static function getUserByEMail($email){
        //get the db connection
        $db = new Database();
        $dbConn = $db->getDbConn();

        if($dbConn){
            //create the query strong
            $query = "SELECT * FROM users
                    INNER JOIN user_levels
                        on users.UserLevelNo = user_levels.UserLevelNo
                    WHERE users.EMail = '$email'
                    ";

            //exectue query
            //no such email found
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        }else{
            
            return false;
        }
    }
    //get user by userid
    public static function getUserByUserID($userID){
        //get the db connection
        $db = new Database();
        $dbConn = $db->getDbConn();

        if($dbConn){
            //create the query strong
            $query = "SELECT * FROM users
                    INNER JOIN user_levels
                        on users.UserLevelNo = user_levels.UserLevelNo
                    WHERE users.UserId = '$userID'
                    ";

            //exectue query
            //no such email found
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        }else{
            
            return false;
        }
    }
    //function to delete a user
    public static function deleteUser($userNo){
        $db = new Database();
        $dbConn = $db->getDbConn();

        if($dbConn){
            $query = "DELETE FROM users
                    WHERE UserNo = '$userNo'";
            return $dbConn->query($query) === TRUE;
        }else{
            return false;
        }
    }

    //function to add a user
    public static function addUser(
        $userID, $password, $firstName, $lastName, $hireDate, $email, $extension, $userLevel
    ){
        $db = new Database();
        $dbConn = $db->getDbConn();

        if($dbConn){
            $query = "INSERT INTO users (UserId, Password, FirstName, LastName,
                HireDate, EMail, Extension, UserLevelNo)
                VALUES('$userID','$password', '$firstName', '$lastName', '$hireDate'
                ,'$email', '$extension', '$userLevel')";

            return $dbConn->query($query) === TRUE;
        }else{
            return false;
        }
    }

    //function to update a user
    public static function updateUser(
        $userNo, $userID, $password, $firstName, $lastName, $hireDate, $email, $extension, $userLevel
    ){
        $db = new Database();
        $dbConn = $db->getDbConn();

        if($dbConn){
            $query = "UPDATE users SET
                UserId = '$userID',
                Password = '$password',
                FirstName = '$firstName', 
                LastName = '$lastName',
                HireDate = '$hireDate', 
                EMail = '$email', 
                Extension = '$extension', 
                UserLevelNo = '$userLevel'
                WHERE UserNo = '$userNo'";
            return $dbConn->query($query);
        }else{
            return false;
        }
    }
}
?>