<?php


require_once ('Models/Database.php');
require_once ('Models/SkillsData.php');

class SkillsDataSet {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllSkills() {
        $sqlQuery = 'SELECT * FROM skills';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new SkillsData($row);
        }
        return $dataSet;
    }

}


