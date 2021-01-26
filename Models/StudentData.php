<?php

class StudentData {
    
    protected $_id, $_university, $_course, $_skills, $_cvupload;
    
    public function __construct($dbRow)
    {
        $this->_id = $dbRow['idstudent'];
        $this->_university = $dbRow['university'];
        $this->_course = $dbRow['course'];
        $this->_skills = $dbRow['skills'];
        $this->_cvupload = $dbRow['cvupload'];
    }

    public function getStudentID() {
        return $this->_id;
    }
    public function getUniversity() {
        return $this->_university;
    }
    public function getCourse() {
        return $this->_course;
    }
    public function getSkills() {
        return $this->_skills;
    }
    public function getCvUpload() {
        return $this->_cvupload;
    }
            
}


