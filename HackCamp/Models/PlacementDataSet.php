<?php


require_once ('Models/Database.php');
require_once ('Models/PlacementData.php');

class PlacementDataSet {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllPlacements() {
        $sqlQuery = 'SELECT * FROM placements';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new PlacementData($row);
        }
        return $dataSet;
    }

    public function createPlacement($username,$password,$firstname,$lastname,$dob,$email)
    {
        $sqlQuery2 = 'INSERT INTO users (username,password,firstname,lastname,dob,email) VALUES ("'. $username .'","' . $password .'","' .$firstname .'","' .$lastname .'","' .$dob .'","' .$email     .  '")';

        $statement = $this->_dbHandle->prepare($sqlQuery2); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
    }

}


