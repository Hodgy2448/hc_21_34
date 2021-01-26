<?php

class SkillsData {
    
    protected $_id, $_skillname, $_startlevel, $_endlevel;
    
    public function __construct($dbRow) {
        $this->_id = $dbRow['idskills'];
        $this->_skillname = $dbRow['skillname'];
        $this->_startlevel = $dbRow['startlevel'];
        $this->_endlevel = $dbRow['endlevel'];

    }

    public function getSkillsID() {
        return $this->_id;
    }
    public function getSkillName() {
        return $this->_skillname;
    }
    public function getStartLevel() {
        return $this->_startlevel;
    }
    public function getEndLevel() {
        return $this->_endlevel;
    }



            
}


