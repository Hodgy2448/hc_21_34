<?php
session_start();
$view = new stdClass();
require_once ('Models/StudentDataSet.php');
$studentDataSet = new StudentDataSet();
$view->studentDataSet = $studentDataSet->fetchAllStudents();
require_once ('Models/AccountDataSet.php');
$accountDataSet = new AccountDataSet();
$view->accountDataSet = $accountDataSet->fetchAllAccounts();
require_once ('Models/PlacementDataSet.php');
$placementDataSet = new PlacementDataSet();
$view->placementDataSet = $placementDataSet->fetchAllPlacements();


$view->sessionType = $_SESSION['type'];
$view->sessionName =$_SESSION['name'];
$view->sessionDob = $_SESSION['dob'];
$view->sessionEmail = $_SESSION['email'];
$view->sessionPhonenumber =$_SESSION['phonenumber'];
$view->sessionAddress1 =$_SESSION['address1'];
$view->sessionAddress2 =$_SESSION['address2'];
$view->sessionAddress3 =$_SESSION['address3'];
$view->sessionPostcode =$_SESSION['postcode'];

if(isset($_GET['id'])) {
    if($_GET['id'] == 'logout'){
        session_destroy();
        header('Location: /index.php');
    }

}
if(isset($_GET['id'])) {
    if($_GET['id'] == 'student'){
        $newStudent = false;
        $found = false;
        foreach ($view->accountDataSet as $accountData) {
            foreach ($view->studentDataSet as $studentData) {
                $found = false;
                if ($studentData->getStudentID() == $_SESSION['idaccounts']) {
                        $found = true;
                }
                else
                {
                        $found = false;
                }
                }
            }
        if($found == true) {
        $view->display = 'display: none';
            $view->displayOpp = 'display: block';
            $view->sessionUniversity = $studentData->getUniversity();
            $view->sessionCourse = $studentData->getCourse();
            $view->sessionSkills = $studentData->getSkills();
            $view->sessionFile = $studentData->getCvUpload();
        }
        else
        {
            $view->display = 'display: block';
            $view->displayOpp = 'display: none';
        }
        require_once('Views/myprofilestudent.phtml');

        if(isset($_POST['submit'])) {

            foreach ($view->accountDataSet as $accountData) {
                foreach ($view->studentDataSet as $studentData) {
                    $newStudent = false;
                    if ($studentData->getStudentID() == $accountData->getAccountID()) {
                        $studentDataSet->setMoreDetails(
                            $studentData->getStudentID(),
                            $_POST['university'],
                            $_POST['course'],
                            $_POST['skills'],
                            $_SESSION['filename']);

                    }
                    else
                    {
                        $newStudent = true;
                    }
                }
            }
            if($newStudent == true){
                $studentDataSet->setMoreDetails(
                    $accountData->getAccountID(),
                    $_POST['university'],
                    $_POST['course'],
                    $_POST['skills'],
                    $_SESSION['filename']);
            }
        }
    if(isset($_POST["fileSubmit"])) {
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));
        $allowed = array('txt', 'pdf', 'docx');

        if (in_array($file_ext, $allowed)) {
            if ($file_error === 0) {
                if ($file_size <= 500000) {
                    $file_name_new = uniqid('', true) . '.' . $file_ext;
                    $_SESSION['filename'] = $file_name_new;
                    $file_dest = 'cvuploads/' . $file_name_new;

                    if (move_uploaded_file($file_tmp, $file_dest)) {
                        $view->uploadresult = 'File uploaded';
                    }
                    else
                    {
                        $view->uploadresult = 'Upload error';
                    }

                }

            }


        }
    }


}
elseif($_GET['id'] == 'employer') {
    $newEmployer = false;
    $found = false;
    foreach ($view->accountDataSet as $accountData) {
        foreach ($view->placementDataSet as $placementData) {
            $found = false;
            if ($placementData->getPlacementID() == $_SESSION['idaccounts']) {
                $found = true;
            }
            else
            {
                $found = false;
            }
        }
    }
    if($found == true) {
        $view->displayEmployer = 'display: none';
        $view->displayOppEmployer = 'display: block';
        $view->sessionTitle = $placementData->getPlacementID();
        $view->sessionDescription = $placementData->getTitle();
        $view->sessionLocation = $placementData->getLocation();
        $view->sessionNeededSkills = $placementData->getNeededSkills();
        $view->sessionWorkType = $placementData->getWorkType();
        $view->sessionSalary = $placementData->getSalary();
        $view->sessionStartDate = $placementData->getStartDate();
        $view->sessionEndDate = $placementData->getEndDate();
    }
    else
    {
        $view->displayEmployer = 'display: block';
        $view->displayOppEmployer = 'display: none';
    }
    require_once('Views/myprofileemployer.phtml');



    if(isset($_POST['submit'])) {

        foreach ($view->accountDataSet as $accountData) {
            foreach ($view->placementDataSet as $placementData) {
                $newEmployer = false;
                if ($placementData->getPlacementID() == $accountData->getAccountID()) {
                    $placementDataSet->createPlacement(
                        $placementData->getPlacementID(),
                        $_POST['companytitle'],
                        $_POST['description'],
                        $_POST['location'],
                        $_POST['skillsEmployer'],
                        $_POST['worktype'],
                        $_POST['salary'],
                        $_POST['startdate'],
                        $_POST['enddate']);

                }
                else
                {
                    $newEmployer = true;
                }
            }
        }
        if($newEmployer == true){
            $placementDataSet->createPlacement(
            $accountData->getAccountID(),
                        $_POST['companytitle'],
                        $_POST['description'],
                        $_POST['location'],
                        $_POST['skillsEmployer'],
                        $_POST['worktype'],
                        $_POST['salary'],
                        $_POST['startdate'],
                        $_POST['enddate']);
        }
    }

}
}


// secure hashing function for details

