<?php 

class Level{
    private $levelNo;
    private $levelName;

    public function __construct($levelNo, $levelName){
        $this->levelName = $levelName;
        $this->levelNo = $levelNo;
    }
    
    //get set levelNo
    public function getLevelNo(){
        return $this->levelNo;
    }
    public function setLevelNo($val){
        $this->levelNo = $val;
    }

    //get set level name
    public function getLevelName(){
        return $this->levelName;
    }
    public function setLevelName($val){
        $this->levelName = $val;
    }
        
    
}

?>