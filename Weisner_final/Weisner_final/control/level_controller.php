<?php 

include_once('level.php');
include_once('../model/level_db.php');

class LevelController{
    public static function getAllLevels(){
        $queryRes = LevelDB::geLevels();

        if($queryRes){
            $levels = array();
            foreach($queryRes as $row){
                $levels[] = new Level($row['UserLevelNo'],
                    $row['LevelName']);
            }

            return $levels;
        }else{
            return false;
        }

        
    }
}


?>