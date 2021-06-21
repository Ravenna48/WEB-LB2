<?php
require_once ("../Exceptions/ValidationException.php");
require_once ("../dto/User.php");
require_once("../dto/Application.php");


class CheckValidationData
{
    function checkPassword($firstPassword, $secondPassword, $email){
        $newUser = null;
        if($firstPassword===$secondPassword){
            $newUser = new User();
            $newUser->setEmail($email);
            $newUser->setPassword($firstPassword);
        }
        if($newUser==null)
            throw new ValidationException("Пароли не совпадают!");
        return $newUser;
    }

    function checkApplication(){
        $newApplication = null;
        if(isset($_POST["subject"]) && isset($_POST["description"])
            && isset($_POST["name"]) && isset($_POST["user_description"])){
            $newApplication = new Application();
            $newApplication->setSubject($_POST["subject"]);
            $newApplication->setDescription($_POST["description"]);
            $newApplication->setName($_POST["name"]);
            $newApplication->setUserDescription($_POST["user_description"]);
        }
        else {
            throw new ValidationException("Проверьте правельность введенных данных.");
        }
        if($newApplication==null)
            throw new ValidationException("Проверьте правельность введенных данных");
        $performanceName = basename(basename($_FILES['filePerformance']['name']));
        $presentationName = basename(basename($_FILES['filePresentation']['name']));
        if(is_uploaded_file($_FILES['filePerformance']['tmp_name'])){
            move_uploaded_file($_FILES['filePerformance']['tmp_name'], '../performance/'.$_SESSION['email'].'/'.basename($_FILES['filePerformance']['name']));
        }
        if(is_uploaded_file($_FILES['filePresentation']['tmp_name'])){
            move_uploaded_file($_FILES['filePresentation']['tmp_name'], '../presentation/'.$_SESSION['email'].'/'.basename($_FILES['filePresentation']['name']));
        }
        $newApplication->setPerformance($performanceName);
        $newApplication->setPresentation($presentationName);
        return $newApplication;
    }

}