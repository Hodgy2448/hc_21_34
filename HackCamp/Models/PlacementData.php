<?php

class PlacementData {
    
    protected $_id, $_title, $_description, $_location, $_neededSkills, $_workType, $_salary, $_startDate, $_endDate;
    
    public function __construct($dbRow) {
        $this->_id = $dbRow['idplacements'];
        $this->_title = $dbRow['title'];
        $this->_description = $dbRow['description'];
        $this->_location = $dbRow['location'];
        $this->_neededSkills = $dbRow['neededskills'];
        $this->_workType = $dbRow['workType'];
        $this->_salary = $dbRow['salary'];
        $this->_startDate = $dbRow['startdate'];
        $this->_endDate = $dbRow['enddate'];
    }

    public function getPlacementID() {
        return $this->_id;
    }
    public function getTitle() {
        return $this->_title;
    }
    public function getDescription() {
        return $this->_description;
    }
    public function getLocation() {
        return $this->_location;
    }
    public function getNeededSkills() {
        return $this->_neededSkills;
    }
    public function getWorkType() {
        return $this->_workType;
    }
    public function getSalary() {
        return $this->_salary;
    }
    public function getStartDate() {
        return $this->_startDate;
    }
    public function getEndDate() {
        return $this->_endDate;
    }


            
}


