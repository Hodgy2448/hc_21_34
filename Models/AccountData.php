<?php

class AccountData {
    
    protected $_id, $_type, $_name, $_email,$_dob, $_phonenumber, $_address1,  $_address2, $_address3, $_postcode, $_password;
    
    public function __construct($dbRow) {
        $this->_id = $dbRow['idaccounts'];
        $this->_type = $dbRow['type'];
        $this->_name = $dbRow['name'];
        $this->_dob = $dbRow['dob'];
        $this->_email = $dbRow['email'];
        $this->_phonenumber = $dbRow['phonenumber'];
        $this->_address1 = $dbRow['address1'];
        $this->_address2 = $dbRow['address2'];
        $this->_address3 = $dbRow['address3'];
        $this->_postcode = $dbRow['postcode'];
        $this->_password = $dbRow['password'];
    }

    public function getAccountID() {
        return $this->_id;
    }
    public function getType() {
        return $this->_type;
    }
    public function getName() {
        return $this->_name;
    }
    public function getDob() {
        return $this->_dob;
    }
    public function getEmail() {
        return $this->_email;
    }
    public function getPhonenumber() {
        return $this->_phonenumber;
    }
    public function getAddress1() {
        return $this->_address1;
    }
    public function getAddress2() {
        return $this->_address2;
    }
    public function getAddress3() {
        return $this->_address3;
    }
    public function getPostcode() {
        return $this->_postcode;
    }
    public function getPassword() {
        return $this->_password;
    }


            
}


