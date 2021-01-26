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

    public function createPlacement($id, $title, $description, $location, $neededSkills, $workType, $salary, $startdate, $enddate)
    {
        $sqlQuery2 = 'INSERT INTO placements (idplacements,title,description,location,neededSkills,workType,salary,startdate,enddate) VALUES ("'. $id .'","' . $title .'","' .$description .'","' .$location .'","' .$neededSkills .'","' .$workType   .'","' .$salary .'","' .$startdate .'","' .$enddate   .  '")';

        $statement = $this->_dbHandle->prepare($sqlQuery2); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
    }

}


