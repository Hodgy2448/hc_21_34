<?php

require_once ('Models/Database.php');
require_once ('Models/AccountData.php');

class AccountDataSet {
    protected $_dbHandle, $_dbInstance;
        
    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllAccounts() {
        $sqlQuery = 'SELECT * FROM accounts';
                
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new AccountData($row);
        }
        return $dataSet;
    }

    public function createAccount($type, $name,$dob, $email, $phonenumber, $address1,  $address2, $address3, $postcode, $password)
    {
        $sqlQuery2 = 'INSERT INTO accounts (type,name,dob,email,phonenumber,address1,address2,address3,postcode,password) VALUES ("'. $type .'","' . $name .'","' .$dob .'","' .$email .'","' .$phonenumber .'","' .$address1 . '","' .$address2 .'","' .$address3 .'","' .$postcode .'","' .$password . '")';

        $statement = $this->_dbHandle->prepare($sqlQuery2); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
    }
}


