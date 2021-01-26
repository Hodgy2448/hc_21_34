<?php
session_start();
$view = new stdClass();

require_once ('Models/AccountDataSet.php');
$accountDataSet = new AccountDataSet();
$view->accountDataSet = $accountDataSet->fetchAllAccounts();
$error = true;
$count = 0;
if(isset($_POST['submit']))
{

    foreach ($view->accountDataSet as $accountData) {
        $count++;
        if ($_POST['email'] == $accountData->getEmail()) {
            $result = "Account Already Created, Try Signing In";
            $view->result = $result;
            $error = true;
        }
        else
        {
            $error = false;
        }
    }

    if($error == false)
    {
        $accountDataSet->createAccount(
            $_POST['type'],
            $_POST['name'],
            $_POST['dob'],
            $_POST['email'],
            $_POST['phonenumber'],
            $_POST['address1'],
            $_POST['address2'],
            $_POST['address3'],
            $_POST['postcode'],
            $_POST['password']);

        $_SESSION['idaccounts'] = $count;
        $_SESSION['type'] = $_POST['type'];
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['dob'] = $_POST['dob'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['phonenumber'] = $_POST['email'];
        $_SESSION['address1'] = $_POST['address1'];
        $_SESSION['address2'] = $_POST['address2'];
        $_SESSION['address3'] = $_POST['address3'];
        $_SESSION['postcode'] = $_POST['postcode'];
        if(trim($_SESSION['type']) == 'Student') {
            header('Location: /myprofile.php?id=student');
        }
        else
        {
            header('Location: /myprofile.php?id=employer');
        }
    }
}


require_once('Views/signup.phtml');
