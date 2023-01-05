<?php 

require_once('database.php');

//class for levels
class levelDB{
    public static function geLevels(){
        $db = new Database();
        $dbConn = $db->getDbConn();

        if($dbConn){
            $query = 'SELECT * FROM user_levels';

            return $dbConn->query($query);
        }else{
            return false;
        }
    }
}


?>