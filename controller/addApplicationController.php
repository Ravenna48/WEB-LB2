<?php
require_once ("..\dao\Dao.php");
require_once ("..\dto\User.php");
require_once ("..\Service\CheckValidationData.php");
require_once ("..\Exceptions\InsertException.php");
require_once ("..\Exceptions\ValidationException.php");

session_start();
$DB = new Dao();
$validation = new CheckValidationData();

try{
    $newApplication = $validation->checkApplication();
    $DB->addApplication($newApplication, $_SESSION['email']);
    header("Location: ../index.php");
 }
catch (Exception $ex){
    echo $ex->getMessage();
}
