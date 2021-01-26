<?php
session_start();
$view = new stdClass();
require_once ('Models/AccountDataSet.php');
$accountDataSet = new AccountDataSet();
$view->accountDataSet = $accountDataSet->fetchAllAccounts();
$error = true;
if(isset($_POST['submit']))
{

    foreach ($view->accountDataSet as $accountData)
    {
        if($_POST['email'] == $accountData->getEmail())
        {
            if ($_POST['password'] == $accountData->getPassword())
            {
                $result = "Loading page..";
                $view->result = $result;

                $_SESSION['idaccounts'] = $accountData->getAccountID();
                $_SESSION['type'] = $accountData->getType();
                $_SESSION['name'] = $accountData->getName();
                $_SESSION['dob'] = $accountData->getdob();
                $_SESSION['email'] = $accountData->getemail();
                $_SESSION['phonenumber'] = $accountData->getphonenumber();
                $_SESSION['address1'] = $accountData->getaddress1();
                $_SESSION['address2'] = $accountData->getaddress2();
                $_SESSION['address3'] = $accountData->getaddress3();
                $_SESSION['postcode'] = $accountData->getpostcode();

                if(trim($_SESSION['type']) == 'Student')
                {
                    header('Location: /myprofile.php?id=student');
                }
                elseif(trim($_SESSION['type']) == 'Employer')
                {
                    header('Location: /myprofile.php?id=employer');
                }

            }
            else{
                $result = "Incorrect Username or Password";
                $view->result = $result;
                $error = true;
            }
        }
        else {
            $result = "Incorrect Username or Password";
            $view->result = $result;
            $error = true;
        }

    }


}
require_once('Views/login.phtml');