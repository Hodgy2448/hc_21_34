<?php

require_once ('Models/Database.php');
require_once ('Models/StudentData.php');

class StudentDataSet {
    protected $_dbHandle, $_dbInstance;
        
    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllStudents() {
        $sqlQuery = 'SELECT * FROM student';
                
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new StudentData($row);
        }
        return $dataSet;
    }

    public function setMoreDetails($id, $uni,$course,$skills,$cvName)
    {
        $sqlQuery2 = 'INSERT INTO student (idstudent, university,course,skills,cvupload) VALUES ("'. $id .'","'. $uni .'","' . $course .'","' .$skills .'","' .$cvName .  '")';

        $statement = $this->_dbHandle->prepare($sqlQuery2); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
    }
}


