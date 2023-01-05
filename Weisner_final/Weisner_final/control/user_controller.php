<?php 

require_once('/xampp/htdocs/Weisner_final/model/user_db.php');
require_once('user.php');
require_once('level.php');


class UserController {
    //helper funciton to convert a db row into a user object
    private static function rowToUser($row){
        $user = new User(
            $row['UserId'],
            $row['FirstName'],
            $row['LastName'],
            $row['HireDate'],
            $row['EMail'],
            $row['Password'],
            $row['Extension'],
            new Level($row['UserLevelNo'], $row['LevelName'])
        );
        $user->setUserNo($row['UserNo']);
        return $user;
    }

    public static function getAllusers(){
        $queryRes = UserDB::getUsers();
        
        if($queryRes){
            $users = array();
            foreach($queryRes as $row){
                $users[] = self::rowToUser($row);
            }

            return $users;
        }else{
            return false;
        }
    }

    public static function getUserbyNo($userNo){
        $queryRes = UserDB::getUser($userNo);

        if($queryRes){
            return self::rowToUser($queryRes);
        }else{
            return false;
        }
    }
    
    //function to check login credentials - return true
    //if user is valid, false otherwise
    public static function validUser($login, $password){
        $queryResEmail = UserDB::getUserByEMail($login);
        $queryResUserID = UserDB::getUserByUserID($login);

        if($queryResEmail){
            //process the user row
            $user = self::rowToUser($queryResEmail);
            if($user->getPassword() === $password){
                return $user->getUserLevel()->getLevelNo();
            }else{
                return false;
            }
        }else if($queryResUserID){
            $user = self::rowToUser($queryResUserID);
            if($user->getPassword() === $password){
                return $user->getUserLevel()->getLevelNo();
            }else{
                return false;
            }
        }else{
            //either no such user or db connect failed
            //either way, can't validate the user
            return false;
        }
    }

    public static function deleteUser($userNo){
        UserDB::deleteUser($userNo);
    }

    public static function addUser($user){
        return UserDB::addUser(
            $user->getUserID(),
            $user->getPassword(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getHireDate(),
            $user->getEMail(),
            $user->getExtension(),
            $user->getUserLevel()->getLevelNo()
        );
    }

    public static function updateUser($user){
        return userDB::updateUser(
            $user->getUserNo(),
            $user->getUserID(),
            $user->getPassword(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getHireDate(),
            $user->getEMail(),
            $user->getExtension(),
            $user->getUserLevel()->getLevelNo()
        );
    }
}
?>